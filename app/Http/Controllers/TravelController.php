<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Personnel_Assignment;
use App\Models\TravelOrder;
use App\Models\Region;


class TravelController extends Controller
{
    public function index(){


        return view('travel_order.index');
    }

    public function region()
    {
        $regions = Region::get();
        return response()->json(compact('regions'));
    }

    public function create()
    {

        return view('travel_order.create');
    }

    public function create_travel(){
        
        // $now = Carbon::now();
        // $travel_id = TravelOrder::latest()->first();
        // if($travel_id == NULL){
        //     $default = "000001";
        //     $val = $now->year .'-'.$default;
            
        // }else{
        //     $default = "000000";
        //     $after_year = sprintf('%06d', $default + intval($travel_id->id + 000001));
        //     $val = $now->year .'-'.$after_year;
            
        // }

        // $travel = new TravelOrder;

        // $travel->user_id = Auth::user()->id;
        // $travel->date_depart = $request->datedepart;
        // $travel->date_arrived = $request->datearrive;
        // $travel->destination = $request->destination;
        // $travel->purpose = $request->purpose;
        // $travel->expenses = $request->expenses;
        // $travel->assist_labor_allowed = $request->assist_labor_allowed;
        // $travel->instructions = $request->instructions;
        // $travel->date_submitted = Carbon::now();
        // $travel->to_number = $val;

        // $travel->save();

        return 'Ok';
    }
}
