<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class guruUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guruUser = User::where('role',2)->get();
        return view('guru-user.index',compact('guruUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('email',$request->input('name'));
        Session::flash('email',$request->input('email'));
        Session::flash('username',$request->input('username'));
        Session::flash('role',$request->input('role'));
        $request->validate([
            'name' => 'required|min:5|max:50',
            'username' => 'required|min:5|max:15|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:50|',
        ],[
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama harus berkarakter 5 huruf',
            'name.max' => 'Nama melebihi batas maximal',
            'username.unique' => 'Username sudah ada, silahkan masukan username yang lain',
            'username.min' => 'Username harus berkarakter 5 huruf',
            'username.max' => 'Username melebihi batas maximal',
            'username.required' => 'Username Wajib Diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Masukan email yang valid',
            'email.unique' => 'Email sudah ada, silahkan masukan email yang lain',
            'password.min' => 'Password harus berkarakter 8 huruf',
            'password.max' => 'Password melebihi batas maximal',
            'password.required' => 'Password Wajib Diisi',
             'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        User::create($data);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

      return to_route('guru-user.index')->with('success','User Berhasil Ditambahkan');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guruUser = User::find($id);
        return view('guru-user.edit',compact('guruUser'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|min:5|max:50',
               'username' => 'required|min:5|max:15|unique:users,username, '. $id,
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable'
           ],[
            'username.unique' => 'Username sudah ada, silahkan masukan username yang lain',
            'email.unique' => 'Email sudah ada, silahkan masukan username yang lain',
           ]);
           if ($request->password != '') {
                $data['password'] = bcrypt($request->password);
           }else{
            unset($data['password']);
           }
     
           $guruUser = User::findOrFail($id);
           $guruUser->fill($data);
           $guruUser->save();
    
           return to_route('guru-user.index')->with('success','Data Berhasil Di update');
    }

    public function status($id){
        $guruUser = User::find($id);
        $guruUser = User::findOrFail($id);

       if($guruUser){
        if($guruUser->status){
            $guruUser->status = 0;
        }else{
            $guruUser->status = 1;
        }
        
               $guruUser->save();
       }
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guruUser = User::find($id);
        if($guruUser){
            $guruUser->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Data Tidak Ditemukan'],404);
        }
    }
}
