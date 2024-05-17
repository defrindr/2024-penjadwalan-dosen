@extends('layouts.main')

@section('title', 'Edit Kegiatan')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Kegiatan</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="myForm" action="{{ route('updateKegiatan', $kegiatan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="NIP" class="col-sm-2 col-form-label">Nama Dosen:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="NIP" name="NIP" required>
                    <option disabled value="">Pilih Nama Dosen</option>
                    @foreach ($dosen as $d)
                    <option value="{{ $d->NIP }}" {{ $d->NIP == $kegiatan->NIP ? 'selected' : '' }}>{{ $d->nama_dosen }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="tugas" class="col-sm-2 col-form-label">Tugas:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="tugas" name="tugas" value="{{ $kegiatan->tugas }}" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal ?? date('Y-m-d') }}" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="waktu" class="col-sm-2 col-form-label">Waktu:</label>
                <div class="col-sm-5">
                  <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="{{ $kegiatan->waktu_mulai }}" required>
                </div>
                <div class="col-sm-5">
                  <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="{{ $kegiatan->waktu_selesai }}" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  @if($kegiatan->surat_tugas)
                  <p>File yang sudah diunggah: {{ $kegiatan->surat_tugas }}</p>
                  @else
                  <p>Belum ada file yang diunggah.</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <label for="surat_tugas">Surat Tugas:</label>
                  <input type="file" id="surat_tugas" name="surat_tugas">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection