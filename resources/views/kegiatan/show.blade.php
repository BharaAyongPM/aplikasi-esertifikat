<!-- resources/views/kegiatan/show.blade.php -->

@extends('admin.dashboard.app')

@section('content')
<style>
    .detail-group {
        border-bottom: 1px solid #ccc; /* Garis horizontal di bawah setiap grup */
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .image-container {
        text-align: center; /* Memusatkan gambar */
    }
    .image-container img {
        max-width: 100%; /* Membuat gambar responsive */
        height: auto;
        max-height: 300px; /* Maksimal tinggi gambar */
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <h2 strong class="fw-bold text-center mb-4">Detail Kegiatan</h2>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group detail-group">
                                        <label><strong>Nama:</strong></label>
                                        <p>{{ $kegiatan->nama }}</p>
                                    </div>
                                    <div class="form-group detail-group">
                                        <label><strong>Penyelenggara:</strong></label>
                                        <p>{{ $kegiatan->penyelenggara }}</p>
                                    </div>
                                    <div class="form-group detail-group">
                                        <label><strong>Nomor Sertifikat:</strong></label>
                                        <p>{{ $kegiatan->certificate_number }}</p>
                                    </div>
                                    <div class="form-group detail-group">
                                        <label><strong>Tanggal:</strong></label>
                                        <p>{{ $kegiatan->tanggal->format('d M Y') }}</p>
                                    </div>
                                    <div class="form-group detail-group">
                                        <label><strong>Logo:</strong></label>
                                        <div class="image-container">
                                            @if($kegiatan->logo)
                                                <img src="{{ asset('storage/'.$kegiatan->logo) }}" alt="Logo">
                                            @else
                                                <p>No logo available</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group detail-group">
                                        <label><strong>Template:</strong></label>
                                        <div class="image-container">
                                            @if($kegiatan->template)
                                                <img src="{{ asset('storage/'.$kegiatan->template) }}" alt="Template">
                                            @else
                                                <p>No template available</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <form action="{{ route('kegiatan.uploadParticipants', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="participant_file" accept=".xlsx, .xls" required>
                                            <button type="submit" class="btn btn-primary">Upload Data Peserta</button>
                                        </form>
                                    </div>

                                    <!-- Tombol untuk Menampilkan Daftar Sertifikat -->
                                    <div class="form-group mt-4">
                                        <a href="{{ route('kegiatan.participants', $kegiatan->id) }}" class="btn btn-success">Daftar Peserta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
