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
        $fullname2 = $user->firstname . " " . substr($user->middlename, 0, 1). "." . " " .$user->lastname;
        $position = Promotion::where('user_id', $trav->user_id)->with('plantilla')->latest()->first();
        $office_assigned = Personnel_Assignment::where('user_id', $trav->user_id)->with('office')->latest()->first();

        //Conditions to determine kinsay signatory sa Travel Order
        if($trav->travel_type == 'Within AOR'){ 
                    if($trav->office == "Conservation and Development Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Enforcement Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Licences Patents and Deeds Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Surveys and Mapping Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "ARED for Technical Services"){
                        $approverts = User::find($trav->aredts_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Planning and Management Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Legal Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "ARED for Management Services"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;
                        
                        $travtype = 'Within AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Finance Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Admin Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Regional Strategic Communications Initiatives Group"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Program Monitoring and Coordination Center"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Office of the Regional Executive Director"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;

                        $travtype = 'Within AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "CENRO Baganga"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        
                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Manay"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Mati"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Lupon"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Monkayo"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Maco"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO New Corella"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Panabo"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Davao"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Digos"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Malalag"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'cenro';
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao Oriental"){
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'penro';
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao de Oro"){
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'penro';
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao del Norte"){
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'penro';
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao del Sur"){
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'penro';
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao Occidental"){
                        $approverpenro = User::find($trav->penro_approval);

                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;
                        $approverred_fullname = NULL;

                        $travtype = 'Within AOR';
                        $travtype = 'penro';
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }
        }elseif($trav->travel_type == "Outside AOR"){
                    if($trav->office == "Conservation and Development Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $apporverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Enforcement Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $apporverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Licences Patents and Deeds Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $apporverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Surveys and Mapping Division"){
                        $approverts = User::find($trav->aredts_approval);
                        $apporverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "ARED for Technical Services"){
                        $approverts = User::find($trav->aredts_approval);
                        $apporverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ts';
                        $approverts_fullname = $approverts->firstname . " " . substr($approverts->middlename, 0, 1) . "." . " " . $approverts->lastname;
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname; 

                    }elseif($trav->office == "Planning and Management Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Legal Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "ARED for Management Services"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Finance Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Admin Division"){
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'ms';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Regional Strategic Communications Initiatives Group"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);
                        
                        $approverms_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Office of the Regional Executive Director"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approverms_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "Program Monitoring and Coordination Center"){
                        // $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverms_fullname = NULL;
                        $approverts_fullname = NULL;
                        $approvercenro_fullname = NULL;
                        $approverpenro_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'red';
                        // $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;

                    }elseif($trav->office == "CENRO Baganga"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Manay"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;
                        
                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Mati"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Lupon"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Monkayo"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Maco"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO New Corella"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Panabo"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Davao"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Digos"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "CENRO Malalag"){
                        $approvercenro = User::find($trav->cenro_approval);
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'cenro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approvercenro_fullname = $approvercenro->firstname . " " . substr($approvercenro->middlename, 0, 1) . "." . " " . $approvercenro->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao Oriental"){
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'penro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao de Oro"){
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'penro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao del Norte"){
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'penro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao del Sur"){
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $approvercenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $travtype = 'Outside AOR';
                        $officetype = 'penro';
                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }elseif($trav->office == "PENRO Davao Occidental"){
                        $approverpenro = User::find($trav->penro_approval);
                        $approverms = User::find($trav->aredms_approval);
                        $approverred = User::find($trav->red_approval);

                        $travtype = 'Outside AOR';
                        $officetype = 'penro';
                        $approvercenro_fullname = NULL;
                        $approverts_fullname = NULL;

                        $approverms_fullname = $approverms->firstname . " " . substr($approverms->middlename, 0, 1) . "." . " " . $approverms->lastname;
                        $approverred_fullname = $approverred->firstname . " " . substr($approverred->middlename, 0, 1) . "." . " " . $approverred->lastname;
                        $approverpenro_fullname = $approverpenro->firstname . " " . substr($approverpenro->middlename, 0, 1) . "." . " " . $approverpenro->lastname;
                    }
        
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
            'fullname2' => $fullname2,
            'position' => $position, 
            'office' => $trav->office,
            'official_station' => $office_assigned,
            'travtype' => $travtype,
            'officetype' => $officetype,
            'penrofullname' =>  $approverpenro_fullname,
            'cenrofullname' =>  $approvercenro_fullname,
            'aredtsfullname' =>  $approverts_fullname,
            'aredmsfullname' => $approverms_fullname,
            'redfullname' => $approverred_fullname
            
        ];
        
        //$travels_penro_approved->merge($travels_aredms_approved);

        $pdf = PDF::loadView('travel_order.reports.travelorders_pdf.travelpdf', $travel);
    
        return $pdf->download($filename . '.pdf');
        // return view('travel_order.reports.travelorders_pdf.travelpdf', $travel);
    }
}
