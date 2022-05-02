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
        
        
        return view('travel_order.approverindex');
    
    }
}
