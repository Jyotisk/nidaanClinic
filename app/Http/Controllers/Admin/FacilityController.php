<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExceptionHandler;
use App\Models\User\Facility;
use App\Models\User\FacilityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    public function index()
    {
        $facilityLists = Facility::all();
        // $allSpecilists = Specialist::with('GetSpecialistLists')->get();
        // return view('specialists.AddSpecialist', compact('allSpecilists'));
        return view('facilities.Facilitylists', compact('facilityLists'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'facility_name' => 'required',
                'descriptions' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5500', // Adjust the validation rules as needed
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
            $facility = new Facility();
            $facility->facility_name = $request->facility_name;
            $facility->descriptions = $request->descriptions;
            $facility->status = true;
            $facility->entry_by = Auth::user()->id;
            if ($request->file('image')) {
                $path = $request->image->store('public/gallary');
                $facility->image = $path;
            }
            $facility->save();

            $facilityDetail = [];
            foreach ($request->facility_detail as $row) {

                $facilityDetail[] = [
                    'facility_id' => $facility->id,
                    'facility_detail' => $row,
                ];
            }
            $specialistDetail = collect($facilityDetail);
            $chunks = $specialistDetail->chunk(500);

            foreach ($chunks as $chunk) {
                FacilityDetail::insert($chunk->toArray());
            }
            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Facility Details Inserted Successfully',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Storage::delete($path);
            return $e;
            $exception = new ExceptionHandler();
            $exception->controller_function = "FacilityController.store";
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
