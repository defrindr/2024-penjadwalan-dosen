@extends('layouts.main')

@section('title', 'Tambah Jadwal')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Jadwal</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="myForm" action="{{ route('simpanJadwal') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if (auth()->user()->role == 'user')
                                    <input type="hidden" name="nip" value="{{ auth()->user()->dosen->nip }}">
                                @else
                                    <div class="form-group row">
                                        <label for="nip" class="col-sm-2 col-form-label">Nama Dosen:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="nip" name="nip" required>
                                                <option value="">Pilih Nama Dosen</option>
                                                @foreach ($dosen as $d)
                                                    <option value="{{ $d->nip }}">{{ $d->nama_dosen }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="jadwal" class="col-sm-2 col-form-label">Matakuliah:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jadwal" name="jadwal"
                                            placeholder="jadwal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="waktu" class="col-sm-2 col-form-label">Waktu:</label>
                                    <div class="col-sm-5">
                                        <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                                            value="00:00" required>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                                            value="00:00" required>
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
