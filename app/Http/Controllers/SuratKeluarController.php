<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;   //nama model
use App\Models\Klasifikasi;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class SuratKeluarController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Surat Keluar";
        $surat_keluar = SuratKeluar::orderBy('tanggal_surat','ASC')->paginate(25)->onEachSide(1);
        $klasifikasi = Klasifikasi::orderBy('id','DESC')->get();
        return view('admin.surat_keluar.index',compact('title','surat_keluar','klasifikasi'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Surat Keluar";
        $surat_keluar = $request->get('search');
        $klasifikasi_id = $request->get('klasifikasi_id');
        $surat_keluar = SuratKeluar::
                        when(!empty($klasifikasi_id), function ($query) use ($klasifikasi_id) {
                            $query->where('klasifikasi_id',$klasifikasi_id );
                        })
                        ->when(empty($klasifikasi_id), function ($query) use ($surat_keluar) {
                            $query->where('nomor_surat', 'LIKE', '%'.$surat_keluar.'%')
                                    ->orWhere('perihal', 'LIKE', '%'.$surat_keluar.'%')
                                    ->orWhere('tujuan', 'LIKE', '%'.$surat_keluar.'%');
                        })->orderBy('tanggal_surat','ASC')->paginate(25)->onEachSide(1);
        $klasifikasi = Klasifikasi::orderBy('id','DESC')->get();
        return view('admin.surat_keluar.index',compact('title','surat_keluar','klasifikasi'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Surat Keluar";
        $klasifikasi = Klasifikasi::orderBy('id','DESC')->get();
        $view=view('admin.surat_keluar.create',compact('title','klasifikasi'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'klasifikasi_id' => 'required',
            'nomor_surat' => 'required|unique:surat_keluar_tbl',
            'perihal' => 'required',
            'tanggal_surat' => 'required',
            'tujuan' => 'required',
            // 'arsip_surat_keluar' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $klasifikasi = Klasifikasi::where('kode',$request->klasifikasi_id)->first(); 
        $input['klasifikasi_id'] = $klasifikasi->id;
        $input['nomor_surat'] = $request->nomor_surat;
        $input['perihal'] = $request->perihal;
        
        $nomor_surat = substr($request->nomor_surat, -1);
        $check_last_character = is_numeric($nomor_surat);

        if($check_last_character==1){
            $input['kategori'] = 'Y';
        } else {
            $input['kategori'] = 'N';
        }
        
        $tgl_surat = substr($request->tanggal_surat,3,2);
        $bln_surat = substr($request->tanggal_surat,0,2);
        $thn_surat = substr($request->tanggal_surat,6,4);
        $input['tanggal_surat'] = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;

        $input['tujuan'] = $request->tujuan;

		if($request->file('arsip_surat_keluar')){
			$input['arsip_surat_keluar'] = time().'.'.$request->arsip_surat_keluar->getClientOriginalExtension();
			$request->arsip_surat_keluar->move(public_path('upload/arsip_surat_keluar'), $input['arsip_surat_keluar']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        SuratKeluar::create($input);

        return redirect('/surat_keluar/')->with('status','Data Tersimpan');

   }

   ## Tampilkan Form Edit
   public function edit(SuratKeluar $surat_keluar)
   {
        $title = "Surat Keluar";
        $view=view('admin.surat_keluar.edit', compact('title','surat_keluar'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, SuratKeluar $surat_keluar)
   {
        $this->validate($request, [
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required',
            'tujuan' => 'required',
            // 'arsip_surat_keluar' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_surat_keluar') && $surat_keluar->arsip_surat_keluar){
            $pathToYourFile = public_path('upload/arsip_surat_keluar/'.$surat_keluar->arsip_surat_keluar);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $surat_keluar->fill($request->all());
       
        $tgl_surat = substr($request->tanggal_surat,3,2);
        $bln_surat = substr($request->tanggal_surat,0,2);
        $thn_surat = substr($request->tanggal_surat,6,4);
        $surat_keluar->tanggal_surat = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;

        $nomor_surat = substr($request->nomor_surat, -1);
        $check_last_character = is_numeric($nomor_surat);

        if($check_last_character==1){
            $surat_keluar->kategori = 'Y';
        } else {
            $surat_keluar->kategori = 'N';
        }
        
        if($request->file('arsip_surat_keluar')){
            $filename = time().'.'.$request->arsip_surat_keluar->getClientOriginalExtension();
            $request->arsip_surat_keluar->move(public_path('upload/arsip_surat_keluar'), $filename);
            $surat_keluar->arsip_surat_keluar = $filename;
		}

        $surat_keluar->user_id = Auth::user()->id;
        $surat_keluar->save();
       
        return redirect('/surat_keluar/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(SuratKeluar $surat_keluar)
   {
        $pathToYourFile = public_path('upload/arsip_surat_keluar/'.$surat_keluar->arsip_surat_keluar);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $surat_keluar->delete();
       
        return redirect('/surat_keluar/')->with('status', 'Data Berhasil Dihapus');
   }

    ## Tampilkan Data Search
    public function report_excel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(10);
		$sheet->getColumnDimension('B')->setWidth(22);
		$sheet->getColumnDimension('C')->setWidth(40);
		$sheet->getColumnDimension('D')->setWidth(40);
		$sheet->getColumnDimension('E')->setWidth(40);

        $sheet->setCellValue('A1', 'DATA SURAT KELUAR'); $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'PERIHAL');
        $sheet->setCellValue('D3', 'NOMOR SURAT');
        $sheet->setCellValue('E3', 'TUJUAN');
        $rows = 4;
        $no = 1;
    
        $tgl = substr($request->daterange,3,2);
        $bln = substr($request->daterange,0,2);
        $thn = substr($request->daterange,6,4);
        $tanggal_surat = $thn.'-'.$bln.'-'.$tgl;

        $tgl2 = substr($request->daterange,16,2);
        $bln2 = substr($request->daterange,13,2);
        $thn2 = substr($request->daterange,19,4);
        $tanggal_surat2 = $thn2.'-'.$bln2.'-'.$tgl2;

        $klasifikasi_id = $request->get('klasifikasi_id');
        $surat_keluar = SuratKeluar::
                        whereBetween('tanggal_surat', [$tanggal_surat, $tanggal_surat2])
                        ->when(!empty($klasifikasi_id), function ($query) use ($klasifikasi_id) {
                            $query->where('klasifikasi_id',$klasifikasi_id );
                        })->orderBy('tanggal_surat','ASC')->get();
        
        foreach($surat_keluar as $v){
            $sheet->setCellValue('A' . $rows, $no++);
            $sheet->setCellValue('B' . $rows, date('d-m-Y', strtotime($v->tanggal_surat)));
            $sheet->setCellValue('C' . $rows, $v->perihal);
            $sheet->setCellValue('D' . $rows, $v->nomor_surat);
            $sheet->setCellValue('E' . $rows, $v->tujuan);
            $rows++;
        }
        
        $sheet->getStyle('A3:E'.($rows-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A3:E'.($rows-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $type = 'xlsx';
        $fileName = "DATA SURAT KELUAR.".$type;

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
