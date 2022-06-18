<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function password(){
        return redirect()->route('password.reset',Auth::user()->id);
    }

    public function dashboard(){

        return view('pages.dashboard');

    }

    public function profil(int $id){

        $user = User::find($id);
        return view('pages.profil',compact('user'));
    }

    public function mon_profil(int $id){
        $user = User::find($id);
        $user->load('reservations');
        return view('pages.view_profil',compact('user'));
    }



}
