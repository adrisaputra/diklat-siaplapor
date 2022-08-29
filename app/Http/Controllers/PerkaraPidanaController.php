<?php

namespace App\Http\Controllers;

use App\Models\PerkaraPidana;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerkaraPidanaController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Perkara Pidana";
        $perkara_pidana = PerkaraPidana::where('kategori',1)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_pidana.index',compact('title','perkara_pidana'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Perkara Pidana";
        $perkara_pidana = $request->get('search');
        $perkara_pidana = PerkaraPidana::where('kategori',1)
                            ->where(function ($query) use ($perkara_pidana) {
                                $query->where('judul', 'LIKE', '%'.$perkara_pidana.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$perkara_pidana.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$perkara_pidana.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_pidana.index',compact('title','perkara_pidana'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Perkara Pidana";
        $view=view('admin.perkara_pidana.create',compact('title'));
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

        $input['kategori'] = 1;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_litigasi')){
			$input['arsip_litigasi'] = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
			$request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $input['arsip_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        PerkaraPidana::create($input);

        return redirect('/perkara_pidana/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(PerkaraPidana $perkara_pidana)
   {
        $title = "Perkara Pidana";
        $view=view('admin.perkara_pidana.edit', compact('title','perkara_pidana'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, PerkaraPidana $perkara_pidana)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_litigasi') && $perkara_pidana->arsip_litigasi){
            $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_pidana->arsip_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $perkara_pidana->fill($request->all());
       
        if($request->file('arsip_litigasi')){
            $filename = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
            $request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $filename);
            $perkara_pidana->arsip_litigasi = $filename;
		}

        $perkara_pidana->user_id = Auth::user()->id;
        $perkara_pidana->save();
       
        return redirect('/perkara_pidana/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(PerkaraPidana $perkara_pidana)
   {
        $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_pidana->arsip_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $perkara_pidana->delete();
       
        return redirect('/perkara_pidana/')->with('status', 'Data Berhasil Dihapus');
   }
}
