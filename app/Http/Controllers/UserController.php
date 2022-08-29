<?php

namespace App\Http\Controllers;

use App\Models\User;   //nama model
use App\Models\Office;   //nama model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    ## Cek Login
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    ## Tampikan Data
    public function index()
    {
		$user = User::where('status',0)->orderBy('id','DESC')->paginate(25);
		return view('admin.user.index',compact('user'));
    }
	
	## Tampilkan Data Search
	public function search(Request $request)
    {
        $user = $request->get('search');
		$user = User::where('status',0)->where('name', 'LIKE', '%'.$user.'%')->orderBy('id','DESC')->paginate(25);
		return view('admin.user.index',compact('user'));
    }
	
	## Tampilkan Form Create
	public function create()
    {
        $office = Office::get();
        $view=view('admin.user.create',compact('office'));
        $view=$view->render();
        return $view;
    }
	
	## Simpan Data
	public function store(Request $request)
    {
		$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'group' => 'required',
            'office_id' => 'required_if:group,3'
		]);
		
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['group'] = $request->group;
        if($request->group==3){
            $input['office_id'] = $request->office_id;
        }
        User::create($input);
		
		return redirect('/user')->with('status','Data Tersimpan');

    }
	
	## Tampilkan Form Edit
    public function edit(User $user)
    {
        $view=view('admin.user.edit', compact('user'));
        $view=$view->render();
		return $view;
    }
	
	## Edit Data
    public function update(Request $request, User $user)
    {
        if($request->group==2){
            if($request->password){
                $this->validate($request, [
                    'password' => 'required|string|min:8|confirmed'
                ]);
            } 
        } else {
            if($request->password){
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'password' => 'required|string|min:8|confirmed'
                ]);
            } else {
                $this->validate($request, [
                    'name' => 'required|string|max:255'
                ]);
            }
        }
         
		if($request->password){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
		} else {
            $user->name = $request->name;
            $user->email = $request->email;
        }
        $user->save();
        
		return redirect('/user')->with('status', 'Data Berhasil Diubah');
    }

    ## Hapus Data
    public function delete(User $user)
    {
        if($user->group==1){
            $id = $user->id;
            $user->delete();
            
        } else {
            $user->status = 1;
            $user->save();
            
            // $cek_pegawai = Pegawai::where('nip', $user->name)->value('id');
            // $pegawai = Pegawai::find($cek_pegawai);
            // $pegawai->status_hapus = 1;
            // $pegawai->save();
        }

		return redirect('/user')->with('status', 'Data Berhasil Dihapus');
    }

    ## Tampilkan Form Edit
    public function edit_profil(User $user)
    {
        $title = "PROFIL";
        $view=view('admin.user.profil', compact('user','title'));
        $view=$view->render();
        return $view;
    }

    ## Edit Data
    public function update_profil(Request $request, User $user)
    {
        if($request->get('current-password')){
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                $this->validate($request, [
                    'email' => 'required|email',
                    'foto' => 'mimes:jpg,jpeg,png|max:300',
                    'current-password' => 'string|confirmed'
                ]);
            } 
        }
            
        if($request->get('password')){
            if(!(strcmp($request->get('password'), $request->get('password_confirmation'))) == 0){
                if($request->password){
                    $this->validate($request, [
                        'email' => 'required|email',
                        'foto' => 'mimes:jpg,jpeg,png|max:300',
                        'password' => 'string|min:8|confirmed'
                    ]);
                }
            } 
        }

        if($request->password){
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:8',
                'foto' => 'mimes:jpg,jpeg,png|max:300',
            ]);
        } else {
            $this->validate($request, [
                'email' => 'required|email',
                'foto' => 'mimes:jpg,jpeg,png|max:300',
            ]);
        }

        $user->fill($request->all());
        if($request->password){
            $user->password = Hash::make($request->password);
        } else {
            $cek_user = User::where('id', Auth::user()->id)->get();
            $cek_user->toArray();
            $user->password = $cek_user[0]->password;
        }
        
        if($request->file('foto') == ""){}
        else
        {	
            $filename = time().'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('upload/foto'), $filename);
            $user->foto = $filename;
        }
        
        $user->save();
        
        return redirect('/user/edit_profil/1')->with('status', 'Data Berhasil Diubah');
    }
}
