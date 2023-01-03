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

class RecapController extends Controller
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
            $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                        ->where('harmonizations.status','selesai')->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
        } else {
            $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                        ->where('harmonizations.office_id',Auth::user()->office_id)
                        ->where('harmonizations.status','selesai')
                        ->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.recap.index',compact('title','proposal'));
    }

    ## Tampikan Data
    public function search(Request $request)
    {
        $title = "Usulan";
        $harmonization = $request->get('search');

        if(Auth::user()->group == 1 || Auth::user()->group == 2){
            $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                        ->where('harmonizations.status','selesai')
                        ->where(function ($query) use ($harmonization) {
                            $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                    ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                    ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                        })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
        } else {
            $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                        ->where('harmonizations.office_id',Auth::user()->office_id)
                        ->where('harmonizations.status','selesai')
                        ->where(function ($query) use ($harmonization) {
                            $query->where('date', 'LIKE', '%'.$harmonization.'%')
                                    ->orWhere('type', 'LIKE', '%'.$harmonization.'%')
                                    ->orWhere('about', 'LIKE', '%'.$harmonization.'%');
                        })->orderBy('proposals.id','DESC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.recap.index',compact('title','proposal'));
    }

   public function print(Request $request)
   {
       $spreadsheet = new Spreadsheet();
       $spreadsheet->setActiveSheetIndex(0);
       $sheet = $spreadsheet->getActiveSheet();

       $sheet->getColumnDimension('A')->setWidth(5);
       $sheet->getColumnDimension('B')->setWidth(25);
       $sheet->getColumnDimension('C')->setWidth(25);
       $sheet->getColumnDimension('D')->setWidth(25);
       $sheet->getColumnDimension('E')->setWidth(25);
       $sheet->getColumnDimension('F')->setWidth(25);
       $sheet->getColumnDimension('G')->setWidth(25);
       $sheet->getColumnDimension('H')->setWidth(25);
       $sheet->getColumnDimension('I')->setWidth(33);
       $sheet->getColumnDimension('J')->setWidth(25);
       $sheet->getColumnDimension('K')->setWidth(25);

       $sheet->setCellValue('A1', 'DATA REKAP'); $sheet->mergeCells('A1:K1');
       $sheet->getStyle("A1")->getFont()->setSize(16);
       $sheet->getStyle('A1')->getFont()->setBold(true);
       $sheet->getStyle('A1:K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $sheet->setCellValue('A3', 'NO');$sheet->mergeCells('A3:A4');
       $sheet->getStyle('A3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

       $sheet->setCellValue('B3', 'TENTANG');$sheet->mergeCells('B3:B4');
       $sheet->getStyle('B3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

       $sheet->setCellValue('C3', 'ASAL INSTANSI');$sheet->mergeCells('C3:C4');
       $sheet->getStyle('C3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

       $sheet->setCellValue('D3', 'TANGGAL MASUK SURAT');$sheet->mergeCells('D3:D4');
       $sheet->getStyle('D3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

       $sheet->setCellValue('E3', 'TANGGAL DISPOSISI KARO');$sheet->mergeCells('E3:E4');
       $sheet->getStyle('E3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
       
       $sheet->setCellValue('F3', 'TANGGAL DISPOSISI KABAG');$sheet->mergeCells('F3:F4');
       $sheet->getStyle('F3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
       
       $sheet->setCellValue('G3', 'HASIL KOREKSI');$sheet->mergeCells('G3:H3');
       $sheet->setCellValue('G4', 'TANGGAL KOREKSI');
       $sheet->setCellValue('H4', 'TANGGAL KOREKSI');

       $sheet->setCellValue('I3', 'PEJABAT YANG MENANDATANGANI');$sheet->mergeCells('I3:I4');
       $sheet->getStyle('I3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
       
       $sheet->setCellValue('J3', 'SK FINAL');$sheet->mergeCells('J3:K3');
       $sheet->setCellValue('J4', 'PENERIMA');
       $sheet->setCellValue('K4', 'TANGGAL');
       $sheet->getStyle('A3:K4')->getFont()->setBold(true);
       $rows = 5;
       $no = 1;
   
       $proposal = Proposal::join('harmonizations', 'proposals.id', '=', 'harmonizations.id')
                        ->where('harmonizations.status','selesai')->orderBy('proposals.id','DESC')->get();
       
       foreach($proposal as $v){
        
            $harmonization = DB::table('harmonizations')->where('id', $v->id)->first();

            $sheet->setCellValue('A' . $rows, $no++);
            $sheet->setCellValue('B' . $rows, $v->about);
            $sheet->setCellValue('C' . $rows, $v->office->name);
            $sheet->setCellValue('D' . $rows, date('d-m-Y', strtotime($v->date)));
            $sheet->setCellValue('E' . $rows, date('d-m-Y', strtotime($v->date_disposition1)));
            $sheet->setCellValue('F' . $rows, date('d-m-Y', strtotime($v->date_disposition3)));
            $sheet->setCellValue('G' . $rows, date('d-m-Y', strtotime($harmonization->upload_date)));
            $rows++;
       }
       
       $sheet->getStyle('A3:K'.($rows-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('A3:K'.($rows-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $type = 'xlsx';
       $fileName = "DATA REKAP.".$type;

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
