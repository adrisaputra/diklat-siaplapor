<?php

namespace App\Http\Controllers;

use App\Models\Office;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OfficeController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "OPD";
        $office = Office::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.office.index',compact('title','office'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "OPD";
        $office = $request->get('search');
        $office = Office::where(function ($query) use ($office) {
                                $query->where('name', 'LIKE', '%'.$office.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.office.index',compact('title','office'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "OPD";
        $view=view('admin.office.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input['name'] = $request->name;
        Office::create($input);

        return redirect('/office/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(Office $office)
   {
        $title = "OPD";
        $view=view('admin.office.edit', compact('title','office'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, Office $office)
   {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $office->fill($request->all());
        $office->save();
       
        return redirect('/office/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Office $office)
   {
        $office->delete();
        return redirect('/office/')->with('status', 'Data Berhasil Dihapus');
   }
}
