<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\User\BookAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use Exception;


class PublicController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();
        try {
            $ipAddress = $request->ip();
            $Visitor = new Visitor();
            $Visitor->ip_address = $ipAddress;
            $Visitor->date = date('Y-m-d');
            $Visitor->save();
            DB::commit();

            return view('welcome');
        } catch (Exception $e) {
            return $e;
            DB::rollBack();
            return "Something Went Wrong";
        }
    }
    public function BookAppointment(Request $request)
    {
        try {
            //code...
            $appointment = new BookAppointment();
            $appointment->patient_name = $request->patient_name;
            $appointment->age = $request->age;
            $appointment->phone_no = $request->phone_no;
            $appointment->address = $request->address;
            $appointment->message = $request->message;
            $appointment->specialist_id = $request->specialist_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->entry_date = date('Y-m-d');
            $appointment->status = 'new';
            $appointment->save();
        } catch (\Exception $e) {
            return $e;
            //throw $th;
        }
    }

    public function aboutUs() {
        return view('public.about');
    }

    public function services() {
        return view('public.services');
    }
}
