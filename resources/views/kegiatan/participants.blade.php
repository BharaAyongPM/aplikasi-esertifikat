@extends('admin.dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Peserta Kegiatan: {{ $kegiatan->nama }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th> <!-- Kolom penomoran ditambahkan -->
                                        <th>Nama</th>
                                        <th>Nomor Telepon</th>
                                        <th>Download Sertifikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatan->certificates as $participant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Menggunakan properti iteration dari loop -->
                                        <td>{{ $participant->name }}</td>
                                        <td>{{ $participant->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('participant.downloadCertificate', $participant->id) }}" class="btn btn-primary btn-sm">Download</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
