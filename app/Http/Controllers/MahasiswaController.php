<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use PDF;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa=Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('Nim','asc')->simplepaginate(5);
        return view('mahasiswas.index',['mahasiswa' => $mahasiswa,'paginate'=> $paginate]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas =Kelas::all();
        return view('mahasiswas.create',['kelas'  =>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //melakukan validasi data
            $mahasiswa = new Mahasiswa;
            $mahasiswa -> nim = $request-> get('Nim');
            $mahasiswa -> nama = $request-> get('Nama');
            $mahasiswa -> kelas_id = $request-> get('Kelas');
            $mahasiswa -> jurusan = $request-> get('Jurusan');
            if($request->file('foto')){
                $file = $request->file('foto')->store('images', 'public');
                $mahasiswa->foto = $file;
            }
            $mahasiswa->  save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        return view('mahasiswas.detail', ['Mahasiswa' =>$mahasiswa]);

    }
    public function nilai($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->find($Nim);
        // $mahasiswa_matakuliah = DB::table('mahasiswa_matakuliah')->where('name', 'John')->value('email');
        // $mahasiswa_matakuliah = MahasiswaMataKuliah::with('mataKuliah')->where('mahasiswa_id', $id)->get();

        $nilai = DB::table('nilai')
            ->join('matakuliah', 'matakuliah.id', '=', 'nilai.matakuliah_id')
            ->join('mahasiswa', 'mahasiswa.Nim', '=', 'nilai.mahasiswa_id')
            ->select('nilai.*', 'matakuliah.*')
            ->where('mahasiswa_id', $Nim)
            ->get();
        // @dd($nilai);
        return view('mahasiswas.nilai', compact('mahasiswa', 'nilai'));

    }
    public function cetak_pdf($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->find($Nim);
        $nilai = DB::table('nilai')
            ->join('matakuliah', 'matakuliah.id', '=', 'nilai.matakuliah_id')
            ->join('mahasiswa', 'mahasiswa.Nim', '=', 'nilai.mahasiswa_id')
            ->select('nilai.*', 'matakuliah.*')
            ->where('mahasiswa_id', $Nim)
            ->get();

            $pdf = PDF::loadview('mahasiswas.pdf', compact('mahasiswa','nilai'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')-> where ('nim', $Nim)->first();
        $kelas = Kelas::all();
          return view('mahasiswas.edit', compact('mahasiswa','kelas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
     //melakukan validasi data
     $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
    ]);
    $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
    $mahasiswa -> nim = $request-> get('Nim');
    $mahasiswa -> nama = $request-> get('Nama');
    $mahasiswa -> jurusan = $request-> get('Jurusan');
    if($request->file('foto')){
        $file = $request->file('foto')->store('images', 'public');
        $mahasiswa->foto = $file;
}
    $mahasiswa->  save();

    $kelas = new Kelas;
    $kelas ->id = $request ->get('Kelas');
    $mahasiswa -> kelas()->associate($kelas);
    $mahasiswa-> save();

    //jika data berhasil ditambahkan, akan kembali ke halaman utama
    return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');

    }


    public function search(Request $request)
{
	$keyword = $request->search;
        $mahasiswas = Mahasiswa::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'));
   
 
}
}
