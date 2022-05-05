<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;
use Auth;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Personnel_Assignment;
use App\Models\TravelOrder;

class TravelApproverController extends Controller
{
    public function chief_index(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travels = TravelOrder::where('application_status', 'Pending')->where('office', $user_office->office->officename)->get();
        //dd($user_office);
        return view('travel_order.approverindex', compact('travels'));
    }
    
    public function chief_edit($id){
        $travel_order = TravelOrder::find($id);
        return view('travel_order.edittraveldivchief', compact('travel_order'));        
    }

    public function chief_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }

}
