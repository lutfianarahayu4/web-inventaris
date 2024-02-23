<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Peminjaman</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <a href="{{ route('siswas.index') }}" class="btn btn-md btn-secondary">DATA SISWA</a>
                    <a href="{{ route('barang.index') }}" class="btn btn-md btn-info">DATA BARANG</a>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-md btn-info">DATA PEMINJAMAN</a>
                </div>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA PINJAM</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Siswa</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse ($peminjaman as $peminjamans)
                                <tr>
                                    <td>{{ $peminjamans->siswa->nama }}</td>
                                    <td>{{ $peminjamans->barang->nama_barang }} </td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/posts/').$peminjamans->barang->gambar }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $peminjamans->tanggal_pinjam }}</td>
                                    <td>{{ $peminjamans->tanggal_kembali }}</td>
                                    <td>{{ $peminjamans->kondisi }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peminjaman.destroy', $peminjamans->id) }}" method="POST">
                                            <a href="{{ route('peminjaman.edit', $peminjamans->id) }}" class="btn btn-sm btn-primary"> <i data-feather="edit-3"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <tr>
                                      <td colspan="7" class="text-center">Data Peminjaman belum tersedia.</td>
                                  </tr>
                              @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>
    <script>
        feather.replace();
    </script>
</body>
</html>
