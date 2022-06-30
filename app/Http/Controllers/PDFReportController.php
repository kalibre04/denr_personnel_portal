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
        $trav = TravelOrder::find($id);
        $user = User::find($trav->user_id);
        
        $filename = $trav->to_number. " - " .$user->lastname . ", " . $user->firstname;
        $fullname = $user->lastname . ", " . $user->firstname . " " . substr($user->middlename, 0, 1). ".";
        $position = Promotion::where('user_id', $trav->user_id)->with('plantilla')->latest()->first();
        $office_assigned = Personnel_Assignment::where('user_id', $trav->user_id)->with('office')->latest()->first();

        //Conditions to determine kinsay signatory sa Travel Order

        
        if($trav->office == "Conservation and Development Division"){
            $approverts = User::find($trav->aredts_approval);
            $apporverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

        }elseif($trav->office == "Enforcement Division"){
            $approverts = User::find($trav->aredts_approval);
            $apporverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);
            
            $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

        }elseif($trav->office == "Licences Patents and Deeds Division"){
            $approverts = User::find($trav->aredts_approval);
            $apporverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);
            
            $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

        }elseif($trav->office == "Surveys and Mapping Division"){
            $approverts = User::find($trav->aredts_approval);
            $apporverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);
            
            $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

        }elseif($trav->office == "ARED for Technical Services"){
            $approverts = User::find($trav->aredts_approval);
            $apporverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);
            
            $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

        }elseif($trav->office == "Planning and Management Division"){
            $approverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

        }elseif($trav->office == "Legal Division"){
            $approverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

        }elseif($trav->office == "ARED for Management Services"){
            $approverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

        }elseif($trav->office == "Finance Division"){
            $approverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

        }elseif($trav->office == "Admin Division"){
            $approverms = User::find($trav->aredms_approval);
            $approverred = User::find($trav->red_approval);

            $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
            $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

        }elseif($trav->office == "CENRO Baganga"){
            
        }elseif($trav->office == "CENRO Manay"){
            
        }elseif($trav->office == "CENRO Mati"){
            
        }elseif($trav->office == "CENRO Lupon"){
            
        }elseif($trav->office == "CENRO Monkayo"){
            
        }elseif($trav->office == "CENRO Maco"){
            
        }elseif($trav->office == "CENRO New Corella"){
            
        }elseif($trav->office == "CENRO Panabo"){
            
        }elseif($trav->office == "CENRO Davao"){
            
        }elseif($trav->office == "CENRO Digos"){
            
        }elseif($trav->office == "CENRO Malalag"){
            
        }elseif($trav->office == "PENRO Davao Oriental"){
            
        }elseif($trav->office == "PENRO Davao de Oro"){
            
        }elseif($trav->office == "PENRO Davao del Norte"){
            
        }elseif($trav->office == "PENRO Davao del Sur"){
            
        }elseif($trav->office == "PENRO Davao Occidental"){
            
        }

        //Conditions if Taga ARED TS ba ang employee 
        if($office_assigned == "Conservation and Development Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Enforcement Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Licences Patents and Deeds Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Surveys and Mapping Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "ARED for Technical Services"){
            $aredtype = "Technical";
        }

        $travel = [
            'to_number' => $trav->to_number,
            'date_depart' => $trav->date_depart,
            'date_arrived' => $trav->date_arrived,
            'destination' => $trav->destination,
            'salary' => $trav->salary,
            'purpose' => $trav->purpose,
            'expenses' => $trav->expenses,
            'assist_labor_allowed' => $trav->assist_labor_allowed,
            'instructions' => $trav->instructions,
            'fullname' => $fullname,
            'position' => $position, 
            'office' => $trav->office,
            'official_station' => $office_assigned,
            'aredtype' => $aredtype
        ];
        
        //$travels_penro_approved->merge($travels_aredms_approved);

        $pdf = PDF::loadView('travel_order.reports.travelorders_pdf.travelpdf', $travel);
    
        return $pdf->download($filename . '.pdf');
    }
}
