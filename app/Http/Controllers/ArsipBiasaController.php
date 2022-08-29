<?php

namespace App\Http\Controllers;

use App\Models\ArsipBiasa;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArsipBiasaController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Arsip Biasa";
        $arsip_biasa = ArsipBiasa::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.arsip_biasa.index',compact('title','arsip_biasa'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Arsip Biasa";
        $arsip_biasa = $request->get('search');
        $arsip_biasa = ArsipBiasa::where(function ($query) use ($arsip_biasa) {
                                $query->where('nomor_arsip', 'LIKE', '%'.$arsip_biasa.'%')
                                    ->orWhere('perihal', 'LIKE', '%'.$arsip_biasa.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.arsip_biasa.index',compact('title','arsip_biasa'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Arsip Biasa";
        $view=view('admin.arsip_biasa.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'nomor_arsip' => 'required',
            'perihal' => 'required',
            'tanggal_arsip' => 'required',
            'arsip' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $input['nomor_arsip'] = $request->nomor_arsip;
        $input['perihal'] = $request->perihal;
        
        $tgl_arsip = substr($request->tanggal_arsip,3,2);
        $bln_arsip = substr($request->tanggal_arsip,0,2);
        $thn_arsip = substr($request->tanggal_arsip,6,4);
        $input['tanggal_arsip'] = $thn_arsip.'-'.$bln_arsip.'-'.$tgl_arsip;

		if($request->file('arsip')){
			$input['arsip'] = time().'.'.$request->arsip->getClientOriginalExtension();
			$request->arsip->move(public_path('upload/arsip'), $input['arsip']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        ArsipBiasa::create($input);

        return redirect('/arsip_biasa/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(ArsipBiasa $arsip_biasa)
   {
        $title = "Arsip Biasa";
        $view=view('admin.arsip_biasa.edit', compact('title','arsip_biasa'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, ArsipBiasa $arsip_biasa)
   {
        $this->validate($request, [
            'nomor_arsip' => 'required',
            'perihal' => 'required',
            'tanggal_arsip' => 'required',
            'arsip' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip') && $arsip_biasa->arsip){
            $pathToYourFile = public_path('upload/arsip/'.$arsip_biasa->arsip);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $arsip_biasa->fill($request->all());
       
        $tgl_arsip = substr($request->tanggal_arsip,3,2);
        $bln_arsip = substr($request->tanggal_arsip,0,2);
        $thn_arsip = substr($request->tanggal_arsip,6,4);
        $arsip_biasa->tanggal_arsip = $thn_arsip.'-'.$bln_arsip.'-'.$tgl_arsip;

        if($request->file('arsip')){
            $filename = time().'.'.$request->arsip->getClientOriginalExtension();
            $request->arsip->move(public_path('upload/arsip'), $filename);
            $arsip_biasa->arsip = $filename;
		}

        $arsip_biasa->user_id = Auth::user()->id;
        $arsip_biasa->save();
       
        return redirect('/arsip_biasa/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(ArsipBiasa $arsip_biasa)
   {
        $pathToYourFile = public_path('upload/arsip/'.$arsip_biasa->arsip);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $arsip_biasa->delete();
       
        return redirect('/arsip_biasa/')->with('status', 'Data Berhasil Dihapus');
   }
}
