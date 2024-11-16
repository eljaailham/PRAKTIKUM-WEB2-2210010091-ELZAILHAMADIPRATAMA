<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //halaman data mahasiswa
    public function index(Request $request)
    {
        $request->flash();
        $mahasiswa = Mahasiswa::query();

        if(isset($request->keyword))
        {
            $mahasiswa = $mahasiswa->where('nama','LIKE',"%{$request->keyword}%")
                        ->orWhere('npm','LIKE',"%{$request->keyword}%");
        }
        $mahasiswa = $mahasiswa->get();

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    //halaman tambah
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    //halaman simpan data mahasiswa
    public function store(Request $request)
    {
        
        $input = $request->all();
        //proses upload file
        if($request->foto)
        {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa', $input['foto']);
        }
        //proses simpan data
        Mahasiswa::create($input);
        return redirect()->route('mahasiswa.index');
    }

    //Halaman edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit',compact('mahasiswa'));
    }

    //halaman update
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $input = $request->all();
        //proses upload file
        if($request->foto)
        {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa', $input['foto']);
        }
        //proses simpan data
        $mahasiswa->update($input);
        return redirect('/admin/mahasiswa');
    }

    //halaman delete
    public function delete( $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index');
    }


    public function print()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.print',compact('mahasiswa'));
    }

}
