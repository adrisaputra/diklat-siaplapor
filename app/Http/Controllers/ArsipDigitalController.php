<?php

namespace App\Http\Controllers;

use App\Models\ArsipDigital;   //nama model
use App\Models\Pegawai;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArsipDigitalController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index($id)
    {
        if(Auth::user()->group==1){
            $title = "Arsip Digital";
            $arsip_digital = ArsipDigital::where('pegawai_id',$id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            $pegawai = Pegawai::where('id',$id)->get();
            $pegawai->toArray();
            return view('admin.arsip_digital.index',compact('title','arsip_digital','pegawai'));
        } else {
            $title = "Arsip Digital";
            $id_pegawai = DB::table('pegawai_tbl')->where('nip',Auth::user()->name)->value('id');
            $arsip_digital = ArsipDigital::where('pegawai_id',$id_pegawai)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            $pegawai = Pegawai::where('id',$id_pegawai)->get();
            $pegawai->toArray();
            return view('admin.arsip_digital.index',compact('title','arsip_digital','pegawai'));
        }
    }

    ## Tampilkan Data Search
    public function search(Request $request, $id)
    {
        if(Auth::user()->group==1){
            $title = "Arsip Digital";
            $arsip_digital = $request->get('search');
            $arsip_digital = ArsipDigital::where('pegawai_id',$id)
                                ->where(function ($query) use ($arsip_digital) {
                                    $query->where('nama_arsip', 'LIKE', '%'.$arsip_digital.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            $pegawai = Pegawai::where('id',$id)->get();
            $pegawai->toArray();
            return view('admin.arsip_digital.index',compact('title','arsip_digital','pegawai'));
        } else {
            $title = "Arsip Digital";
            $id_pegawai = DB::table('pegawai_tbl')->where('nip',Auth::user()->name)->value('id');
            $arsip_digital = $request->get('search');
            $arsip_digital = ArsipDigital::where('pegawai_id',$id_pegawai)
                                ->where(function ($query) use ($arsip_digital) {
                                    $query->where('nama_arsip', 'LIKE', '%'.$arsip_digital.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            $pegawai = Pegawai::where('id',$id_pegawai)->get();
            $pegawai->toArray();
            return view('admin.arsip_digital.index',compact('title','arsip_digital','pegawai'));
        }
    }

   ## Tampilkan Form Create
   public function create($id)
   {
        $title = "Arsip Digital";
        if(Auth::user()->group==1){
            $pegawai = Pegawai::where('id',$id)->get();
        } else {
            $id_pegawai = DB::table('pegawai_tbl')->where('nip',Auth::user()->name)->value('id');
            $pegawai = Pegawai::where('id',$id_pegawai)->get();
        }
        $pegawai->toArray();
        $view=view('admin.arsip_digital.create',compact('title','pegawai'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store($id, Request $request)
   {
        $this->validate($request, [
            'nama_arsip' => 'required',
            'arsip_digital' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        $input['pegawai_id'] = $id;
        $input['nama_arsip'] = $request->nama_arsip;
		if($request->file('arsip_digital')){
			$input['arsip_digital'] = time().'.'.$request->arsip_digital->getClientOriginalExtension();
			$request->arsip_digital->move(public_path('upload/arsip_digital'), $input['arsip_digital']);
    	}	
		
        $input['user_id'] = Auth::user()->id;
       
        ArsipDigital::create($input);

        return redirect('/arsip_digital/'.$id)->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit($id, ArsipDigital $arsip_digital)
   {
        $title = "Arsip Digital";
        if(Auth::user()->group==1){
            $pegawai = Pegawai::where('id',$id)->get();
        } else {
            $id_pegawai = DB::table('pegawai_tbl')->where('nip',Auth::user()->name)->value('id');
            $pegawai = Pegawai::where('id',$id_pegawai)->get();
        }
        $pegawai->toArray();
        $view=view('admin.arsip_digital.edit', compact('title','pegawai','arsip_digital'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, $id, ArsipDigital $arsip_digital)
   {
        $this->validate($request, [
            'nama_arsip' => 'required',
            'arsip_digital' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('arsip_digital') && $arsip_digital->arsip_digital){
            $pathToYourFile = public_path('upload/arsip_digital/'.$arsip_digital->arsip_digital);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $arsip_digital->fill($request->all());
       
        if($request->file('arsip_digital')){
            $filename = time().'.'.$request->arsip_digital->getClientOriginalExtension();
            $request->arsip_digital->move(public_path('upload/arsip_digital'), $filename);
            $arsip_digital->arsip_digital = $filename;
		}

        $arsip_digital->user_id = Auth::user()->id;
        $arsip_digital->save();
       
        return redirect('/arsip_digital/'.$id)->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete($id, ArsipDigital $arsip_digital)
   {
        $pathToYourFile = public_path('upload/arsip_digital/'.$arsip_digital->arsip_digital);
        if(file_exists($pathToYourFile))
        {
            unlink($pathToYourFile);
        }

        $arsip_digital->delete();
       
        return redirect('/arsip_digital/'.$id)->with('status', 'Data Berhasil Dihapus');
   }
}
