<?php

namespace App\Http\Controllers;

use App\Models\CustomerQuery;
use App\Models\User\BookAppointment;
use App\Models\Visitor;

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
   
}
