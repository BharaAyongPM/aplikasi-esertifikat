@extends('admin/dashboard/app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard\template\css\cards.css') }}">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col">
                            <a href="#" class="text-decoration-none">
                                <div class="card mb-2">
                                    <div class="card-body d-flex align-self-center">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="fw-bold text-black">
                                                    Total <br> Pemain
                                                </div>
                                                <div class="card-title" style="font-size: 24px">-----</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="mdi mdi-archive" style="color: #097b96"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col">
                            <a href="#" class="text-decoration-none">
                                <div class="card mb-2">
                                    <div class="card-body d-flex align-self-center">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="fw-bold text-black">
                                                    Total <br> Klub/Tim
                                                </div>
                                                <div class="card-title" style="font-size: 24px">-------</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="mdi mdi-file-document" style="color: #097b96"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col">
                            <a href="#" class="text-decoration-none">
                                <div class="card mb-2">
                                    <div class="card-body d-flex align-self-center">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="fw-bold text-black">
                                                    Total <br>
                                                     Liga
                                                </div>
                                                <div class="card-title" style="font-size: 24px">--------</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="mdi mdi-file-check" style="color: #097b96"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col">
                            <a href="#" class="text-decoration-none">
                                <div class="card mb-2">
                                    <div class="card-body d-flex align-self-center">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="fw-bold text-black">
                                                    Jadwal<br>
                                                    Total
                                                </div>
                                                <div class="card-title" style="font-size: 24px">----------</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="mdi mdi-file-check" style="color: #097b96"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <form action="{{ route('tuanrumah.home') }}" method="get">
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai:</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form> --}}
                <div class="container">
                    <div class="card mt-4">
                        {{-- <div class="card-body">
                            <table class="table">
                                <thead>
                                    <h4>Daftar Jadwal Pertandingan Terbaru</h4>
                                    <tr>
                                        <th>Liga</th>
                                        <th>Tuan Rumah</th>
                                        <th>Tamu</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Tempat</th>
                                        <th>Skor Tuan Rumah</th>
                                        <th>Skor Tamu</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->liga->nama_liga }}</td>
                                            <td>{{ $jadwal->timTuanRumah->nama_club }}</td>
                                            <td>{{ $jadwal->timTamu->nama_club }}</td>
                                            <td>{{ $jadwal->hari }}</td>
                                            <td>{{ $jadwal->tanggal }}</td>
                                            <td>{{ $jadwal->jam }}</td>
                                            <td>{{ $jadwal->tempat }}</td>
                                            <td>{{ $jadwal->skor_tuan_rumah }}</td>
                                            <td>{{ $jadwal->skor_tim_tamu }}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">Tidak ada jadwal pertandingan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                </div> --}}
                    </div>
                </div>
                <div class="container">
                    <div class="card mt-4">
                        {{-- <div class="card-body">
                            <table class="table">
                                <thead>
                                    <h4>Daftar Liga</h4>
                                    <tr>
                                        <th>Nama Liga</th>
                                        <th>Jumlah Club</th>
                                        <th>Tahun</th>
                                        <th>Penyelenggara</th>
                                        <th>Logo</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ligas as $liga)
                                        <tr>
                                            <td>{{ $liga->nama_liga }}</td>
                                            <td>{{ $liga->jumlah_tim }}</td>
                                            <td>{{ $liga->tahun_penyelenggaraan }}</td>
                                            <td>{{ $liga->nama_penyelenggara }}</td>
                                            <td>
                                                @if ($liga->logo_liga)
                                                <img src="{{ asset('storage/logos/' . $liga->logo_liga) }}" class="rounded-circle" alt="Logo Liga" style="width: 100px; height: 100px;">
                                                @else
                                                    Tidak ada poster
                                                @endif
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Tidak ada data liga.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

            </div> --}}
        </div>
    </div>
</div>
@endsection
