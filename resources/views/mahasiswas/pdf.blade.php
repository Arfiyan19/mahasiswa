<style>
    /* create css table */
    table {
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }
    /* create css h1 text align center */
    h1 {
        text-align: center;
    }
</style>
<div class="col-md-4">
    <h1>Kartu Hasil Studi (KHS)</h1>
    <div class="card">
        <div class="card-body">
            <b>Nim : </b> {{$mahasiswa->Nim}}
            <br><br>
            <b>Nama : </b> {{$mahasiswa->Nama}}
            <br><br>
            <b>Kelas : </b> {{$mahasiswa->kelas->nama_kelas}}
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
        </div>
    </div>
</div>