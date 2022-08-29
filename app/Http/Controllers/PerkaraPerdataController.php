<?php

namespace App\Http\Controllers;

use App\Models\PerkaraPerdata;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerkaraPerdataController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Perkara Perdata";
        $perkara_perdata = PerkaraPerdata::where('kategori',2)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_perdata.index',compact('title','perkara_perdata'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Perkara Perdata";
        $perkara_perdata = $request->get('search');
        $perkara_perdata = PerkaraPerdata::where('kategori',2)
                            ->where(function ($query) use ($perkara_perdata) {
                                $query->where('judul', 'LIKE', '%'.$perkara_perdata.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$perkara_perdata.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$perkara_perdata.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.perkara_perdata.index',compact('title','perkara_perdata'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Perkara Perdata";
        $view=view('admin.perkara_perdata.create',compact('title'));
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

        $input['kategori'] = 2;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_litigasi')){
			$input['arsip_litigasi'] = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
			$request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $input['arsip_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        PerkaraPerdata::create($input);

        return redirect('/perkara_perdata/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(PerkaraPerdata $perkara_perdata)
   {
        $title = "Perkara Perdata";
        $view=view('admin.perkara_perdata.edit', compact('title','perkara_perdata'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, PerkaraPerdata $perkara_perdata)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_litigasi') && $perkara_perdata->arsip_litigasi){
            $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_perdata->arsip_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $perkara_perdata->fill($request->all());
       
        if($request->file('arsip_litigasi')){
            $filename = time().'.'.$request->arsip_litigasi->getClientOriginalExtension();
            $request->arsip_litigasi->move(public_path('upload/arsip_litigasi'), $filename);
            $perkara_perdata->arsip_litigasi = $filename;
		}

        $perkara_perdata->user_id = Auth::user()->id;
        $perkara_perdata->save();
       
        return redirect('/perkara_perdata/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(PerkaraPerdata $perkara_perdata)
   {
        $pathToYourFile = public_path('upload/arsip_litigasi/'.$perkara_perdata->arsip_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $perkara_perdata->delete();
       
        return redirect('/perkara_perdata/')->with('status', 'Data Berhasil Dihapus');
   }
}
