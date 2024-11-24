<?php

namespace App\Http\Controllers;

use App\Models\ExceptionHandler;
use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function GetFaq()
    {
        return view('faq.addFaq');
    }
    public function AddFaq(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required',
                'answer' => 'required',
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
                $data=new Faq();
                $data->question=$request->question;
                $data->answer=$request->answer;
                $data->entry_by=Auth::user()->id;
                $data->date=date('Y-m-d');
                $data->status=true;
                $data->save();
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Faq Added Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "FaqController.AddFaqs";
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
    public function FaqList()
    {
        $faqLists=Faq::get();
        return view('faq.faqList',compact('faqLists'));
    }
    public function closeFaq(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->input('data');
            $job = Faq::where('id', $data)->first();
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
            $exception->controller_function = "FaqController.closeFaq";
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
