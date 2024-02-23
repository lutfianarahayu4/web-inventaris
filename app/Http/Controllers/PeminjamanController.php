<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Barang;
use App\Models\Inventaris;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get posts
        $peminjaman = Peminjaman::latest()->paginate(5);

        //render view with posts
        return view('peminjaman.index', compact('peminjaman'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peminjaman = peminjaman::all();
        $siswas = Siswa::all();
        $barang = Barang::all();

        return view('peminjaman.create', compact('peminjaman', 'siswas', 'barang'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return('oke');
    
        $this->validate($request, [
            'id_siswa' => 'required',
            'id_barang' => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'nullable',
            'kondisi' => 'required',
        ]);

        //upload image
        $image = $request->file('gambar');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        peminjaman::create([
            'id_siswa' => $request->id_siswa,
            'gambar'     => $image->hashName(),
            'id_barang' => $request->id_barang,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi' => $request->kondisi
        ]);
        // dd($request->all());
       
        return redirect()->route('peminjaman.index')->with('success', 'Data Peminjaman Berhasil Disimpan!');

        
    }

  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id);
        $siswas = Siswa::all();
        $barang = Barang::all();

        return view('peminjaman.edit', compact('peminjaman', 'siswas', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peminjaman $peminjaman)
    {
        // Validate form data
        $request->validate([
            'id_siswa' => 'required',
            'id_barang' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'kondisi' => 'required',
        ]);
    
        // Update Peminjaman instance
        $peminjaman->update([
            'id_siswa' => $request->id_siswa,
            'id_barang' => $request->id_barang,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi' => $request->kondisi,
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('peminjaman.index')->with('success', 'Data Peminjaman Berhasil Diperbarui!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $peminjaman=peminjaman::find($id);
        $peminjaman->delete();
 
        return redirect()->route('peminjaman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}