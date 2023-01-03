<?php

namespace App\Http\Controllers;

use App\Models\Proposal;   //nama model
use App\Models\Harmonization;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ProposalController extends Controller
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
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('status','Masuk')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('status','Proses')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_done"){
                $proposal = Proposal::where('status','Selesai')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        } else {
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Masuk')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_revision"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Perbaiki')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Proses')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_done"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Selesai')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        }
        
        return view('admin.proposal.index',compact('title','proposal'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Usulan";
        $proposal = $request->get('search');

        if(Auth::user()->group == 1 || Auth::user()->group == 2){
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('status','Masuk')
                                ->where(function ($query) use ($proposal) {
                                    $query->where('date', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('status','Proses')
                                ->where(function ($query) use ($proposal) {
                                    $query->where('date', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        } else {
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Masuk')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_revision"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Perbaiki')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Proses')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        }
        
        return view('admin.proposal.index',compact('title','proposal'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Usulan";
        $view=view('admin.proposal.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'date' => 'required',
            'type' => 'required',
            'about' => 'required',
            'responsible_person' => 'required',
            'whatsapp' => 'required',
            'cover_letter' => 'required|mimes:jpg,jpeg,png,pdf|max:50000',
            'review_staff' => 'required|mimes:jpg,jpeg,png,pdf|max:50000',
            'official_memo' => 'required|mimes:jpg,jpeg,png,pdf|max:50000',
            'approval_concept' => 'required|mimes:jpg,jpeg,png,pdf|max:50000',
            'draft' => 'required|mimes:doc,docx,xlsx|max:50000'
        ]);

        $proposal = New Proposal();
        $proposal->office_id = Auth::user()->office_id;
        $proposal->date = $request->date;
        $proposal->type = $request->type;
        $proposal->about = $request->about;
        $proposal->responsible_person = $request->responsible_person;
        $proposal->whatsapp = $request->whatsapp;
        
		if($request->file('cover_letter')){
			$proposal->cover_letter = time().'.'.$request->cover_letter->getClientOriginalExtension();
			$request->cover_letter->move(public_path('upload/cover_letter'), $proposal->cover_letter);
    	}	
		
		if($request->file('review_staff')){
			$proposal->review_staff = time().'.'.$request->review_staff->getClientOriginalExtension();
			$request->review_staff->move(public_path('upload/review_staff'), $proposal->review_staff);
    	}	
		
		if($request->file('official_memo')){
			$proposal->official_memo = time().'.'.$request->official_memo->getClientOriginalExtension();
			$request->official_memo->move(public_path('upload/official_memo'), $proposal->official_memo);
    	}	
		
		if($request->file('approval_concept')){
			$proposal->approval_concept = time().'.'.$request->approval_concept->getClientOriginalExtension();
			$request->approval_concept->move(public_path('upload/approval_concept'), $proposal->approval_concept);
    	}	
		
		if($request->file('draft')){
			$proposal->draft = time().'.'.$request->draft->getClientOriginalExtension();
			$request->draft->move(public_path('upload/draft'), $proposal->draft);
    	}	
		
        $proposal->save();

        $harmonization = New Harmonization();
        $harmonization->id = $proposal->id;
        $harmonization->office_id = Auth::user()->office_id;
        $harmonization->save();

        return redirect('/proposal_income/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.edit', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, Proposal $proposal)
   {
        $this->validate($request, [
            'date' => 'required',
            'type' => 'required',
            'about' => 'required',
            'responsible_person' => 'required',
            'whatsapp' => 'required',
            'cover_letter' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'review_staff' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'official_memo' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'approval_concept' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'draft' => 'mimes:doc,docx,xlsx|max:100000'
        ]);
        
        if($request->file('cover_letter') && $proposal->cover_letter){
            $pathToYourFile = public_path('upload/cover_letter/'.$proposal->cover_letter);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('review_staff') && $proposal->review_staff){
            $pathToYourFile = public_path('upload/review_staff/'.$proposal->review_staff);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('official_memo') && $proposal->official_memo){
            $pathToYourFile = public_path('upload/official_memo/'.$proposal->official_memo);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('approval_concept') && $proposal->approval_concept){
            $pathToYourFile = public_path('upload/approval_concept/'.$proposal->approval_concept);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('draft') && $proposal->draft){
            $pathToYourFile = public_path('upload/draft/'.$proposal->draft);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $proposal->fill($request->all());

        if($request->file('cover_letter')){
            $filename = time().'.'.$request->cover_letter->getClientOriginalExtension();
            $request->cover_letter->move(public_path('upload/cover_letter'), $filename);
            $proposal->cover_letter = $filename;
		}

        if($request->file('review_staff')){
            $filename = time().'.'.$request->review_staff->getClientOriginalExtension();
            $request->review_staff->move(public_path('upload/review_staff'), $filename);
            $proposal->review_staff = $filename;
		}

        if($request->file('official_memo')){
            $filename = time().'.'.$request->official_memo->getClientOriginalExtension();
            $request->official_memo->move(public_path('upload/official_memo'), $filename);
            $proposal->official_memo = $filename;
		}

        if($request->file('approval_concept')){
            $filename = time().'.'.$request->approval_concept->getClientOriginalExtension();
            $request->approval_concept->move(public_path('upload/approval_concept'), $filename);
            $proposal->approval_concept = $filename;
		}

        if($request->file('draft')){
            $filename = time().'.'.$request->draft->getClientOriginalExtension();
            $request->draft->move(public_path('upload/draft'), $filename);
            $proposal->draft = $filename;
		}
        $proposal->status = 'Masuk';
        $proposal->save();
       
        return redirect('/proposal_revision/')->with('status', 'Data Berhasil Diperbaiki');
   }

   
   ## Verifikasi Data
   public function verification(Request $request, Proposal $proposal)
   {
        $this->validate($request, [
            'status1' => 'required',
            'status2' => 'required',
            'status3' => 'required',
            'status4' => 'required',
            'status5' => 'required',
        ]);
        
        $proposal->fill($request->all());
        if($request->status1=="Lengkap" && $request->status2=="Lengkap" && $request->status3=="Lengkap" && $request->status4=="Lengkap" && $request->status5=="Lengkap"){
            $proposal->status = 'Proses';
        } else {
            $proposal->status = 'Perbaiki';
        }

        $proposal->save();
       
        return redirect('/proposal_income/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Proposal $proposal)
   {
        $proposal->delete();
        return redirect('/proposal/')->with('status', 'Data Berhasil Dihapus');
   }

   
   ## Detail
   public function detail(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.detail', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

   ## Lembar Kontrol
   public function control_sheet(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.control_sheet', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

   ## Tampilkan Form Create
   public function disposition(Proposal $proposal)
   {
        $title = "Disposisi";
        $view=view('admin.proposal.disposisi',compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

    ## Edit Data
    public function disposition_update(Request $request, Proposal $proposal)
    {
        
        $proposal->fill($request->all());
        if($request->date_disposition1 != NULL 
            && $request->date_disposition2 != NULL 
            && $request->date_disposition3 != NULL 
            && $request->date_disposition4 != NULL 
            && $request->date_disposition5 != NULL){
            $proposal->status = "Selesai";
            $proposal->save();
        
            $harmonization = Harmonization::where('id',$proposal->id)->first();
            $harmonization->status = 'perbaikan';
            $harmonization->save();

            return redirect('/proposal_done/')->with('status', 'Data Berhasil Disimpan');
        } else {
            
            $proposal->save();
            return redirect('/proposal_process/')->with('status', 'Data Berhasil Disimpan');
        }
        
    }

   ## Download Lembar Kontrol
   public function disposition_sheet(Proposal $proposal)
   {
       $spreadsheet = new Spreadsheet();
       $spreadsheet->setActiveSheetIndex(0);
       $sheet = $spreadsheet->getActiveSheet();

       $sheet->getColumnDimension('A')->setWidth(4);
       $sheet->getColumnDimension('B')->setWidth(1);
       $sheet->getColumnDimension('C')->setWidth(6);
       $sheet->getColumnDimension('D')->setWidth(1);
       $sheet->getColumnDimension('E')->setWidth(7);
       $sheet->getColumnDimension('F')->setWidth(28);
       $sheet->getColumnDimension('G')->setWidth(2);
       $sheet->getColumnDimension('H')->setWidth(15);
       $sheet->getColumnDimension('I')->setWidth(12);
       $sheet->getColumnDimension('J')->setWidth(6);

       $sheet->setCellValue('B1', 'BIRO HUKUM'); $sheet->mergeCells('B1:J1');
       $sheet->getStyle('B1')->getFont()->setBold(true);
       $sheet->getStyle('B1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $sheet->setCellValue('B2', 'PROVINSI SULAWESI TENGGARA'); $sheet->mergeCells('B2:J2');
       $sheet->getStyle('B2')->getFont()->setBold(true);
       $sheet->getStyle('B2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $sheet->setCellValue('B3', 'LEMBAR DISPOSISI'); $sheet->mergeCells('B3:J3');
       $sheet->getStyle('B3')->getFont()->setBold(true);
       $sheet->getStyle('B3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $sheet->setCellValue('C5', 'Surat Dari'); $sheet->mergeCells('C5:E5');
       $sheet->setCellValue('C6', 'Tanggal Surat'); $sheet->mergeCells('C6:E6');
       $sheet->setCellValue('C7', 'Nomor Surat'); $sheet->mergeCells('C7:E7');
       
       $sheet->setCellValue('F5', ': '.$proposal->office->name); 
       $sheet->setCellValue('F6', ': '); 
       $sheet->setCellValue('F7', ': '); 
       
       $sheet->setCellValue('H5', 'Diterima Tanggal'); 
       $sheet->setCellValue('H6', 'Nomor Agenda'); 
       $sheet->setCellValue('H7', 'Sifat Surat'); 
       
       $sheet->setCellValue('I5', ': '); 
       $sheet->setCellValue('I6', ': '); 
       $sheet->setCellValue('I7', ': RAHASIA / SANGAT'); 
       $sheet->getStyle('I7')->getFont()->setBold(true);
       $sheet->setCellValue('I8', '  SEGERA / SEGERA'); 
       $sheet->getStyle('I8')->getFont()->setBold(true);
       
       $sheet->setCellValue('C10', 'DISAMPAIKAN DAN DITERUSKAN KEPADA :'); 
       $sheet->setCellValue('H10', 'C A T A T A N'); 
       $sheet->getStyle('H10')->getFont()->setUnderline(true);

       $sheet->setCellValue('E12', 'KABAG. PERATURAN PERUNDANG-'); 
       $sheet->getStyle('E12')->getFont()->setBold(true);
       $sheet->setCellValue('E13', 'UNDANGAN KAB/KOTA'); 
       $sheet->getStyle('E13')->getFont()->setBold(true);
       $sheet->setCellValue('E14', '(SOEGIHARTO PIDANI, SH)'); 

       $sheet->setCellValue('E16', 'KABAG. BANTUAN HUKUM DAN HAM'); 
       $sheet->getStyle('E16')->getFont()->setBold(true);
       $sheet->setCellValue('E17', '(I NENGAH SUARYO, SH,MH)'); 

       $sheet->setCellValue('E19', 'PERANCANG PERATURAN PERUNDANG-'); 
       $sheet->getStyle('E19')->getFont()->setBold(true);
       $sheet->setCellValue('E20', 'UNDANGAN AHLI MADYA'); 
       $sheet->getStyle('E20')->getFont()->setBold(true);
       $sheet->setCellValue('E21', '(H. ABDUL RAKIL NABA, SH.,MH)'); 

       $sheet->mergeCells('C12:C13');
       $sheet->mergeCells('C16:C17');
       $sheet->mergeCells('C19:C20');

       $sheet->setCellValue('C23', 'D I S P O S I S I :'); 
       $sheet->setCellValue('C25', '1.'); 
       $sheet->setCellValue('C26', '2.'); 
       $sheet->setCellValue('C27', '3.'); 
       $sheet->setCellValue('C28', '4.'); 
       $sheet->setCellValue('C29', '5.'); 
       $sheet->setCellValue('C30', '6.'); 
       $sheet->setCellValue('C31', '7.'); 
       $sheet->setCellValue('C32', '8.'); 
       $sheet->setCellValue('C35', '9.'); 

       $sheet->setCellValue('E25', 'Telaah/Beri Penjelasan'); 
       $sheet->setCellValue('E26', 'Koordinasikan/Konfirmasikan'); 
       $sheet->setCellValue('E27', 'Proses Lebih Lanjut/Ditindak Lanjuti.'); 
       $sheet->setCellValue('E28', 'Koreksi/Sempurnakan'); 
       $sheet->setCellValue('E29', 'Buatkan Laporan Kepada Pimpinan'); 
       $sheet->setCellValue('E30', 'Buatkan Laporan/Jawaban/Saran'); 
       $sheet->setCellValue('E31', 'M o n i t o r'); 
       $sheet->setCellValue('E32', 'Koordinasikan Lebih Lanjut dengan'); 
       $sheet->setCellValue('E33', 'Untuk diketahui/Dipedomankan/Menjadi'); 
       $sheet->setCellValue('E34', 'Petunjuk.'); 
       $sheet->setCellValue('E35', 'Simpan Sebagai Bahan'); 

       $sheet->setCellValue('G26', 'Tanda Tangan/Paraf'); $sheet->mergeCells('G26:J26');
       $sheet->getStyle('G26:J26')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $sheet->setCellValue('G27', 'KEPALA BIRO HUKUM'); $sheet->mergeCells('G27:J27');
       $sheet->getStyle('G27:J27')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $sheet->setCellValue('G28', 'PROVINSI SULAWESI TENGGARA'); $sheet->mergeCells('G28:J28');
       $sheet->getStyle('G28:J28')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $sheet->setCellValue('G31', 'H. KAMARI, SH'); $sheet->mergeCells('G31:J31');
       $sheet->getStyle('G31')->getFont()->setBold(true);
       $sheet->getStyle('G31:J31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $sheet->setCellValue('G32', 'Pembina Utama Muda, Gol. IV/C'); $sheet->mergeCells('G32:J32');
       $sheet->getStyle('G32:J32')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $sheet->setCellValue('G33', 'Nip. 19621211 198803 1 001'); $sheet->mergeCells('G33:J33');
       $sheet->getStyle('G33:J33')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       
       $sheet->getStyle('B5:F5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('G5:J5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getStyle('B6:F6')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('G6:J6')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getStyle('B7:F8')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('G7:J8')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getStyle('C12:C13')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('C16:C17')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('C19:C20')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getStyle('B9:F36')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getStyle('G9:J36')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


       $type = 'xlsx';
       $fileName = "LEMBAR DISPOSISI.".$type;

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
