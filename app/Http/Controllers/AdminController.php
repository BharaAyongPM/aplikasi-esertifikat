<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Club;
use App\Models\JadwalLiga;
use App\Models\League;
use App\Models\Liga;
use App\Models\Matches;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.home',);
    }
}
