@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">`
            <div class="pull-left mt-2">
                <h2 style="padding-bottom: 50px;">JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input mhs</a>
                
            </div>
            <form action="{{ route('search') }}" method="GET">
		<input type="text" name="search" placeholder="Cari mhs .." value="{{ old('search') }}">
		<input type="submit" value="CARI">
	</form>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">

        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Foto</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($paginate as $mhs)
        <tr>
            
            <td>{{ $mhs->Nim }}</td>
            <td>{{ $mhs->Nama }}</td>
            <td> <img width="80px" src="{{asset('storage/'.$mhs->foto)}}"> </td>
            <td>{{ $mhs->kelas->nama_kelas}}</td>
            <td>{{ $mhs->Jurusan }}</td>
            <td>
            <form action="{{ route('mahasiswas.destroy',$mhs->Nim) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('mahasiswas.show',$mhs->Nim) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$mhs->Nim) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('mahasiswas.nilai',$mhs->Nim) }}">Nilai</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            
        </td>
    </tr>
    
    @endforeach
</table>
</style>
<footer>
    <br/>
    
</footer>
{{ $paginate->links() }}

    @endsection
