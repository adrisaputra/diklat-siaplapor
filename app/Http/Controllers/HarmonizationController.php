<?php

namespace App\Http\Controllers;

use App\Models\Proposal;   //nama model
use App\Models\Harmonization;   //nama model
use App\Models\History;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class HarmonizationController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index(Request $request)
    {
        $title = "Usulan";

        if(Auth::user()->group == 1 || Auth::user()->group == 2){
            if($request->segment(1)=="harmonizations"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="harmonization_opd"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke opd')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_get_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','ambil berkas fisik')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_send_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke admin')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_verification"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','setor berkas fisik')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_done"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','selesai')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  
        } else {
            if($request->segment(1)=="harmonization_opd"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="harmonization_get_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke opd')
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_get_hardcopy"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','ambil berkas fisik')
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_send_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke admin')
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_verification"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','setor berkas fisik')
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_done"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','selesai')
                            ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  
        }
        
        return view('admin.harmonization.index',compact('title','proposal'));
    }

    ## Tampikan Data
    public function search(Request $request)
    {
        $title = "Usulan";
        $harmonization = $request->get('search');

        if(Auth::user()->group == 1 || Auth::user()->group == 2){
            if($request->segment(1)=="harmonizations"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })-> orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="harmonization_opd"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke opd')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_get_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','ambil berkas fisik')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_send_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','kirim ke admin')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_verification"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','setor berkas fisik')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_done"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.status','selesai')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  
        } else {
            if($request->segment(1)=="harmonization_opd"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where(function ($query) {
                                $query->where('harmonizations.status', 'perbaikan')
                                    ->orWhere('harmonizations.status', 'perbaiki kembali');
                            })
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="harmonization_get_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke opd')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_get_hardcopy"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','ambil berkas fisik')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_send_document"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','kirim ke admin')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  else if($request->segment(1)=="harmonization_verification"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','setor berkas fisik')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }   else if($request->segment(1)=="harmonization_done"){
                $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                            ->where('harmonizations.office_id',Auth::user()->office_id)
                            ->where('harmonizations.status','selesai')
                            ->where(function ($query) use ($harmonization) {
                                $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                        ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                            })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
            }  
        }
        
        return view('admin.harmonization.index',compact('title','proposal'));
    }

    ## Detail
   public function detail(Harmonization $harmonization)
   {
        $title = "Harmonisasi";
        $proposal = Proposal::where('id',$harmonization->id)->first();
        $history_taker = History::whereNotNull('taker_name')->where('id',$harmonization->id)->get();
        $history_depositor = History::whereNotNull('depositor_name')->where('id',$harmonization->id)->get();
        $view=view('admin.harmonization.detail', compact('title','harmonization','proposal','history_taker','history_depositor'));
        $view=$view->render();
        return $view;
   }

    ## Admin upload file perbaikan ke OPD
   public function upload_file_fix(Request $request, Harmonization $harmonization)
   {
        $harmonization->fill($request->all());

        if($request->file('upload_fix')){
            $filename = time().'.'.$request->upload_fix->getClientOriginalExtension();
            $request->upload_fix->move(public_path('upload/upload_fix'), $filename);
            $harmonization->upload_fix = $filename;
		}

        $harmonization->status = 'kirim ke opd';
        $harmonization->upload_date = date('Y-m-d');
        $harmonization->save();
       
        return redirect('/harmonizations/')->with('status', 'Dokumen draft perbaikan di kirim ke OPD');
   }

    ## OPD Ambil Berkas Fisik
   public function get_document(Request $request, Harmonization $harmonization)
   {
        $harmonization->fill($request->all());
        $harmonization->status = 'ambil berkas fisik';
        $harmonization->save();

        $history = new History();
        $history->fill($request->all());
        $history->id = $harmonization->id;
        $history->office_id = $harmonization->office_id;
        $history->save();
        
        return redirect('/harmonization_opd/')->with('status', 'Berkas Fisik Di ambil');
   }

   
     ## OPD Kirim perbaikan ke admin
    public function send_document(Request $request, Harmonization $harmonization)
    {
         $harmonization->fill($request->all());
 
         if($request->file('upload_fix')){
             $filename = time().'.'.$request->upload_fix->getClientOriginalExtension();
             $request->upload_fix->move(public_path('upload/upload_fix'), $filename);
             $harmonization->upload_fix = $filename;
         }
 
         $harmonization->status = 'kirim ke admin';
         $harmonization->save();
        
         return redirect('/harmonization_get_hardcopy/')->with('status', 'Data Berhasil Dikirim ke Admin');
    }
 
    ## Setor berkas fisik ke admin 
    public function deposit_document(Request $request, Harmonization $harmonization)
    {
         $harmonization->fill($request->all());
         $harmonization->status = 'setor berkas fisik';
         $harmonization->save();
        
         $history = new History();
         $history->fill($request->all());
         $history->id = $harmonization->id;
         $history->office_id = $harmonization->office_id;
         $history->save();
         
         return redirect('/harmonization_verification/')->with('status', 'Berkas Fisik Di setor');
    }
 
    // ## Verifikasi berkas
    // public function verification(Request $request, Harmonization $harmonization)
    // {
    //      $harmonization->fill($request->all());
    //      $harmonization->status = 'setor berkas fisik';
    //      $harmonization->save();
        
    //      return redirect('/harmonization_verification/')->with('status', 'Berkas Fisik Di setor');
    // }
 
    ## Perbaiki Kembali
    public function fix_again(Request $request, Harmonization $harmonization)
    {
         $harmonization->fill($request->all());
         $harmonization->status = 'perbaiki kembali';
         $harmonization->save();
        
         return redirect('/harmonization_verification/')->with('status', 'Berkas Harus Diperbaiki Kembali');
    }
 
    ## Verifikasi berkas
    public function done(Request $request, Harmonization $harmonization)
    {
         $harmonization->fill($request->all());
         $harmonization->status = 'selesai';
         $harmonization->save();
        
         return redirect('/harmonization_done/')->with('status', 'Selesai');
    }
 
}
