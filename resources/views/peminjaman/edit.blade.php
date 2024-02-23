<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT DATA peminjamen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA</label>
                                <select class="form-control @error('id_siswa') is-invalid @enderror" name="id_siswa" size="1">
                                    {{-- Looping to populate student names --}}
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ ($peminjaman->id_siswa == $siswa->id) ? 'selected' : '' }}>{{ $siswa->nama }}</option>
                                    @endforeach
                                </select>

                                <!-- error message untuk kelas -->
                                @error('id_siswa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-control @error('id_barang') is-invalid @enderror" name="id_barang" id="id_barang" size="1">
                                    @foreach($barang as $barang)
                                        <option value="{{ $barang->id }}" data-image="{{ asset('storage/barang/' . $barang->image) }}" {{ ($peminjaman->id_barang == $barang->id) ? 'selected' : '' }}>
                                            {{ $barang->nama_barang}} 
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message untuk id_barang -->
                                @error('id_barang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <img id="gambar_barang" src="{{ Storage::url('public/posts/').$peminjaman->gambar }}" alt="Gambar Barang" style="width: 250px;">
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL PINJAM</label>
                                <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}">
                            
                                <!-- error message untuk tgl_bayar -->
                                @error('tanggal_pinjam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KEMBALI</label>
                                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}">
                            
                                <!-- error message untuk tgl_bayar -->
                                @error('tanggal_kembali')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="font-weight-bold">KONDISI PENGEMBALIAN</label>
                                <select class="form-control @error('kondisi') is-invalid @enderror" name="kondisi" size="1">
                                    <option value="" selected disabled> Pilih Kondisi Barang </option>
                                    <option value="BAIK" {{ $peminjaman->kondisi =='BAIK' ?'selected':''}}>Baik</option>
                                    <option value="KURANG BAIK" {{ $peminjaman->kondisi =='KURANG BAIK' ?'selected':''}}>Kurang Baik</option>
                                    <option value="RUSAK" {{ $peminjaman->kondisi =='RUSAK' ?'selected':''}}>Rusak</option>
                                </select>
                            
                                <!-- error message untuk kondisi -->
                                @error('kondisi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Ketika pilihan barang berubah
        $('#id_barang').change(function () {
            var selectedImage = $(this).find(':selected').data('image');
            // Ganti src gambar
            $('#gambar_barang').attr('src', selectedImage);
        });
    });
</script>
</body>
</html>