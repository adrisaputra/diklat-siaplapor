<?php

namespace App\Http\Controllers;

use App\Models\Agenda;   //nama model
use App\Models\Proposal;   //nama model
use App\Models\Office;   //nama model
use App\Models\User;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        if(Auth::user()->group == 1 || Auth::user()->group == 2){
            $agenda = Agenda::count();
            $proposal = Proposal::count();
            $office = Office::count();
            $user = User::count();
            return view('admin.beranda', compact('agenda','proposal','office','user'));
        } else {
            $proposal = Proposal::where('office_id',Auth::user()->office_id)->count();
            return view('admin.beranda', compact('proposal'));
        }
    }
}
