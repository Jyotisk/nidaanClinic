<?php

namespace App\Http\Controllers;

use App\Models\CustomerQuery;
use App\Models\Department;
use App\Models\Faq;
use App\Models\Gallary;
use App\Models\MenuItem;
use App\Models\Testimonial;
use App\Models\User\AvailableService;
use App\Models\User\BookAppointment;
use App\Models\User\Facility;
use App\Models\User\FacilityDetail;
use App\Models\User\Specialist;
use App\Models\User\SpecialistDetail;
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

            $speciaLists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
                ->where('specialists.status', true)
                ->select('specialists.id','department_name', 'specialists.doctor_name', 'specialists.doctor_image', 'specialists.id',  'facebook_link', 'instagram_link', 'twitter_link', 'linked_in_link')
                ->inRandomOrder()->get();
            $faqList = Faq::select('id', 'question', 'answer')->where('status', true)->inRandomOrder()->get();
            $testimonials = Testimonial::select('name', 'profession', 'description')->where('status', true)->inRandomOrder()->get();
            $services = Facility::where(['type' => 'service', 'status' => true])
            ->inRandomOrder()
            ->limit(3)
            ->get();
            $specialities=DB::select("SELECT facilities.id,facilities.facility_name,facilities.image,COALESCE(doctor_count,0) AS doctor_count,
            departments.department_name
            FROM facilities JOIN departments ON facilities.department_id=departments.id
            LEFT JOIN (SELECT department_id,COUNT(id) AS doctor_count FROM specialists GROUP BY department_id) specialists
            ON facilities.department_id=specialists.department_id
            WHERE facilities.status=true AND type='speciality'
            ORDER BY RAND()");

            return view('welcome', compact('speciaLists', 'faqList', 'testimonials','services','specialities'));
        } catch (Exception $e) {
            return $e;
            DB::rollBack();
            return "Something Went Wrong";
        }
    }
    public function customerQuery(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone_number' => 'required|numeric|digits:10',
                'message' => 'required',
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ], 422);
        }
        DB::beginTransaction();
        try {
            //code...
            $query = new CustomerQuery();
            $query->name = $request->name;
            $query->email = $request->email;
            $query->phone_no = $request->phone_number;
            $query->message = $request->message;
            $query->date = date('Y-m-d');
            $query->status = true;
            $query->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Query Registered Successfully."
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => "Something Went Wrong"
            ], 201);
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
            ], 422);
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
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => "Something Went Wrong"
            ], 201);
        }
    }

    public function aboutUs()
    {
        $faqList = Faq::select('id', 'question', 'answer')->where('status', true)->inRandomOrder()->get();
        $testimonials = Testimonial::select('name', 'profession', 'description')->where('status', true)->inRandomOrder()->get();
        $speciaLists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
        ->where('specialists.status', true)
        ->select('specialists.id','department_name', 'specialists.doctor_name', 'specialists.doctor_image', 'specialists.id',  'facebook_link', 'instagram_link', 'twitter_link', 'linked_in_link')
        ->inRandomOrder()->get();
        return view('public.about',compact('speciaLists','faqList','testimonials'));
    }

    public function services()
    {
        $services = Facility::where(['status'=>true,'type'=>'service'])->select('id', 'facility_name', 'descriptions', 'image')->inRandomOrder()->get();
        return view('public.services', compact('services'));
    }

    public function servicesDetails($id)
    {
        $serviceLists = Facility::where(['status' => true])->select('id', 'facility_name', 'descriptions', 'image')->inRandomOrder()->get();
        $services = Facility::where(['status' => true, 'id' => $id])->select('facility_name', 'descriptions', 'image')->first();
        $serviceDetails = FacilityDetail::where('facility_id', $id)->select('facility_detail')->get();
        return view('public.service-details', compact('services', 'serviceDetails', 'serviceLists'));
    }

    public function speciality()
    {
        $specialities=DB::select("SELECT facilities.id,facilities.facility_name,facilities.image,COALESCE(doctor_count,0) AS doctor_count,
        departments.department_name
        FROM facilities JOIN departments ON facilities.department_id=departments.id
        LEFT JOIN (SELECT department_id,COUNT(id) AS doctor_count FROM specialists GROUP BY department_id) specialists
        ON facilities.department_id=specialists.department_id
        WHERE facilities.status=true AND type='speciality'
        ORDER BY RAND()");
        return view('public.speciality',compact('specialities'));
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
        $speciaLists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
        ->where('specialists.status', true)
        ->select('specialists.id','specialists.descriptions','department_name', 'specialists.doctor_name', 'specialists.doctor_image', 'specialists.id',  'facebook_link', 'instagram_link', 'twitter_link', 'linked_in_link')
        ->inRandomOrder()->get();
        return view('public.teams',compact('speciaLists'));
    }

    public function teamDetails($id)
    {
        $speciaLists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
            ->select('department_name', 'specialists.doctor_name', 'specialists.doctor_image', 'specialists.id', 'descriptions', 'facebook_link', 'instagram_link', 'twitter_link', 'linked_in_link')
            ->where('specialists.id', $id)->inRandomOrder()->first();
        $speciaListDetails = SpecialistDetail::where('specialist_id', $id)->select('header', 'specialist_detail')
            ->get();
        return view('public.team-details', compact('speciaLists', 'speciaListDetails'));
    }

    public function booking()
    {
        $speciaLists = Specialist::join('departments', 'departments.id', 'specialists.department_id')
            ->select('department_name', 'specialists.doctor_name', 'specialists.id', 'descriptions')->inRandomOrder()->get();
        return view('public.booking', compact('speciaLists'));
    }

    public function gallery()
    {
        $gallaryImage = Gallary::select('image')->where('status', true)->inRandomOrder()->get();
        return view('public.gallery', compact('gallaryImage'));
    }
}
