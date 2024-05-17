@extends('layouts.main')

@section('title', 'Kegiatan Dosen')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('tambahKegiatan')}}" class="btn btn-success btn-sm"> <!-- Tambahkan kelas btn-sm -->
              <i class="fas fa-plus-square"></i> <!-- Ikon -->
            <span> Tambah Kegiatan</span> <!-- Teks -->
        </a>
        <form action="{{ route('searchKegiatan') }}" method="GET" class="float-right">
          <!-- Menggunakan float-right untuk memindahkan form ke kanan -->
          <div class="input-group">
            <input type="date" class="form-control" name="date" placeholder="Search by Date">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead style="text-align: center;">
            <tr>
              <th class="text-center">No</th>
              <th>Nama Dosen</th>
              <th>Pemberi Tugas</th>
              <th>Nama Kegiatan</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Surat Tugas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dtKegiatan as $index => $d)
            <tr>
              <td class="text-center">{{ $index + 1 }}</td>
              <td>{{ optional($d->dosen)->nama_dosen }}</td>
              <td>{{ $d->tugas }}</td>
              <td>{{ $d->nama_kegiatan }}</td>
              <td>{{ $d->tanggal }}</td>
              <td>{{ $d->waktu_mulai }} - {{ $d->waktu_selesai }}</td>
              <!-- Kolom waktu -->
              <td>
                <a href="{{ asset('/pdf/' . $d->surat_tugas) }}" target="_blank" rel="noopener noreferrer">Lihat Surat Tugas</a>
              </td>
              <td class="text-center">
                <!-- Edit Button -->
                <a href="{{ route('editKegiatan', $d->id)}}" type="button" class="btn btn-sm btn-primary">
                  <i class="fas fa-edit"></i></a>
                <!-- Delete Button -->
                <a href="{{ route('deleteKegiatan', $d->id)}}" type="button" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash-alt"></i></a>
                <!-- ... bagian JavaScript SweetAlert ... -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="{{ $dtKegiatan->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
          @for ($i = 1; $i <= $dtKegiatan->lastPage(); $i++)
          <li class="page-item{{ $dtKegiatan->currentPage() === $i ? ' active' : '' }}">
            <a class="page-link" href="{{ $dtKegiatan->url($i) }}">{{ $i }}</a>
          </li>
          @endfor
          <li class="page-item"><a class="page-link" href="{{ $dtKegiatan->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
        </ul>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
