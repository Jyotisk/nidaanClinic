<?php

namespace App\Http\Controllers;
use App\Models\MenuItem;
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
    
}
