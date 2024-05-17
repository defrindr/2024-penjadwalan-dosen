@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-8">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>01</h3>
            <p>Kegiatan Dosen</p>
          </div>
          <div class="icon">
            <i class="fas fa-clipboard"></i>
          </div>
          <a href="/kegiatanDosen" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    </div>
    <!-- /.row (main row) -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
