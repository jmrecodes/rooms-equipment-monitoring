<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class Guest extends Controller
{
    public function index(Request $request) {
        if ($request->session()->has('admin')) {
            return redirect(route('admin'));
        }

        return view('guest.home');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $login = Admin::where('adm_email', $email)->where('adm_password',$password)->get();

        if ($login->count()) {
            $request->session()->put('admin', $login[0]->adm_ID);
            return redirect(route('admin'));
        }
        else
            $request->session()->flash('error', 'Invalid email and / or password entered. Please try again.');
            return redirect(route('guest'));
    }
}
