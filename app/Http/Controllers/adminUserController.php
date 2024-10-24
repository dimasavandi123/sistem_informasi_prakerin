<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUser = User::where('role',1)->get();
        return view('admin-user.index',compact('adminUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-user.create');
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

      return to_route('admin-user.index')->with('success','User Berhasil Ditambahkan');  
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
        $adminUser = User::find($id);
        return view('admin-user.edit',compact('adminUser'));
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
     
           $adminUser = User::findOrFail($id);
           $adminUser->fill($data);
           $adminUser->save();
    
           return to_route('admin-user.index')->with('success','Data Berhasil Di update');
    }

    public function status($id){
        $adminUser = User::find($id);
        $adminUser = User::findOrFail($id);

       if($adminUser){
        if($adminUser->status){
            $adminUser->status = 0;
        }else{
            $adminUser->status = 1;
        }
        
               $adminUser->save();
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
        $adminUser = User::find($id);
        if($adminUser){
            $adminUser->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Data Tidak Ditemukan'],404);
        }
    }
}
