<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Jawaban;
use App\Models\Gurumapel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate ([
            'jawaban' => 'required',
            'kelas_id' => 'required|exists:kelas,id',

        ]);

        $excerpt = Str::limit(nl2br(str_replace('&nbsp;', ' ', strip_tags($request->jawaban, '<p><a><b><i><strong><em><ul><ol><li><br>'))), 1000);
        $jawaban = new Jawaban;
        $jawaban->jawaban =  $excerpt ;
        $jawaban->kelas_id = $request->kelas_id;
        $jawaban->tugas_id = $id;
        $jawaban->status = 1;
        $jawaban->users_id = auth()->user()->id;
        $jawaban->save();
        return redirect()->route('dikerjakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::all();
        $gurumapel = Gurumapel::all();
        $tugas = Tugas::with('kolomTugas')->findOrFail($id);
        $user_id = Auth::id();
        $jawaban = Jawaban::where('tugas_id', $id)
                          ->where('users_id', $user_id)
                          ->get();

        return view('tugas.answer', compact('gurumapel', 'tugas', 'kelas', 'jawaban'));
    }


    public function showAnswer($id){
        $kelas = Kelas::all();
        $gurumapel = Gurumapel::all();
        $tugas = Tugas::find($id);
        $jawaban = Jawaban::where('tugas_id', $id)->get();
    
        return view('tugas.showTb', compact('gurumapel', 'tugas', 'kelas', 'jawaban'));
    }
    
    public function cetakJawaban(){
        $user_id = Auth::id();
        $jawaban = Jawaban::select('*')->where('users_id', $user_id)->get();

        $pdf = PDF::loadView('tugas.cetakJawaban', ['jawaban' => $jawaban]);
        return $pdf->stream('Tugas.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
