@extends('layouts.app')
@section('content')
<div class="container p-4">
    <div class="card">
        <div class="card-header">
            Data Mahasiswa
        </div>
        <div class="card-body">
            
            <div class="d-flex mb-3">
            <form action="{{route('mahasiswa.index')}}">
                <input class="col-md" type="text" name="keyword" class="form-control" placeholder="pencarian ..." value="{{old('keyword')}}" style="width:700px; padding:5px;" />
                </form>
                <div class="ms-auto">
                    <a href="{{route('mahasiswa.print')}}" class="btn btn-success">Cetak Data</a>
                    <a href="{{route('mahasiswa.create')}}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            
                            
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Jurusan</th>
            <th scope="col">NPM</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Foto</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $data)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->jurusan}}</td>
            <td>{{$data->npm}}</td>
            <td>{{$data->nama}}</td>
            <!-- <td>{{$data->tanggal_lahir}}</td> -->
            <td>{{Carbon\carbon::parse($data->tanggal_lahir)->format('d-m-Y')}}</td>
            <td>
                 <img src="{{asset('storage/mahasiswa/'.$data->foto)}}" alt="" width="60">
            </td>
            
            <td>
            
                <form action="{{route('mahasiswa.delete', $data->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{route('mahasiswa.edit', $data->id)}}" class="btn btn-warning">Edit</a>
                    <button href="" class="btn btn-danger">Hapus</button>
                
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
    