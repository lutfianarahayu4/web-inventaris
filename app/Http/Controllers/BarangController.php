<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        //get posts
        $barangs = Barang::latest()->paginate(5);

        //render view with posts
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/posts', $gambar->hashName());

        Barang::create([
            'nama_barang'   => $request->nama_barang,
            'gambar'     => $gambar->hashName(),
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        //validate form
        $this->validate($request, [
            'nama_barang'   => 'required',
            'gambar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
    
        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$barang->image);

            //update post with new image
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'gambar'     => $image->hashName(),
            ]);
            

        } else {

            //update post without image
            $barang->update([
                'nama_barang'     => $request->nama_barang,
                'gambar'   => $request->gambar
            ]);
        }

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        Barang::destroy('id', $id);

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Hapus']);
    }
}
