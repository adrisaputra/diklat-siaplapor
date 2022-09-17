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

    ## Jumlah Data
    public function count_data(Request $request)
    {
        if(Auth::user()->group == 1){
            if($request->segment(2)=="all"){
                $proposal = Proposal::orderBy('id','DESC')->count();
            } else if($request->segment(2)=="request"){
                $proposal = Proposal::where('status','Masuk')->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="process"){
                $proposal = Proposal::where('status','Proses')->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="done"){
                $proposal = Proposal::where('status','Selesai')->orderBy('id','DESC')->count();
            }
        } else {
            if($request->segment(2)=="all"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="request"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Masuk')->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="fixing"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Perbaiki')->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="process"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Proses')->orderBy('id','DESC')->count();
            } else if($request->segment(2)=="done"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Selesai')->orderBy('id','DESC')->count();
            }
        }
       
        return $proposal;
    }

    ## Jumlah Data
    public function count_data2(Request $request)
    {
        if(Auth::user()->group == 1){
            if($request->segment(2)=="1"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->orderBy('proposals.id','DESC')->count();
            } else if($request->segment(2)=="2"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })->orderBy('proposals.id','DESC')->count();
            } else if($request->segment(2)=="3"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke opd')->orderBy('proposals.id','DESC')->count();
            }  else if($request->segment(2)=="4"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','ambil berkas fisik')->orderBy('proposals.id','DESC')->count();
            }   else if($request->segment(2)=="5"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke admin')->orderBy('proposals.id','DESC')->count();
            }  else if($request->segment(2)=="6"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','setor berkas fisik')->orderBy('proposals.id','DESC')->count();
            }  else if($request->segment(2)=="7"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','selesai')->orderBy('proposals.id','DESC')->count();
            }  
        } else {
            if($request->segment(2)=="1"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->orderBy('proposals.id','DESC')->count();
            } else if($request->segment(2)=="2"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })
                            ->orderBy('proposals.id','DESC')->count();
            } else if($request->segment(2)=="3"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke opd')
                            ->orderBy('proposals.id','DESC')->count();
            }  else if($request->segment(2)=="4"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','ambil berkas fisik')
                            ->orderBy('proposals.id','DESC')->count();
            }   else if($request->segment(2)=="5"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke admin')
                            ->orderBy('proposals.id','DESC')->count();
            }  else if($request->segment(2)=="6"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','setor berkas fisik')
                            ->orderBy('proposals.id','DESC')->count();
            }   else if($request->segment(2)=="7"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','selesai')
                            ->orderBy('proposals.id','DESC')->count();
            }  
        }
       
        return $proposal;
    }
}
