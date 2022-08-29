<?php

namespace App\Http\Controllers;

use App\Models\Agenda;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgendaController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Agenda";
        $agenda = Agenda::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.agenda.index',compact('title','agenda'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Agenda";
        $agenda = $request->get('search');
        $agenda = Agenda::where(function ($query) use ($agenda) {
                                $query->where('letter_number', 'LIKE', '%'.$agenda.'%')
                                        ->orWhere('letter_from', 'LIKE', '%'.$agenda.'%')
                                        ->orWhere('about', 'LIKE', '%'.$agenda.'%')
                                        ->orWhere('on_process', 'LIKE', '%'.$agenda.'%');
                            })
                            ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        return view('admin.agenda.index',compact('title','agenda'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Agenda";
        $view=view('admin.agenda.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'date_of_entry' => 'required',
            'letter_date' => 'required',
            'letter_number' => 'required'
        ]);

        $input['date_of_entry'] = $request->date_of_entry;
        $input['letter_date'] = $request->letter_date;
        $input['letter_number'] = $request->letter_number;
        $input['letter_from'] = $request->letter_from;
        $input['about'] = $request->about;
        $input['on_process'] = $request->on_process;
        Agenda::create($input);

        return redirect('/agenda/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(Agenda $agenda)
   {
        $title = "Agenda";
        $view=view('admin.agenda.edit', compact('title','agenda'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, Agenda $agenda)
   {
        $this->validate($request, [
            'date_of_entry' => 'required',
            'letter_date' => 'required',
            'letter_number' => 'required'
        ]);

        $agenda->fill($request->all());
        $agenda->save();
       
        return redirect('/agenda/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Agenda $agenda)
   {
        $agenda->delete();
        return redirect('/agenda/')->with('status', 'Data Berhasil Dihapus');
   }
}
