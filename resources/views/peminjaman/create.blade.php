<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAMBAH PEMINJAMAN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('siswas.index') }}">SISWA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('barang.index') }}">BARANG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('peminjaman.index') }}">PEMINJAMAN</a>
              </li>
          </div>
        </div>
      </nav>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-md btn-secondary"><< KEMBALI</a>
                </div>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('POST')


                            <div class="form-group">
                                <label class="font-weight-bold">NAMA</label>
                                <select class="form-control @error('id_siswa') is-invalid @enderror" name="id_siswa" size="1">
                                    <option value="" selected disabled> Pilih Nama Siswa </option>
                                    {{-- Looping untuk menampilkan nama-nama siswa --}}
                                    @foreach($siswas as $siswas)
                                        <option value="{{ $siswas->id }}">{{ $siswas->nama }}</option>
                                    @endforeach
                                </select>

                                <!-- error message untuk id_siswa -->
                                @error('id_siswa')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-control @error('id_barang') is-invalid @enderror" name="id_barang" id="id_barang" size="1">
                                    <option value="" selected disabled> Pilih Nama Barang </option>
                                    @foreach($barang as $item)
                                        <option value="{{ $item->id }}" data-image="{{ asset('storage/barang/' . $item->image) }}">
                                            {{ $item->nama_barang }}
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
                                {{-- <input type="file" name="gambar" id="gambar" > --}}
                                <input type="file" class="form-control" name="gambar">
                                {{-- <img id="gambar_barang" src="" alt="Gambar Barang" style="width: 250px;"> --}}
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL PINJAM</label>
                                <input type="datetime-local" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">

                                <!-- error message untuk tgl_bayar -->
                                @error('tanggal_pinjam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KEMBALI</label>
                                <input type="datetime-local" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">

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
                                    <option value="BAIK" {{ (old('kondisi') == 'BAIK') ? 'selected' : '' }}>BAIK</option>
                                    <option value="KURANG BAIK" {{ (old('kondisi') == 'KURANG BAIK') ? 'selected' : '' }}>KURANG BAIK</option>
                                    <option value="RUSAK" {{ (old('kondisi') == 'RUSAK') ? 'selected' : '' }}>RUSAK</option>
                                </select>

                                <!-- error message untuk nama -->
                                @error('kondisi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
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
    <!-- Add this at the end of your create.blade.php file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_barang').change(function() {
            var barangId = $(this).val();

            // Make an AJAX request to get the image URL based on the selected id_barang
            $.ajax({
                type: 'GET',
                url: '/get-barang-image/' + barangId, // Replace with your route
                success: function(response) {
                    // Update the image source with the fetched URL
                    $('#barangImage').attr('src', response.image_url);
                },
                error: function(error) {
                    console.error('Error fetching image:', error);
                }
            });
        });
    });
</script>

</script>
</body>
</html>