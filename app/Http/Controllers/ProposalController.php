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
    public function index(Request $request)
    {
        $title = "Usulan";

        if(Auth::user()->group == 1){
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('status','Masuk')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('status','Proses')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        } else {
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Masuk')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_revision"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Perbaiki')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Proses')->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        }
        
        return view('admin.proposal.index',compact('title','proposal'));
    }

    ## Tampilkan Data Search
    public function search(Request $request)
    {
        $title = "Usulan";
        $proposal = $request->get('search');

        if(Auth::user()->group == 1){
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('status','Masuk')
                                ->where(function ($query) use ($proposal) {
                                    $query->where('date', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('status','Proses')
                                ->where(function ($query) use ($proposal) {
                                    $query->where('date', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                            ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                })
                                ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
        } else {
            if($request->segment(1)=="proposal_income"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Masuk')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_revision"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Perbaiki')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            } else if($request->segment(1)=="proposal_process"){
                $proposal = Proposal::where('office_id',Auth::user()->office_id)->where('status','Proses')
                                    ->where(function ($query) use ($proposal) {
                                        $query->where('date', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('type', 'LIKE', '%'.$proposal.'%')
                                                ->orWhere('about', 'LIKE', '%'.$proposal.'%');
                                    })
                                    ->orderBy('id','DESC')->paginate(25)->onEachSide(1);
            }
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

        return redirect('/proposal_income/')->with('status','Data Tersimpan');
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
            'cover_letter' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'review_staff' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'official_memo' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'approval_concept' => 'mimes:jpg,jpeg,png,pdf|max:100000',
            'draft' => 'mimes:jpg,jpeg,png,pdf|max:100000'
        ]);
        
        if($request->file('cover_letter') && $proposal->cover_letter){
            $pathToYourFile = public_path('upload/cover_letter/'.$proposal->cover_letter);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('review_staff') && $proposal->review_staff){
            $pathToYourFile = public_path('upload/review_staff/'.$proposal->review_staff);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('official_memo') && $proposal->official_memo){
            $pathToYourFile = public_path('upload/official_memo/'.$proposal->official_memo);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('approval_concept') && $proposal->approval_concept){
            $pathToYourFile = public_path('upload/approval_concept/'.$proposal->approval_concept);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        if($request->file('draft') && $proposal->draft){
            $pathToYourFile = public_path('upload/draft/'.$proposal->draft);
            if(file_exists($pathToYourFile))
            {
                unlink($pathToYourFile);
            }
		}

        $proposal->fill($request->all());

        if($request->file('cover_letter')){
            $filename = time().'.'.$request->cover_letter->getClientOriginalExtension();
            $request->cover_letter->move(public_path('upload/cover_letter'), $filename);
            $proposal->cover_letter = $filename;
		}

        if($request->file('review_staff')){
            $filename = time().'.'.$request->review_staff->getClientOriginalExtension();
            $request->review_staff->move(public_path('upload/review_staff'), $filename);
            $proposal->review_staff = $filename;
		}

        if($request->file('official_memo')){
            $filename = time().'.'.$request->official_memo->getClientOriginalExtension();
            $request->official_memo->move(public_path('upload/official_memo'), $filename);
            $proposal->official_memo = $filename;
		}

        if($request->file('approval_concept')){
            $filename = time().'.'.$request->approval_concept->getClientOriginalExtension();
            $request->approval_concept->move(public_path('upload/approval_concept'), $filename);
            $proposal->approval_concept = $filename;
		}

        if($request->file('draft')){
            $filename = time().'.'.$request->draft->getClientOriginalExtension();
            $request->draft->move(public_path('upload/draft'), $filename);
            $proposal->draft = $filename;
		}
        $proposal->status = 'Masuk';
        $proposal->save();
       
        return redirect('/proposal_revision/')->with('status', 'Data Berhasil Diperbaiki');
   }

   
   ## Verifikasi Data
   public function verification(Request $request, Proposal $proposal)
   {
        $this->validate($request, [
            'status1' => 'required',
            'status2' => 'required',
            'status3' => 'required',
            'status4' => 'required',
            'status5' => 'required',
        ]);
        
        $proposal->fill($request->all());
        if($request->status1=="Lengkap" && $request->status2=="Lengkap" && $request->status3=="Lengkap" && $request->status4=="Lengkap" && $request->status5=="Lengkap"){
            $proposal->status = 'Proses';
        } else {
            $proposal->status = 'Perbaiki';
        }

        $proposal->save();
       
        return redirect('/proposal_income/')->with('status', 'Data Berhasil Diubah');
   }

   ## Hapus Data
   public function delete(Proposal $proposal)
   {
        $proposal->delete();
        return redirect('/proposal/')->with('status', 'Data Berhasil Dihapus');
   }

   
   ## Detail
   public function detail(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.detail', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

   ## Lembar Kontrol
   public function control_sheet(Proposal $proposal)
   {
        $title = "Usulan";
        $view=view('admin.proposal.control_sheet', compact('title','proposal'));
        $view=$view->render();
        return $view;
   }

}
