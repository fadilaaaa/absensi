<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "admin") {
            return view("admin.dashboard");
        } else {
            return view("petugas.dashboard");
        }
    }
}
