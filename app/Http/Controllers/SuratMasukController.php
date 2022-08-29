<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class SuratMasukController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Surat Masuk";
        $surat_masuk = SuratMasuk::orderBy('tanggal_surat','ASC')->paginate(25)->onEachSide(1);
        return view('admin.surat_masuk.index',compact('title','surat_masuk'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Surat Masuk";
        $surat_masuk = $request->get('search');
        $surat_masuk = SuratMasuk::where(function ($query) use ($surat_masuk) {
                                $query->where('nomor_surat', 'LIKE', '%'.$surat_masuk.'%')
                                    ->orWhere('perihal', 'LIKE', '%'.$surat_masuk.'%')
                                    ->orWhere('pengirim', 'LIKE', '%'.$surat_masuk.'%');
                            })
                            ->orderBy('tanggal_surat','ASC')->paginate(25)->onEachSide(1);
        return view('admin.surat_masuk.index',compact('title','surat_masuk'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Surat Masuk";
        $view=view('admin.surat_masuk.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'arsip_surat_masuk' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $input['nomor_surat'] = $request->nomor_surat;
        $input['perihal'] = $request->perihal;
        
        $tgl_surat = substr($request->tanggal_surat,3,2);
        $bln_surat = substr($request->tanggal_surat,0,2);
        $thn_surat = substr($request->tanggal_surat,6,4);
        $input['tanggal_surat'] = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;

        $input['pengirim'] = $request->pengirim;

		if($request->file('arsip_surat_masuk')){
			$input['arsip_surat_masuk'] = time().'.'.$request->arsip_surat_masuk->getClientOriginalExtension();
			$request->arsip_surat_masuk->move(public_path('upload/arsip_surat_masuk'), $input['arsip_surat_masuk']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        SuratMasuk::create($input);

        return redirect('/surat_masuk/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(SuratMasuk $surat_masuk)
   {
        $title = "Surat Masuk";
        $view=view('admin.surat_masuk.edit', compact('title','surat_masuk'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, SuratMasuk $surat_masuk)
   {
        $this->validate($request, [
            'nomor_surat' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'arsip_surat_masuk' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_surat_masuk') && $surat_masuk->arsip_surat_masuk){
            $pathToYourFile = public_path('upload/arsip_surat_masuk/'.$surat_masuk->arsip_surat_masuk);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $surat_masuk->fill($request->all());
       
        $tgl_surat = substr($request->tanggal_surat,3,2);
        $bln_surat = substr($request->tanggal_surat,0,2);
        $thn_surat = substr($request->tanggal_surat,6,4);
        $surat_masuk->tanggal_surat = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;

        if($request->file('arsip_surat_masuk')){
            $filename = time().'.'.$request->arsip_surat_masuk->getClientOriginalExtension();
            $request->arsip_surat_masuk->move(public_path('upload/arsip_surat_masuk'), $filename);
            $surat_masuk->arsip_surat_masuk = $filename;
		}

        $surat_masuk->user_id = Auth::user()->id;
        $surat_masuk->save();
       
        return redirect('/surat_masuk/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(SuratMasuk $surat_masuk)
   {
        $pathToYourFile = public_path('upload/arsip_surat_masuk/'.$surat_masuk->arsip_surat_masuk);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $surat_masuk->delete();
       
        return redirect('/surat_masuk/')->with('status', 'Data Berhasil Dihapus');
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

       $sheet->setCellValue('A1', 'DATA SURAT MASUK'); $sheet->mergeCells('A1:E1');
       $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $sheet->setCellValue('A3', 'NO');
       $sheet->setCellValue('B3', 'TANGGAL');
       $sheet->setCellValue('C3', 'PERIHAL');
       $sheet->setCellValue('D3', 'NOMOR SURAT');
       $sheet->setCellValue('E3', 'ASAL SURAT');
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

       $surat_masuk = SuratMasuk::
                    whereBetween('tanggal_surat', [$tanggal_surat, $tanggal_surat2])
                    ->orderBy('tanggal_surat','ASC')->get();
       
       foreach($surat_masuk as $v){
           $sheet->setCellValue('A' . $rows, $no++);
           $sheet->setCellValue('B' . $rows, date('d-m-Y', strtotime($v->tanggal_surat)));
           $sheet->setCellValue('C' . $rows, $v->perihal);
           $sheet->setCellValue('D' . $rows, $v->nomor_surat);
           $sheet->setCellValue('E' . $rows, $v->pengirim);
           $rows++;
       }
       
       $sheet->getStyle('A3:E'.($rows-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       $sheet->getStyle('A3:E'.($rows-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
       $type = 'xlsx';
       $fileName = "DATA SURAT MASUK.".$type;

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
