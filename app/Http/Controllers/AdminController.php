<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Books;
use App\Models\BookStock;
use App\Models\User;


class AdminController extends Controller
{
    public function AdminDashboard(){
        $page_title = 'Admin Dashboard';
            $get_all_books = count(BookStock::all());
            $get_all_Users = count(User::all());
            $get_sold_books = count(BookStock::where('status', 0)->get());
// dd($get_sold_books);
        return view('admin.index', compact('page_title', 'get_all_books','get_all_Users', 'get_sold_books'));
    }


    public function AdminLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
