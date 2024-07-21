<!-- resources/views/kegiatan/index.blade.php -->

@extends('admin.dashboard.app')

@section('content')
<div class="container">
    <h1>Daftar Kegiatan</h1>
    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">Tambah Kegiatan Baru</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Penyelenggara</th>
                <th>Tanggal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatan as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->penyelenggara }}</td>
                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('kegiatan.show', $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
