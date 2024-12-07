<?php

namespace App\Http\Controllers;

use App\Models\CustomerQuery;
use App\Models\ExceptionHandler;
use App\Models\User\BookAppointment;
use App\Models\User\Facility;
use App\Models\User\Specialist;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Index()
    {
        $totaVisitor=Visitor::count();
        $totaUniqueVisitor = Visitor::distinct('ip_address')->count();
        $todaysVisitor = Visitor::distinct('ip_address')->where('date',date('Y-m-d'))->count();
        $customer_query = CustomerQuery::OrderBy('id','DESC')->get();
        $bookAppointment = BookAppointment::join('specialists','specialists.id','=','book_appointments.specialist_id')
        ->select('specialists.doctor_name','book_appointments.*')
        ->OrderBy('entry_date','DESC')->get();
        return view('dashboard',compact('totaVisitor','totaUniqueVisitor','todaysVisitor','customer_query','bookAppointment'));
    }
    public function changeStatus(Request $request){
        DB::beginTransaction();
        try{
            if($request->type=='doctor'){
               $specialist= Specialist::where('id',$request->id)->first();
               $specialist->status=!$specialist->status;
               $specialist->save();
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Status updated Successfully',
                ]);
            }
            if($request->type=='facility'){
                $facility= Facility::where('id',$request->id)->first();
                $facility->status=!$facility->status;
                $facility->save();
                 DB::commit();
                 return response()->json([
                     'response' => 'success',
                     'message' => 'Status updated Successfully',
                 ]);
             }
        } catch (\Throwable $e) {
            DB::rollBack();
            $exception = new ExceptionHandler();
            $exception->controller_function = "DashboardController.changeStatus";
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
