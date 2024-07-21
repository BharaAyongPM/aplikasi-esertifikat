<!-- resources/views/players/create.blade.php -->

@extends('admin.dashboard.app')

@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<link rel="stylesheet" href="{{ asset('dashboard\template\css\cards.css') }}">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <h2 strong class="fw-bold text-center mb-4">Tambah Pemain</h2>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-2 ">
                            <div class="card">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="card mt-5 mx-2">
                            <div class="card-body">
                                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Kegiatan</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
            <label for="certificate_number">Nomor Sertifikat</label>
            <input type="text" class="form-control" id="certificate_number" name="certificate_number" required>
        </div>

        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="template">Template</label>
            <input type="file" class="form-control" id="template" name="template" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-info">Tambah</button>
    </form>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
