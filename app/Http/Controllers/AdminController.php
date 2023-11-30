<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        // return dd('admin');
        $data['title'] = 'Admin-Dashboard';
        $data['page'] = 'dashboard';
        return view('admin.dashboard',$data);
    }
}
