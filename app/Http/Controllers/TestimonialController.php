<?php

namespace App\Http\Controllers;

use App\Models\ExceptionHandler;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function GetTestimonials()
    {
        return view('testimonial.addTestimonial');
    }
    public function AddTestimonials(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'profession' => 'required',
                'description' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $data=new Testimonial();
                $data->name=$request->name;
                $data->profession=$request->profession;
                $data->description=$request->description;
                $data->entry_by=Auth::user()->id;
                $data->date=date('Y-m-d');
                $data->status=true;
                $data->save();
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Testimonial Added Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "TestimonialController.AddTestimonials";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function TestimonialList()
    {
        $testimonialLists=Testimonial::get();
        return view('testimonial.testmonialList',compact('testimonialLists'));
    }
    public function closeTestimonialList(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->input('data');
            $job = Testimonial::where('id', $data)->first();
            $job->entry_by = Auth::user()->id;
            $job->date = date('Y-m-d');
            if ($job->status == true) {
                $job->status = false;
            } else {
                $job->status = true;
            }
            $job->save();

            DB::commit();
            return response()->json([
                'response' => 'success',
                'message' => 'Status Changed Successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $exception = new ExceptionHandler();
            $exception->controller_function = "TestimonialController.closeTestimonialList";
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
