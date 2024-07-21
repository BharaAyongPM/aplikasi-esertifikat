<!-- resources/views/kegiatan/edit.blade.php -->

@extends('admin.dashboard.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
                    <h2 strong class="fw-bold text-center mb-4">Edit Kegiatan</h2>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-2 ">
                            <div class="card">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="card mt-5 mx-2">
                            <div class="card-body">
                                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $kegiatan->nama }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyelenggara">Penyelenggara:</label>
                                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="{{ $kegiatan->penyelenggara }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Kegiatan</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $kegiatan->deskripsi }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="certificate_number">Nomor Sertifikat:</label>
                                        <input type="text" class="form-control" id="certificate_number" name="certificate_number" value="{{ $kegiatan->certificate_number }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal->toDateString() }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">Logo:</label>
                                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                        @if($kegiatan->logo)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$kegiatan->logo) }}" alt="Logo" style="width: 150px; height: auto;">

                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="template">Template:</label>
                                        <input type="file" class="form-control" id="template" name="template" accept="image/*">
                                        @if($kegiatan->template)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$kegiatan->template) }}" alt="Template" style="width: 150px; height: auto;">
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-info">Update</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
