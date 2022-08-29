<?php

namespace App\Http\Controllers;

use App\Models\PengaduanHukum;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaduanHukumController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Pengaduan Hukum";
        $pengaduan_hukum = PengaduanHukum::where('kategori',1)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.pengaduan_hukum.index',compact('title','pengaduan_hukum'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Pengaduan Hukum";
        $pengaduan_hukum = $request->get('search');
        $pengaduan_hukum = PengaduanHukum::where('kategori',1)
                            ->where(function ($query) use ($pengaduan_hukum) {
                                $query->where('judul', 'LIKE', '%'.$pengaduan_hukum.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$pengaduan_hukum.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$pengaduan_hukum.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.pengaduan_hukum.index',compact('title','pengaduan_hukum'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Pengaduan Hukum";
        $view=view('admin.pengaduan_hukum.create',compact('title'));
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

        $input['kategori'] = 1;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_non_litigasi')){
			$input['arsip_non_litigasi'] = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
			$request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $input['arsip_non_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        PengaduanHukum::create($input);

        return redirect('/pengaduan_hukum/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(PengaduanHukum $pengaduan_hukum)
   {
        $title = "Pengaduan Hukum";
        $view=view('admin.pengaduan_hukum.edit', compact('title','pengaduan_hukum'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, PengaduanHukum $pengaduan_hukum)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_non_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_non_litigasi') && $pengaduan_hukum->arsip_non_litigasi){
            $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$pengaduan_hukum->arsip_non_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $pengaduan_hukum->fill($request->all());
       
        if($request->file('arsip_non_litigasi')){
            $filename = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
            $request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $filename);
            $pengaduan_hukum->arsip_non_litigasi = $filename;
		}

        $pengaduan_hukum->user_id = Auth::user()->id;
        $pengaduan_hukum->save();
       
        return redirect('/pengaduan_hukum/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(PengaduanHukum $pengaduan_hukum)
   {
        $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$pengaduan_hukum->arsip_non_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $pengaduan_hukum->delete();
       
        return redirect('/pengaduan_hukum/')->with('status', 'Data Berhasil Dihapus');
   }
}
