<?php

namespace App\Http\Controllers;

use App\Models\PerkaraTataUsahaNegara;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerkaraTataUsahaNegaraController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Perkara Tata Usaha Negara";
        $perkara_tata_usaha_negara = PerkaraTataUsahaNegara::where('kategori',3)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_tata_usaha_negara.index',compact('title','perkara_tata_usaha_negara'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Perkara Tata Usaha Negara";
        $perkara_tata_usaha_negara = $request->get('search');
        $perkara_tata_usaha_negara = PerkaraTataUsahaNegara::where('kategori',3)
                            ->where(function ($query) use ($perkara_tata_usaha_negara) {
                                $query->where('judul', 'LIKE', '%'.$perkara_tata_usaha_negara.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$perkara_tata_usaha_negara.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$perkara_tata_usaha_negara.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_tata_usaha_negara.index',compact('title','perkara_tata_usaha_negara'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Perkara Tata Usaha Negara";
        $view=view('admin.perkara_tata_usaha_negara.create',compact('title'));
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
            'arsip_litigasi' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $input['kategori'] = 3;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_litigasi')){
			$input['arsip_litigasi'] = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
			$request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $input['arsip_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        PerkaraTataUsahaNegara::create($input);

        return redirect('/perkara_tata_usaha_negara/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(PerkaraTataUsahaNegara $perkara_tata_usaha_negara)
   {
        $title = "Perkara Tata Usaha Negara";
        $view=view('admin.perkara_tata_usaha_negara.edit', compact('title','perkara_tata_usaha_negara'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, PerkaraTataUsahaNegara $perkara_tata_usaha_negara)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_litigasi') && $perkara_tata_usaha_negara->arsip_litigasi){
            $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_tata_usaha_negara->arsip_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $perkara_tata_usaha_negara->fill($request->all());
       
        if($request->file('arsip_litigasi')){
            $filename = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
            $request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $filename);
            $perkara_tata_usaha_negara->arsip_litigasi = $filename;
		}

        $perkara_tata_usaha_negara->user_id = Auth::user()->id;
        $perkara_tata_usaha_negara->save();
       
        return redirect('/perkara_tata_usaha_negara/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(PerkaraTataUsahaNegara $perkara_tata_usaha_negara)
   {
        $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_tata_usaha_negara->arsip_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $perkara_tata_usaha_negara->delete();
       
        return redirect('/perkara_tata_usaha_negara/')->with('status', 'Data Berhasil Dihapus');
   }
}
