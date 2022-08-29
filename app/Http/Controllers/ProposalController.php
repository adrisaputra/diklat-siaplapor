<?php

namespace App\Http\Controllers;

use App\Models\Proposal;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProposalController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ## Tampikan Data
    public function index()
    {
        $title = "Usulan";

        if(Auth::user()->group == 1){
            $proposal = Proposal::orderBy('id','DESC')->paginate(25)->onEachSide(1);
        } else {
            $proposal = Proposal::where('office_id',Auth::user()->office_id)->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.proposal.index',compact('title','proposal'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Usulan";
        $proposal = $request->get('search');

        if(Auth::user()->group == 1){
            $proposal = Proposal::where(function ($query) use ($proposal) {
                            $query->where('date', 'LIKE', '%'.$proposal.'%')
                                    ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                    ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                        })
                        ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        } else {
            $proposal = Proposal::where('office_id',Auth::user()->office_id)->
                        where(function ($query) use ($proposal) {
                            $query->where('date', 'LIKE', '%'.$proposal.'%')
                                    ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                    ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                        })
                        ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
        }
        
        return view('admin.proposal.index',compact('title','proposal'));
    }

   ## Tampilkan Form Create
   public function create()
   {
        $title = "Usulan";
        $view=view('admin.proposal.create',compact('title'));
        $view=$view->render();
        return $view;
   }

   ## Simpan Data
   public function store(Request $request)
   {
        $this->validate($request, [
            'date' => 'required',
            'type' => 'required',
            'about' => 'required',
            'cover_letter' => 'required|mimes:jpg,jpeg,png,pdf|max:100000',
            'review_staff' => 'required|mimes:jpg,jpeg,png,pdf|max:100000',
            'official_memo' => 'required|mimes:jpg,jpeg,png,pdf|max:100000',
            'approval_concept' => 'required|mimes:jpg,jpeg,png,pdf|max:100000',
            'draft' => 'required|mimes:jpg,jpeg,png,pdf|max:100000'
        ]);

        
        $input['office_id'] = Auth::user()->office_id;
        $input['date'] = $request->date;
        $input['type'] = $request->type;
        $input['about'] = $request->about;
        
		if($request->file('cover_letter')){
			$input['cover_letter'] = time().'.'.$request->cover_letter->getClientOriginalExtension();
			$request->cover_letter->move(public_path('upload/cover_letter'), $input['cover_letter']);
    	}	
		
		if($request->file('review_staff')){
			$input['review_staff'] = time().'.'.$request->review_staff->getClientOriginalExtension();
			$request->review_staff->move(public_path('upload/review_staff'), $input['review_staff']);
    	}	
		
		if($request->file('official_memo')){
			$input['official_memo'] = time().'.'.$request->official_memo->getClientOriginalExtension();
			$request->official_memo->move(public_path('upload/official_memo'), $input['official_memo']);
    	}	
		
		if($request->file('approval_concept')){
			$input['approval_concept'] = time().'.'.$request->approval_concept->getClientOriginalExtension();
			$request->approval_concept->move(public_path('upload/approval_concept'), $input['approval_concept']);
    	}	
		
		if($request->file('draft')){
			$input['draft'] = time().'.'.$request->draft->getClientOriginalExtension();
			$request->draft->move(public_path('upload/draft'), $input['draft']);
    	}	
		
        Proposal::create($input);

        return redirect('/proposal/')->with('status','Data Tersimpan');
   }

   ## Tampilkan Form Edit
   public function edit(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.edit', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

   ## Edit Data
   public function update(Request $request, Proposal $proposal)
   {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $proposal->fill($request->all());
        $proposal->save();
       
        return redirect('/proposal/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Proposal $proposal)
   {
        $proposal->delete();
        return redirect('/proposal/')->with('status', 'Data Berhasil Dihapus');
   }
}
