<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get siswas
        $siswas = Siswa::latest()->paginate(5);

        //render view with siswas
        return view('siswas.index', compact('siswas'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required',
            'kelas'   => 'required'
        ]);

        //create siswa
        Siswa::create([
            'nama'     => $request->nama,
            'kelas'   => $request->kelas
        ]);

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Disimpan!']);

         }
    
    /**
     * edit
     *
     * @param  mixed $siswa
     * @return void
     */
    public function edit(Siswa $siswa)
    {
        return view('siswas.edit', compact('siswa'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $siswa
     * @return void
     */
    public function update(Request $request, Siswa $siswa)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required',
            'kelas'   => 'required'
        ]);

            //update post without image
            $siswa->update([
                'nama'     => $request->nama,
                'kelas'   => $request->kelas
            ]);

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Siswa $siswa)
    {
        //delete post
        $siswa->delete();

        //redirect to index
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}






