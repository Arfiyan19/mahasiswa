@extends('mahasiswas.layout')
  
@section('content')
   
<div class="container mt-5">
   
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Edit mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('mahasiswas.update', $mahasiswa->Nim) }}" id="myForm" enctype='multipart/form-data' >
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="Nim">Nim</label>                    
                    <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->Nim }}" aria-describedby="Nim" >                
                </div>
                <div class="form-group">
                    <label for="Nama">Nama</label>                    
                    <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->Nama }}" aria-describedby="Nama" >                
                </div>
                <div class="form-group">
                    <label for="Kelas">Kelas</label>                    
                    <select name="Kelas" class="form-control">
                        @foreach ($kelas  as $kls)
                        <option value="{{$kls->id}}" {{$mahasiswa->kelas_id == $kls->id ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group">
                    <label for="Jurusan">Jurusan</label>                    
                    <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->Jurusan }}" aria-describedby="Jurusan" >                
                </div>
                <div class="form-group">
                            <label for="">Foto</label>
                            <br>
                            <img width="150px" src="{{asset('storage/'.$mahasiswa->foto)}}">
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
