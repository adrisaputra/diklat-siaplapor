<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiHukum;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KonsultasiHukumController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Konsultasi Hukum";
        $konsultasi_hukum = KonsultasiHukum::where('kategori',2)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.konsultasi_hukum.index',compact('title','konsultasi_hukum'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Konsultasi Hukum";
        $konsultasi_hukum = $request->get('search');
        $konsultasi_hukum = KonsultasiHukum::where('kategori',2)
                            ->where(function ($query) use ($konsultasi_hukum) {
                                $query->where('judul', 'LIKE', '%'.$konsultasi_hukum.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$konsultasi_hukum.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$konsultasi_hukum.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.konsultasi_hukum.index',compact('title','konsultasi_hukum'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Konsultasi Hukum";
        $view=view('admin.konsultasi_hukum.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_non_litigasi' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $input['kategori'] = 2;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_non_litigasi')){
			$input['arsip_non_litigasi'] = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
			$request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $input['arsip_non_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        KonsultasiHukum::create($input);

        return redirect('/konsultasi_hukum/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(KonsultasiHukum $konsultasi_hukum)
   {
        $title = "Konsultasi Hukum";
        $view=view('admin.konsultasi_hukum.edit', compact('title','konsultasi_hukum'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, KonsultasiHukum $konsultasi_hukum)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_non_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_non_litigasi') && $konsultasi_hukum->arsip_non_litigasi){
            $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$konsultasi_hukum->arsip_non_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $konsultasi_hukum->fill($request->all());
       
        if($request->file('arsip_non_litigasi')){
            $filename = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
            $request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $filename);
            $konsultasi_hukum->arsip_non_litigasi = $filename;
		}

        $konsultasi_hukum->user_id = Auth::user()->id;
        $konsultasi_hukum->save();
       
        return redirect('/konsultasi_hukum/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(KonsultasiHukum $konsultasi_hukum)
   {
        $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$konsultasi_hukum->arsip_non_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $konsultasi_hukum->delete();
       
        return redirect('/konsultasi_hukum/')->with('status', 'Data Berhasil Dihapus');
   }
}
