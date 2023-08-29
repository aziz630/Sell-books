<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $page_title = 'Admin Dashboard';
        return view('admin.index', compact('page_title'));
    }
}
