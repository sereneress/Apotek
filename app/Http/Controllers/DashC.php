<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashC extends Controller
{
  public function index()
  {
    return view('backend.dash');
  }
}
