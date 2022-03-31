<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Models\User;



class PersonnelController extends Controller
{
    public function profile($id)
    {
        if(Auth::user()->id == $id){
            $user = User::find($id);
            return view('personnel.profile',compact('user'));
        }else{
            return redirect()->back();
        }
    }



}
