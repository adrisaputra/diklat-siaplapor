<?php

namespace App\Http\Controllers;

use App\Models\PenangananUnjukRasa;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenangananUnjukRasaController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Penanganan Unjuk Rasa";
        $penanganan_unjuk_rasa = PenangananUnjukRasa::where('kategori',3)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.penanganan_unjuk_rasa.index',compact('title','penanganan_unjuk_rasa'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Penanganan Unjuk Rasa";
        $penanganan_unjuk_rasa = $request->get('search');
        $penanganan_unjuk_rasa = PenangananUnjukRasa::where('kategori',3)
                            ->where(function ($query) use ($penanganan_unjuk_rasa) {
                                $query->where('judul', 'LIKE', '%'.$penanganan_unjuk_rasa.'%')
                                    ->orWhere('deskripsi', 'LIKE', '%'.$penanganan_unjuk_rasa.'%')
                                    ->orWhere('tahun', 'LIKE', '%'.$penanganan_unjuk_rasa.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.penanganan_unjuk_rasa.index',compact('title','penanganan_unjuk_rasa'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Penanganan Unjuk Rasa";
        $view=view('admin.penanganan_unjuk_rasa.create',compact('title'));
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

        $input['kategori'] = 3;
        $input['judul'] = $request->judul;
        $input['deskripsi'] = $request->deskripsi;
        $input['tahun'] = $request->tahun;

		if($request->file('arsip_non_litigasi')){
			$input['arsip_non_litigasi'] = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
			$request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $input['arsip_non_litigasi']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        PenangananUnjukRasa::create($input);

        return redirect('/penanganan_unjuk_rasa/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(PenangananUnjukRasa $penanganan_unjuk_rasa)
   {
        $title = "Penanganan Unjuk Rasa";
        $view=view('admin.penanganan_unjuk_rasa.edit', compact('title','penanganan_unjuk_rasa'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, PenangananUnjukRasa $penanganan_unjuk_rasa)
   {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tahun' => 'required',
            'arsip_non_litigasi' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_non_litigasi') && $penanganan_unjuk_rasa->arsip_non_litigasi){
            $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$penanganan_unjuk_rasa->arsip_non_litigasi);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $penanganan_unjuk_rasa->fill($request->all());
       
        if($request->file('arsip_non_litigasi')){
            $filename = time().'.'.$request->arsip_non_litigasi->getClientOriginalExtension();
            $request->arsip_non_litigasi->move(public_path('upload/arsip_non_litigasi'), $filename);
            $penanganan_unjuk_rasa->arsip_non_litigasi = $filename;
		}

        $penanganan_unjuk_rasa->user_id = Auth::user()->id;
        $penanganan_unjuk_rasa->save();
       
        return redirect('/penanganan_unjuk_rasa/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(PenangananUnjukRasa $penanganan_unjuk_rasa)
   {
        $pathToYourFile = public_path('upload/arsip_non_litigasi/'.$penanganan_unjuk_rasa->arsip_non_litigasi);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $penanganan_unjuk_rasa->delete();
       
        return redirect('/penanganan_unjuk_rasa/')->with('status', 'Data Berhasil Dihapus');
   }
}
