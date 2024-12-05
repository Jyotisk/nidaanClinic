<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\ExceptionHandler;
use App\Models\User\Specialist;
use App\Models\User\SpecialistDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SpecilistController extends Controller
{
    public function index()
    {
        // $speciaLists = Specialist::all();
        // $allSpecilists = Specialist::with('GetSpecialistLists')->get();
        $departments = Department::get();
        $allSpecilists = Specialist::join('departments', 'departments.id', '=', 'specialists.department_id')->select('specialists.*', 'departments.department_name')->get();
        return view('specialists.AddSpecialist', compact('allSpecilists', 'departments'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'department_name' => 'required',
                'doctor_name' => 'required',
                'descriptions' => 'required',
                'doctor_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5500', // Adjust the validation rules as needed
            ],
        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $specialists = new Specialist();
            $specialists->department_id = $request->department_name;
            $specialists->doctor_name = $request->doctor_name;
            $specialists->descriptions = $request->descriptions;
            $specialists->facebook_link = $request->facebook_link;
            $specialists->instagram_link = $request->instagram_link;
            $specialists->twitter_link = $request->twitter_link;
            $specialists->linked_in_link = $request->linked_in_link;
            $specialists->status = true;
            $specialists->entry_by = Auth::user()->id;
            if ($request->file('doctor_image')) {
                $path = $request->doctor_image->store('public/specialist');
                $specialists->doctor_image = $path;
            }
            $specialists->save();

            if (count($request->header) > 0) {
                $specialistDetail = [];
                foreach ($request->header as $key => $row) {
                    $specialistDetail[] = [
                        'specialist_id' => $specialists->id,
                        'header' => $row,
                        'specialist_detail' => $request->specialist_detail[$key],
                    ];
                }
                $specialistDetail = collect($specialistDetail);
                $chunks = $specialistDetail->chunk(500);

                foreach ($chunks as $chunk) {
                    SpecialistDetail::insert($chunk->toArray());
                }
            }

            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Doctor Details Inserted Successfully',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Storage::delete($path);
            $exception = new ExceptionHandler();
            $exception->controller_function = "SpecilistController.store";
            $exception->error = $e;
            $exception->date = date('Y-m-d');
            $exception->user_id = Auth::user()->id;
            $exception->save();
            return response()->json([
                'response' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }
    public function SpecialistDetails(Request $request)
    {
        $specialistDetails = SpecialistDetail::where('specialist_id', $request->specialist_id)->get();
        return response()->json([
            'status' => 'success',
            'specialistDetails' => $specialistDetails,
        ]);
    }
    public function edit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_name' => 'required',
                'descriptions' => 'required',
                'doctor_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5500', // Adjust the validation rules as needed
            ],
        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $specialists = Specialist::findOrFail($request->specialist_id);
            $specialists->doctor_name = $request->doctor_name;
            $specialists->descriptions = $request->descriptions;
            $specialists->facebook_link = $request->facebook_link;
            $specialists->instagram_link = $request->instagram_link;
            $specialists->twitter_link = $request->twitter_link;
            $specialists->linked_in_link = $request->linked_in_link;
            $specialists->status = true;
            $specialists->entry_by = Auth::user()->id;
            if ($request->file('doctor_image')) {
                Storage::delete($specialists->doctor_image);
                $path = $request->doctor_image->store('public/specialist');
                $specialists->doctor_image = $path;
            }
            $specialists->save();
            SpecialistDetail::where('specialist_id', $request->specialist_id)->delete();
            $specialistDetail = [];
            foreach ($request->header as $key => $row) {
                $specialistDetail[] = [
                    'specialist_id' => $specialists->id,
                    'header' => $row,
                    'specialist_detail' => $request->specialist_detail[$key],
                ];
            }
            $specialistDetail = collect($specialistDetail);
            $chunks = $specialistDetail->chunk(500);

            foreach ($chunks as $chunk) {
                SpecialistDetail::insert($chunk->toArray());
            }
            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Doctor Details Updated Successfully',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Storage::delete($path);
            $exception = new ExceptionHandler();
            $exception->controller_function = "SpecilistController.store";
            $exception->error = $e;
            $exception->date = date('Y-m-d');
            $exception->user_id = Auth::user()->id;
            $exception->save();
            return response()->json([
                'response' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }


    public function indexDepartment()
    {
        // $speciaLists = Specialist::all();
        // $allSpecilists = Specialist::with('GetSpecialistLists')->get();
        $departments = Department::get();
        return view('specialists.AddDepartment', compact('departments'));
    }
    public function storeDepartment(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'department_name' => 'required',
            ],
        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $specialists = new Department();
            $specialists->department_name = $request->department_name;

            $specialists->status = true;
            $specialists->entry_by = Auth::user()->id;
            $specialists->save();
            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Department Name Inserted Successfully',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            $exception = new ExceptionHandler();
            $exception->controller_function = "SpecilistController.indexDepartment";
            $exception->error = $e;
            $exception->date = date('Y-m-d');
            $exception->user_id = Auth::user()->id;
            $exception->save();
            return response()->json([
                'response' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }
}
