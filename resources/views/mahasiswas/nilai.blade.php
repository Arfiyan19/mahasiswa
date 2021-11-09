@extends('mahasiswas.layout')
@section('content')
<div class="col-md-4">
    <h1>Kartu Hasil Studi (KHS)</h1>
    <div class="card">
        <div class="card-body">
            <b>Nim : </b> {{$mahasiswa->Nim}}
            <br><br>
            <b>Nama : </b> {{$mahasiswa->Nama}}
            <br><br>
            <b>Kelas : </b> {{$mahasiswa->Kelas->nama_kelas}}
        </div>
    </div>
    <br>
</div>
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" border="1">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                </tr>
                @foreach ($nilai as $item)
                <tr>
                    <td> {{ $item->nama_matkul }} </td>
                    <td> {{ $item->sks }} </td>
                    <td> {{ $item->semester }} </td>
                    <td> {{ $item->nilai }} </td>
                </tr>
                @endforeach
            </table>
            <a class="btn btn-danger" href="{{route('mahasiswas.index')}}">Kembali</a>
    <a class="btn btn-primary float-right" href="{{route('mahasiswas.cetak_pdf', $mahasiswa->Nim)}}" target="_blank">Print</a>
        </div>
    </div>
</div>
@endsection
