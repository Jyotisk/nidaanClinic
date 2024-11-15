<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $allSpecilists = Specialist::with('GetSpecialistLists')->get();
        return view('specialists.AddSpecialist', compact('allSpecilists'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'department_name' => 'required',
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
        // $details = [];
        // foreach ($request->file('image') as $image) {
        //     $path = $image->store('public/gallary');
        //     $details[] = [
        //         'menu_item_id' => $request->menu_item_id,
        //         'image' => $path,
        //         'date' => date('Y-m-d'),
        //         'entry_by' => Auth::user()->id,
        //         'status' => true
        //     ];
        // }
        DB::beginTransaction();
        try {
            $specialists = new Specialist();
            $specialists->department_name = $request->department_name;
            $specialists->doctor_name = $request->doctor_name;
            $specialists->descriptions = $request->descriptions;
            $specialists->facebook_link = $request->facebook_link;
            $specialists->instagram_link = $request->instagram_link;
            $specialists->twitter_link = $request->twitter_link;
            $specialists->linked_in_link = $request->linked_in_link;
            $specialists->status = true;
            $specialists->entry_by = Auth::user()->id;
            if ($request->file('doctor_image')) {
                $path = $request->doctor_image->store('public/gallary');
                $specialists->doctor_image = $path;
            }
            $specialists->save();

            $specialistDetail = [];
            foreach ($request->header as $key => $row) {

                Log::info($row);
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
}
