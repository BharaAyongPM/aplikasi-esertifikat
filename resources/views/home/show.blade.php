@extends('home.app')

@section('content')
<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Main Banner START -->
<section style="background-image: url('{{ asset('assets/images/header-liga.png') }}'); background-position: center; background-size: cover; margin-top: -56px;" class="position-relative h-600px">
	<div class="bg-overlay bg-dark opacity-5"></div>
	<div class="container position-relative mt-0 z-index-9">
		<div class="row mt-md-3 pt-3 mx-auto text-center col-md-6 align-items-center justify-content-center">
			<div class="text-white align-items-center">
				<!-- Title -->
				 <br> <br>
				<h1 class="mb-3 text-white">{{ $kegiatan->nama }}</h1>
				<h6 class="mb-3 text-warning">{{ $kegiatan->deskripsi }}</h6>
				<!-- Button -->
				 <h6 class="text-warning">Sertifikat dapat peserta unduh melalui link berikut. Selalu Semangat dalam segala hal. Terima kasih kami sampaikan atas kepercayaan anda</h6>
				 <br>
				 <form action="{{ route('public.kegiatan.searchCertificate', $kegiatan->id) }}" method="POST">
					@csrf
					<input type="text" name="phone_number" class="form-control shadow-sm" placeholder="Masukkan Nomor Telepon Anda" required>
<br>

					<button type="submit" class="btn btn-success">Cari Sertifikat</button>
                    <h6 class="text-warning">Jika nomor tidak ada anda bisa mencoba memasukan nomor telepon tanpa angka 0 di depannya contoh 08222560346 menjadi 8222560346</h6>
			</form>
			</div>
		</div>
	</div>

</section>
<div id="errorModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #222; color: #fff;">
            <div class="modal-header">
                <h5 class="modal-title text-warning">Error</h5>
                <button type="button" class="close" onclick="closeErrorModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ session('error') }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error END -->

<script>
    function openErrorModal() {
        document.getElementById('errorModal').style.display = 'block';
    }

    function closeErrorModal() {
        document.getElementById('errorModal').style.display = 'none';
    }

    @if(session('error'))
        openErrorModal();
    @endif
</script>
<!-- Modal START -->
<div id="downloadModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="background-color: #222; color: #fff;">
			<div class="modal-header">
				<h5 class="modal-title text-warning">Unduh Sertifikat</h5>
				<button type="button" class="close" onclick="closeModal()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="sertifikat.html" method="POST">
					<div class="form-group">
						<label for="phoneNumber">Masukkan No HP</label>
						<input type="text" class="form-control" id="phoneNumber" placeholder="Contoh: 08123456789">
					</div>
					<button type="submit" class="btn btn-custom mt-3" style="background-color: #dc3545; color: #fff;">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- =======================
Main Banner END -->

</main>
<script>
	function openModal() {
		document.getElementById('downloadModal').style.display = 'block';
	}

	function closeModal() {
		document.getElementById('downloadModal').style.display = 'none';
	}
</script>
@endsection


