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
        $history = History::where('id',$harmonization->id)->get();
        $view=view('admin.harmonization.detail', compact('title','harmonization','proposal','history'));
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

    ## Cetak Data
    public function print(Proposal $proposal)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(24);
        $sheet->getColumnDimension('C')->setWidth(14);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(14);
        $sheet->getRowDimension('18')->setRowHeight(48);

        $sheet->setCellValue('A1', 'LEMBAR KONTROL'); $sheet->mergeCells('A1:F1');
        $sheet->getStyle("A1")->getFont()->setSize(16);
        $sheet->getStyle("A1")->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A3', 'OPD/BIRO');
        $sheet->setCellValue('A4', 'NO. AGENDA REGISTRASI');
        $sheet->setCellValue('A5', 'TANGGAL MASUK SK');
        $sheet->setCellValue('A6', 'TENTANG');

        $sheet->setCellValue('C3', ': '.$proposal->office->name);
        $sheet->setCellValue('C4', ':');
        $sheet->setCellValue('C5', ': '.date('d-m-Y', strtotime($proposal->date)));
        $sheet->setCellValue('C6', ': '.$proposal->about);

        $sheet->setCellValue('A9', 'NO');
        $sheet->setCellValue('B9', 'KELENGKAPAN PELAYANAN');
        $sheet->setCellValue('C9', 'ADA');
        $sheet->setCellValue('D9', 'TIDAK');
        $sheet->setCellValue('E9', 'KETERANGAN');
        $sheet->mergeCells('E9:F9');
        $sheet->getStyle('A9:F9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A10', '1');
        $sheet->setCellValue('B10', 'Surat Pengantar');
        if($proposal->status1=="Lengkap"){
            $sheet->setCellValue('C10', 'v');
        }
        if($proposal->status1=="Tidak Lengkap"){
            $sheet->setCellValue('D10', 'v');
        }
        if($proposal->status1=="Tidak Lengkap"){
            $sheet->setCellValue('E10', $proposal->desc1);
        }
        $sheet->mergeCells('E10:F10');

        # 2
        $sheet->setCellValue('A11', '2');
        $sheet->setCellValue('B11', 'Telaah Staf');
        if($proposal->status2=="Lengkap"){
            $sheet->setCellValue('C11', 'v');
        }
        if($proposal->status2=="Tidak Lengkap"){
            $sheet->setCellValue('D11', 'v');
        }
        if($proposal->status2=="Tidak Lengkap"){
            $sheet->setCellValue('E11', $proposal->desc2);
        }
        $sheet->mergeCells('E11:F11');

        # 3
        $sheet->setCellValue('A12', '3');
        $sheet->setCellValue('B12', 'Nota Dinas');
        if($proposal->status3=="Lengkap"){
            $sheet->setCellValue('C12', 'v');
        }
        if($proposal->status3=="Tidak Lengkap"){
            $sheet->setCellValue('D12', 'v');
        }
        if($proposal->status3=="Tidak Lengkap"){
            $sheet->setCellValue('E12', $proposal->desc3);
        }
        $sheet->mergeCells('E12:F12');

        # 4
        $sheet->setCellValue('A13', '4');
        $sheet->setCellValue('B13', 'Konsep Persetujuan Naskah Dinas');
        if($proposal->status4=="Lengkap"){
            $sheet->setCellValue('C13', 'v');
        }
        if($proposal->status4=="Tidak Lengkap"){
            $sheet->setCellValue('D13', 'v');
        }
        if($proposal->status4=="Tidak Lengkap"){
            $sheet->setCellValue('E13', $proposal->desc4);
        }
        $sheet->mergeCells('E13:F13');

        # 5
        $sheet->setCellValue('A14', '5');
        $sheet->setCellValue('B14', 'Draft SK/Pergub/Perda');
        if($proposal->status5=="Lengkap"){
            $sheet->setCellValue('C14', 'v');
        }
        if($proposal->status5=="Tidak Lengkap"){
            $sheet->setCellValue('D14', 'v');
        }
        if($proposal->status5=="Tidak Lengkap"){
            $sheet->setCellValue('E14', $proposal->desc5);
        }
        $sheet->mergeCells('E14:F14');

        $sheet->getStyle('A9:F14')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A9:F14')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A16', 'RIWAYAT HARMONISASI'); $sheet->mergeCells('A16:F16');
        $sheet->getStyle("A16")->getFont()->setSize(16);
        $sheet->getStyle("A16")->getFont()->setBold(true);
        $sheet->getStyle('A16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A18', 'NO');
        $sheet->setCellValue('B18', 'NAMA/NOMOR HP');
        $sheet->setCellValue('C18', 'TANGGAL PENGAMBILAN');
        $sheet->getStyle('C18')->getAlignment()->setWrapText(true); 
        $sheet->setCellValue('D18', 'PARAF OPD');
        $sheet->setCellValue('E18', 'TANGGAL PENGEMBALIAN');
        $sheet->getStyle('E18')->getAlignment()->setWrapText(true); 
        $sheet->setCellValue('F18', 'PARAF BIRO HUKUM');
        $sheet->getStyle('F18')->getAlignment()->setWrapText(true); 
        $sheet->getStyle('A18:F18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A18:F18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A18:F18')->getAlignment()->setHorizontal('center');

        $rows = 19;
        $no = 1;
    
        $history = History::where('id',$proposal->id)->get();
        
        foreach($history as $v){
            $sheet->setCellValue('A' . $rows, $no++);
            if($v->taker_name){
                $sheet->setCellValue('B' . $rows, $v->taker_name);
            } else {
                $sheet->setCellValue('B' . $rows, $v->depositor_name);
            }
            if($v->taker_date!=NULL) {
                $sheet->setCellValue('C' . $rows, date('d-m-Y', strtotime($v->taker_date)));
            }
            if($v->depositor_date!=NULL) {
                $sheet->setCellValue('E' . $rows, date('d-m-Y', strtotime($v->depositor_date)));
            }
            $rows++;
        }
        
        $sheet->getStyle('A18:F'.($rows-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A18:F'.($rows-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $type = 'xlsx';
        $fileName = "LEMBAR KONTROL.".$type;

        if($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if($type == 'xls') {
            $writer = new Xls($spreadsheet);			
        }		
        $writer->save("public/upload/report/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/')."/public/upload/report/".$fileName);    

    }
 
}
