<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;   //nama model
use App\Models\User;   //nama model
use App\Imports\PegawaiImport;     // Import data Pegawai
use Maatwebsite\Excel\Facades\Excel; // Excel Library
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;

class PegawaiController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
        if(Auth::user()->group==1){

            $pegawai = Pegawai::where('status_hapus', 0)->orderBy('id','ASC')->paginate(25)->onEachSide(1);
            return view('admin.pegawai.index',compact('pegawai'));

        } else if(Auth::user()->group==2){
            $pegawai = DB::table('pegawai_tbl')->where('nip',Auth::user()->name)->orderBy('id','DESC')->get()->toArray();
            return view('admin.pegawai.index2',compact('pegawai'));
        }
    }

	## Tampilkan Data Search
	public function search(Request $request)
    {
        $pegawai = $request->get('search');
        if(Auth::user()->group==1){
            $pegawai = Pegawai::where('status_hapus', 0)
            ->where(function ($query) use ($pegawai) {
                $query->where('nip', 'LIKE', '%'.$pegawai.'%')
                    ->orWhere('nama_pegawai', 'LIKE', '%'.$pegawai.'%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%'.$pegawai.'%');
            })
            ->orderBy('id','ASC')->paginate(25)->onEachSide(1);
        } else if(Auth::user()->group==2){
            $pegawai = Pegawai::where('bidang_id', Auth::user()->bidang_id)->where('status_hapus', 0)->where('nama_pegawai', 'LIKE', '%'.$pegawai.'%')->orderBy('jabatan_id','ASC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.pegawai.index',compact('pegawai'));
    }
	
    ## Tampilkan Form Create
    public function create()
    {
		$view=view('admin.pegawai.create');
        $view=$view->render();
        return $view;
    }

    ## Simpan Data
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|unique:pegawai_tbl|numeric|digits:18',
            'nama_pegawai' => 'required',
            'email' => 'nullable|email',
            'no_ktp' => 'nullable|numeric|digits:16',
			'foto' => 'mimes:jpg,jpeg,png|max:500'
        ]);

		$input['nip'] = $request->nip;
		$input['nama_pegawai'] = $request->nama_pegawai;
		$input['tempat_lahir'] = $request->tempat_lahir;

		$tgl_lahir = substr($request->tanggal_lahir,3,2);
		$bln_lahir = substr($request->tanggal_lahir,0,2);
		$thn_lahir = substr($request->tanggal_lahir,6,4);
		$input['tanggal_lahir'] = $thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir;

		$input['jenis_kelamin'] = $request->jenis_kelamin;
		$input['alamat'] = $request->alamat;
		$input['agama'] = $request->agama;
		$input['gol_darah'] = $request->gol_darah;
        $input['email'] = $request->email;
        $input['telp'] = $request->telp;
		$input['no_ktp'] = $request->no_ktp;
        $input['no_bpjs'] = $request->no_bpjs;
        $input['no_npwp'] = $request->no_npwp;
        $input['no_karpeg'] = $request->no_karpeg;
        $input['no_karsu'] = $request->no_karsu;
        
		if($request->file('foto')){
            $input['foto'] = time().'.'.$request->file('foto')->getClientOriginalExtension();
 
            $request->file('foto')->storeAs('public/upload/foto_pegawai', $input['foto']);
            $request->file('foto')->storeAs('public/upload/foto_pegawai/thumbnail', $input['foto']);
     
            $thumbnailpath = public_path('storage/upload/foto_pegawai/thumbnail/'.$input['foto']);
            $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
        }
        
        
		$tgl_tmt_cpns = substr($request->tmt_cpns,3,2);
		$bln_tmt_cpns = substr($request->tmt_cpns,0,2);
		$thn_tmt_cpns = substr($request->tmt_cpns,6,4);
		$input['tmt_cpns'] = $thn_tmt_cpns.'-'.$bln_tmt_cpns.'-'.$tgl_tmt_cpns;

		$tgl_tmt_pns = substr($request->tmt_pns,3,2);
		$bln_tmt_pns = substr($request->tmt_pns,0,2);
		$thn_tmt_pns = substr($request->tmt_pns,6,4);
        $input['tmt_pns'] = $thn_tmt_pns.'-'.$bln_tmt_pns.'-'.$tgl_tmt_pns;

		$input['user_id'] = Auth::user()->id;
		
        Pegawai::create($input);
        
		$input2['name'] = $request->nip;
		$input2['email'] = $request->nip.'@gmail.com';
		$input2['password'] = Hash::make($request->nip);
		$input2['group'] = 2;
        User::create($input2);
        
		return redirect('/pegawai')->with('status','Data Tersimpan');
    }

    ## Tampilkan Form Edit
    public function edit(Pegawai $pegawai)
    {
        $view=view('admin.pegawai.edit', compact('pegawai'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'nip' => 'required|numeric|digits:18',
            'nama_pegawai' => 'required',
            'email' => 'nullable|email',
            'no_ktp' => 'nullable|numeric|digits:16',
			'foto' => 'mimes:jpg,jpeg,png|max:500'
        ]);

        if($pegawai->foto && $request->file('foto')!=""){
            $image_path = public_path().'/storage/upload/foto_pegawai/thumbnail/'.$pegawai->foto;
            $image_path2 = public_path().'/storage/upload/foto_pegawai/'.$pegawai->foto;
            unlink($image_path);
            unlink($image_path2);
        }

        $pegawai->fill($request->all());
        
		$tgl_lahir = substr($request->tanggal_lahir,3,2);
		$bln_lahir = substr($request->tanggal_lahir,0,2);
		$thn_lahir = substr($request->tanggal_lahir,6,4);
		$pegawai->tanggal_lahir = $thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir;

		if($request->file('foto')){

            $filename = time().'.'.$request->file('foto')->getClientOriginalExtension();
           
            $request->file('foto')->storeAs('public/upload/foto_pegawai', $filename);
            $request->file('foto')->storeAs('public/upload/foto_pegawai/thumbnail', $filename);
     
            $thumbnailpath = public_path('storage/upload/foto_pegawai/thumbnail/'.$filename);
            $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $pegawai->foto = $filename;
        }
        
		$tgl_tmt_cpns = substr($request->tmt_cpns,3,2);
		$bln_tmt_cpns = substr($request->tmt_cpns,0,2);
		$thn_tmt_cpns = substr($request->tmt_cpns,6,4);
		$pegawai->tmt_cpns = $thn_tmt_cpns.'-'.$bln_tmt_cpns.'-'.$tgl_tmt_cpns;

		$tgl_tmt_pns = substr($request->tmt_pns,3,2);
		$bln_tmt_pns = substr($request->tmt_pns,0,2);
		$thn_tmt_pns = substr($request->tmt_pns,6,4);
        $pegawai->tmt_pns = $thn_tmt_pns.'-'.$bln_tmt_pns.'-'.$tgl_tmt_pns;

		$pegawai->user_id = Auth::user()->id;
    	$pegawai->save();
		
        $cek_user = User::where('name',$request->nip2)->get();
        $cek_user->toArray();

        $user = User::find($cek_user[0]->id);
        $user->name = $request->nip;
    	$user->save();
        
		return redirect('/pegawai')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(Pegawai $pegawai)
    {
        $pegawai->status_hapus = 1;
        $pegawai->user_id = Auth::user()->id;
    	$pegawai->save();

        $cek_user = User::where('name',$pegawai->nip)->get();
        $cek_user->toArray();

        $user = User::find($cek_user[0]->id);
        $user->status = 1;
    	$user->save();
        
        return redirect('/pegawai')->with('status', 'Data Berhasil Dihapus');
    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_pegawai',$nama_file);
 
		// import data
		Excel::import(new PegawaiImport, public_path('/file_pegawai/'.$nama_file));
 
        return redirect('/pegawai')->with('status', 'Data Pegawai Berhasil Diimport');
	}

    public function download_cv($id)
    {
    	$pegawai = Pegawai::where('id',$id)->get();
    	$pegawai->toArray();

        $riwayat_jabatan = RiwayatJabatan::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_angka_kredit = RiwayatAngkaKredit::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_kepangkatan = RiwayatKepangkatan::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_lhkpn = RiwayatLhkpn::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_kompetensi = RiwayatKompetensi::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_pendidikan = RiwayatPendidikan::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_seminar = RiwayatSeminar::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_diklat = RiwayatDiklat::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_tugas = RiwayatTugas::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_karya_ilmiah = RiwayatKaryaIlmiah::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_penghargaan = RiwayatPenghargaan::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_cuti = RiwayatCuti::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_hukuman = RiwayatHukuman::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_kursus = RiwayatKursus::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_gaji = RiwayatGaji::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_kgb = RiwayatKgb::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_tugas_luar_negeri = RiwayatTugasLuarNegeri::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_pajak = RiwayatPajak::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_orang_tua = RiwayatOrangTua::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_pasangan = RiwayatPasangan::where('pegawai_id',$id)->orderBy('id','DESC')->get();
        $riwayat_anak = RiwayatAnak::where('pegawai_id',$id)->orderBy('id','DESC')->get();
 
    	$pdf = PDF::loadview('admin.pegawai.download_cv',[
                                'pegawai'=>$pegawai,
                                'riwayat_jabatan'=>$riwayat_jabatan,
                                'riwayat_angka_kredit'=>$riwayat_angka_kredit,
                                'riwayat_kepangkatan'=>$riwayat_kepangkatan,
                                'riwayat_lhkpn'=>$riwayat_lhkpn,
                                'riwayat_kompetensi'=>$riwayat_kompetensi,
                                'riwayat_pendidikan'=>$riwayat_pendidikan,
                                'riwayat_seminar'=>$riwayat_seminar,
                                'riwayat_diklat'=>$riwayat_diklat,
                                'riwayat_tugas'=>$riwayat_tugas,
                                'riwayat_karya_ilmiah'=>$riwayat_karya_ilmiah,
                                'riwayat_penghargaan'=>$riwayat_penghargaan,
                                'riwayat_cuti'=>$riwayat_cuti,
                                'riwayat_hukuman'=>$riwayat_hukuman,
                                'riwayat_kursus'=>$riwayat_kursus,
                                'riwayat_gaji'=>$riwayat_gaji,
                                'riwayat_kgb'=>$riwayat_kgb,
                                'riwayat_tugas_luar_negeri'=>$riwayat_tugas_luar_negeri,
                                'riwayat_pajak'=>$riwayat_pajak,
                                'riwayat_orang_tua'=>$riwayat_orang_tua,
                                'riwayat_pasangan'=>$riwayat_pasangan,
                                'riwayat_anak'=>$riwayat_anak
                            ]);
    	return $pdf->download($pegawai[0]->nama_pegawai.'.pdf');

        // $view=view('admin.pegawai.download_cv', compact('pegawai',
        //                                                 'riwayat_jabatan',
        //                                                 'riwayat_angka_kredit',
        //                                                 'riwayat_kepangkatan',
        //                                                 'riwayat_kepangkatan',
        //                                                 'riwayat_lhkpn',
        //                                                 'riwayat_kompetensi',
        //                                                 'riwayat_pendidikan',
        //                                                 'riwayat_seminar',
        //                                                 'riwayat_diklat',
        //                                                 'riwayat_tugas',
        //                                                 'riwayat_karya_ilmiah',
        //                                                 'riwayat_penghargaan',
        //                                                 'riwayat_cuti',
        //                                                 'riwayat_hukuman',
        //                                                 'riwayat_kursus',
        //                                                 'riwayat_gaji',
        //                                                 'riwayat_kgb',
        //                                                 'riwayat_tugas_luar_negeri',
        //                                                 'riwayat_pajak',
        //                                                 'riwayat_orang_tua',
        //                                                 'riwayat_pasangan',
        //                                                 'riwayat_anak'));
        // $view=$view->render();
        // return $view;

    }

    public function naik_pangkat()
    {
        $title = "Naik Pangkat";

        if(Auth::user()->group==1){
            $pegawai = Pegawai::select('*', DB::raw("tmt + INTERVAL '4' YEAR AS naikpangkat_berikutnya"), DB::raw(" DATEDIFF(tmt + INTERVAL '4' YEAR,CURDATE()) as hari"))
                      ->where('status_hapus', 0)
                      ->whereRaw('YEAR(tmt) = YEAR(DATE_SUB(CURDATE(), INTERVAL 4 YEAR))')
                      ->paginate(25)->onEachSide(1);

            if(count($pegawai)>0){
                foreach($pegawai as $v){
                    if($v->golongan){
                       
                        if($v->golongan=="Golongan I/a"){
                            $golongan_selanjutnya = "Golongan I/b";
                        } else if($v->golongan=="Golongan I/b"){
                            $golongan_selanjutnya = "Golongan I/c";
                        } else if($v->golongan=="Golongan I/c"){
                            $golongan_selanjutnya = "Golongan I/d";
                        } else if($v->golongan=="Golongan I/d"){
                            $golongan_selanjutnya = "Golongan II/a";
                        } else if($v->golongan=="Golongan II/a"){
                            $golongan_selanjutnya = "Golongan II/b";
                        } else if($v->golongan=="Golongan II/b"){
                            $golongan_selanjutnya = "Golongan II/c";
                        } else if($v->golongan=="Golongan II/c"){
                            $golongan_selanjutnya = "Golongan II/d";
                        } else if($v->golongan=="Golongan II/d"){
                            $golongan_selanjutnya = "Golongan III/a";
                        } else if($v->golongan=="Golongan III/a"){
                            $golongan_selanjutnya = "Golongan III/b";
                        } else if($v->golongan=="Golongan III/b"){
                            $golongan_selanjutnya = "Golongan III/c";
                        } else if($v->golongan=="Golongan III/c"){
                            $golongan_selanjutnya = "Golongan III/d";
                        } else if($v->golongan=="Golongan III/d"){
                            $golongan_selanjutnya = "Golongan IV/a";
                        } else if($v->golongan=="Golongan IV/a"){
                            $golongan_selanjutnya = "Golongan IV/b";
                        } else if($v->golongan=="Golongan IV/b"){
                            $golongan_selanjutnya = "Golongan IV/c";
                        } else if($v->golongan=="Golongan IV/c"){
                            $golongan_selanjutnya = "Golongan IV/d";
                        } else if($v->golongan=="Golongan IV/d"){
                            $golongan_selanjutnya = "Golongan IV/e";
                        } else {
                            $golongan_selanjutnya = "Tidak Ada";
                        }
                        
                        $naikpangkat=$v->naikpangkat_berikutnya;
                    } else {
                        //$naikpangkat[0]="Tidak ada";
                        $golongan_selanjutnya="Tidak ada";
                        $naikpangkat="Tidak ada";
                    } 

                    
                }
            
            } else {
                $golongan_selanjutnya="Tidak ada";
                $naikpangkat="Tidak ada";
            }

            return view('admin.pegawai.naik_pangkat',compact('title','pegawai','naikpangkat','golongan_selanjutnya'));

        } else {

            $pegawai = Pegawai::select('*', DB::raw("tmt + INTERVAL '4' YEAR AS naikpangkat_berikutnya"), DB::raw(" DATEDIFF(tmt + INTERVAL '4' YEAR,CURDATE()) as hari"))
                      ->where('nip', Auth::user()->name)->get();
            $pegawai->toArray();

            if(count($pegawai)>0){
                
                if($pegawai[0]->golongan=="Golongan I/a"){
                    $golongan_selanjutnya = "Golongan I/b";
                } else if($pegawai[0]->golongan=="Golongan I/b"){
                    $golongan_selanjutnya = "Golongan I/c";
                } else if($pegawai[0]->golongan=="Golongan I/c"){
                    $golongan_selanjutnya = "Golongan I/d";
                } else if($pegawai[0]->golongan=="Golongan I/d"){
                    $golongan_selanjutnya = "Golongan II/a";
                } else if($pegawai[0]->golongan=="Golongan II/a"){
                    $golongan_selanjutnya = "Golongan II/b";
                } else if($pegawai[0]->golongan=="Golongan II/b"){
                    $golongan_selanjutnya = "Golongan II/c";
                } else if($pegawai[0]->golongan=="Golongan II/c"){
                    $golongan_selanjutnya = "Golongan II/d";
                } else if($pegawai[0]->golongan=="Golongan II/d"){
                    $golongan_selanjutnya = "Golongan III/a";
                } else if($pegawai[0]->golongan=="Golongan III/a"){
                    $golongan_selanjutnya = "Golongan III/b";
                } else if($pegawai[0]->golongan=="Golongan III/b"){
                    $golongan_selanjutnya = "Golongan III/c";
                } else if($pegawai[0]->golongan=="Golongan III/c"){
                    $golongan_selanjutnya = "Golongan III/d";
                } else if($pegawai[0]->golongan=="Golongan III/d"){
                    $golongan_selanjutnya = "Golongan IV/a";
                } else if($pegawai[0]->golongan=="Golongan IV/a"){
                    $golongan_selanjutnya = "Golongan IV/b";
                } else if($pegawai[0]->golongan=="Golongan IV/b"){
                    $golongan_selanjutnya = "Golongan IV/c";
                } else if($pegawai[0]->golongan=="Golongan IV/c"){
                    $golongan_selanjutnya = "Golongan IV/d";
                } else if($pegawai[0]->golongan=="Golongan IV/d"){
                    $golongan_selanjutnya = "Golongan IV/e";
                } 
                
                $naikpangkat=$pegawai[0]->naikpangkat_berikutnya;
            } else {
                $naikpangkat[0]="Tidak ada";
                $golongan_selanjutnya="Tidak ada";
            } 
            
            return view('admin.pegawai.naik_pangkat',compact('title','pegawai','naikpangkat','golongan_selanjutnya'));
        }
        
    }

    public function pensiun()
    {
        $title = "Pensiun";

        if(Auth::user()->group==1){
            $pegawai = Pegawai::select('*', DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) AS umur'), DB::raw("tanggal_lahir + INTERVAL '58' YEAR AS pensiun"))
                      ->where('status_hapus', 0)
                      ->whereRaw('YEAR(tanggal_lahir) = YEAR(DATE_SUB(CURDATE(), INTERVAL 58 YEAR))')
                      ->paginate(25)->onEachSide(1);

            return view('admin.pegawai.pensiun',compact('title','pegawai'));
        } else {
           
            $pegawai = Pegawai::where('nip',Auth::user()->name)->get();
            $pegawai->toArray();
    
            $pensiun = Pegawai::select('*', DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) AS umur'), DB::raw("tanggal_lahir + INTERVAL '58' YEAR AS pensiun"))
                             ->where('nip',Auth::user()->name)->get();	
            $pensiun->toArray();	
    
            return view('admin.pegawai.pensiun',compact('title','pegawai','pensiun'));
        }
        
    }

    public function kgb()
    {
        $title = "Kenaikan Gaji Berkala";

        if(Auth::user()->group==1){

            $pegawai = Pegawai::where('status_hapus', 0)
                    ->whereRaw('YEAR(kgb_saat_ini) = YEAR(DATE_SUB(CURDATE(), INTERVAL 2 YEAR))')
                    ->paginate(25)->onEachSide(1);
            
            $i=0;
            if(count($pegawai)>0){
                foreach($pegawai as $v){ 
                    
                    if($v->kgb_saat_ini){
                        $kgb = RiwayatKgb::select('*', DB::raw("kgb_saat_ini + INTERVAL '2' YEAR AS kgb_berikutnya"), DB::raw(" DATEDIFF(kgb_saat_ini + INTERVAL '2' YEAR,CURDATE()) as hari"))
                                     ->where('pegawai_id',$v->id)->orderBy('kgb_saat_ini','DESC')->get();	
                        $kgb->toArray();	
                        $kgb_terakhir[$i] = $kgb[0]->kgb_terakhir;
                        $kgb_saat_ini[$i] = $kgb[0]->kgb_saat_ini;
                        $kgb_berikutnya[$i] = $kgb[0]->kgb_berikutnya;
                    } else {
                        $kgb_terakhir[$i] = "Tidak ada";   
                        $kgb_saat_ini[$i] = "Tidak ada";   
                        $kgb_berikutnya[$i] = "Tidak ada";   
                    } 
                    $i++;
                }	
            } else {
                $gaji[0]="Tidak ada";
                $kgb_terakhir[0] = "Tidak ada";   
                $kgb_saat_ini[0] = "Tidak ada";   
                $kgb_berikutnya[0] = "Tidak ada";  
            }
            

        } else {
            $pegawai = Pegawai::where('nip',Auth::user()->name)->get();
            $pegawai->toArray();
    
            if($pegawai[0]->kgb_saat_ini){
                $kgb = RiwayatKgb::select('*', DB::raw("kgb_saat_ini + INTERVAL '2' YEAR AS kgb_berikutnya"), DB::raw(" DATEDIFF(kgb_saat_ini + INTERVAL '2' YEAR,CURDATE()) as hari"))
                       ->where('pegawai_id',$pegawai[0]->id)->orderBy('kgb_saat_ini','DESC')->get();	
                $kgb->toArray();	
                $kgb_terakhir[0] = $kgb[0]->kgb_terakhir;
                $kgb_terakhir[0] = $kgb[0]->kgb_terakhir;
                $kgb_saat_ini[0] = $kgb[0]->kgb_saat_ini;
                $kgb_berikutnya[0] = $kgb[0]->kgb_berikutnya;
            } else {
                $gaji[0]="Tidak ada";
                $kgb_terakhir[0] = "Tidak ada";   
                $kgb_saat_ini[0] = "Tidak ada";   
                $kgb_berikutnya[0] = "Tidak ada";  
            } 
        }
        
        return view('admin.pegawai.kgb',compact('title','pegawai','kgb_terakhir','kgb_saat_ini','kgb_berikutnya',));
    }

    
}
