<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExceptionHandler;
use App\Models\Gallary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GallaryController extends Controller
{
    public function index()
    {
        return view('gallary.gallary');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5500', // Adjust the validation rules as needed
                ],
            );
            if ($validator->fails()) {

                return response()->json([
                    'response' => 'validationFails',
                    'error' => $validator->errors()
                ]);
            }
            $details = [];
            foreach ($request->file('image') as $image) {
                $path = $image->store('public/gallary');
                $details[] = [
                    'image' => $path,
                    'date' => date('Y-m-d'),
                    'entry_by' => Auth::user()->id,
                    'status' => true
                ];
            }
            $details = collect($details);
            $chunks = $details->chunk(500);

            foreach ($chunks as $chunk) {
                Gallary::insert($chunk->toArray());
            }
            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Gallay Image Added Successfully',
            ]);
        } catch (Exception $e) {
            foreach ($details as $data) {
                Storage::delete($data['image']);
            }
            DB::rollBack();
            $exception = new ExceptionHandler();
            $exception->controller_function = "GallaryController.create";
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
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $gallaryImage = Gallary::orderBy('id', 'DESC')->select('image', 'id')->where('status', true)->get();
        return view('gallary.gallaryList', compact('gallaryImage'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataArray = $request->input('data');
            for ($i = 0; $i < count($dataArray); $i++) {
                $Image = Gallary::where('id', $dataArray[$i])->first();
                $Image->entry_by = Auth::user()->id;
                $Image->date = date('Y-m-d');
                $Image->status = false;
                Storage::delete($Image->image);
                $Image->save();
            }

            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Image Deleted Successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $exception = new ExceptionHandler();
            $exception->controller_function = "GallaryController.destroy";
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
