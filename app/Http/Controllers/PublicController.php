<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\MenuItem;
use App\Models\User\BookAppointment;
use App\Models\User\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;

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

            $specialists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
                ->select('department_name', 'specialists.doctor_name', 'specialists.id')->get();
            return view('welcome', compact('specialists'));
        } catch (Exception $e) {
            return $e;
            DB::rollBack();
            return "Something Went Wrong";
        }
    }
    public function BookAppointment(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'patient_name' => 'required',
                'age' => 'required',
                'phone_no' => 'required|numeric|digits:10',
                'address' => 'required',
                'specialist_id' => 'required|numeric|exists:specialists,id',
                'appointment_date' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ],422);
        }
        DB::beginTransaction();
        try {
            //code...
            $appointment = new BookAppointment();
            $appointment->patient_name = $request->patient_name;
            $appointment->age = $request->age;
            $appointment->phone_no = $request->phone_no;
            $appointment->address = $request->address;
            $appointment->message = $request->message;
            $appointment->specialist_id = $request->specialist_id;
            $appointment->appointment_date = Carbon::parse($request->appointment_date)->format('Y-m-d');
            $appointment->entry_date = date('Y-m-d');
            $appointment->status = 'new';
            $appointment->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Appointment Booked Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
            //throw $th;
        }
    }

    public function aboutUs()
    {
        return view('public.about');
    }

    public function services()
    {
        return view('public.services');
    }

    public function servicesDetails()
    {
        return view('public.service-details');
    }

    public function speciality()
    {
        return view('public.speciality');
    }

    public function specialityDetails()
    {
        return view('public.speciality-details');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function teams()
    {
        return view('public.teams');
    }

    public function teamDetails()
    {
        return view('public.team-details');
    }

    public function gallery()
    {
        return view('public.gallery');
    }
}
