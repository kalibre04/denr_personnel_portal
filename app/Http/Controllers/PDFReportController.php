<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Personnel_Assignment;
use App\Models\TravelOrder;
use PDF;


class PDFReportController extends Controller
{
    public function printTravel($id){
        $travel = TravelOrder::find($id);
        $user = User::find($travel->user_id);

        $fullname = $travel->to_number. " - " .$user->lastname . ", " . $user->firstname;

        return $fullname;
        //$pdf = PDF::loadView('travelpdf', $data);
    
        //return $pdf->download('itsolutionstuff.pdf');
    }
}
