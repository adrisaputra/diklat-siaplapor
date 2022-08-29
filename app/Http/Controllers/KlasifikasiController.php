<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;   //nama model
use App\Models\SuratKeluar;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KlasifikasiController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Klasifikasi";
        $klasifikasi = Klasifikasi::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.klasifikasi.index',compact('title','klasifikasi'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Klasifikasi";
        $klasifikasi = $request->get('search');
        $klasifikasi = Klasifikasi::where(function ($query) use ($klasifikasi) {
                                $query->where('kode', 'LIKE', '%'.$klasifikasi.'%')
                                    ->orWhere('nama', 'LIKE', '%'.$klasifikasi.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.klasifikasi.index',compact('title','klasifikasi'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Klasifikasi";
        $view=view('admin.klasifikasi.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required'
        ]);

        $input['kode'] = $request->kode;
        $input['nama'] = $request->nama;
        
        Klasifikasi::create($input);

        return redirect('/klasifikasi/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(Klasifikasi $klasifikasi)
   {
        $title = "Klasifikasi";
        $view=view('admin.klasifikasi.edit', compact('title','klasifikasi'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, Klasifikasi $klasifikasi)
   {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required'
        ]);
        
        $klasifikasi->fill($request->all());
        $klasifikasi->save();
       
        return redirect('/klasifikasi/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Klasifikasi $klasifikasi)
   {
        $klasifikasi->delete();
        return redirect('/klasifikasi/')->with('status', 'Data Berhasil Dihapus');
   }

   ## Hapus Data
   public function get_klasifikasi($klasifikasi)
   {

        $klasifikasi = Klasifikasi::where('kode', $klasifikasi)->first();
        $surat_keluar = SuratKeluar::where('kategori','Y')->where('klasifikasi_id', $klasifikasi->id)->orderBy('id','DESC')->first();
        if($surat_keluar){
            return $surat_keluar->nomor_surat;
        } else {
            return NULL;
        }
   }
}
