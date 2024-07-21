@extends('home.app')

@section('content')
<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Main Banner START -->
<section style="background-image: url('assets/images/bg-sertif.png'); background-position: center; background-size: cover; margin-top: -56px;" class="position-relative h-600px">
    <!-- <div class="bg-overlay bg-dark opacity-5"></div> -->
    <div class="container position-relative mt-0 z-index-9">
        <div class="row mt-md-3 pt-3 mx-auto text-center col-md-8 align-items-center justify-content-center">
            <div class="text-white align-items-start">
                <!-- Title -->
                <br> <br>
                <h1 class="mb-3">{{ $certificate->kegiatan->nama }}</h1>
                <div class="col-md-6 mx-auto text-start">
                    <!-- Checkmark and Verification -->
                    <div class="mb-3 d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span class="text-warning">Data ditemukan dan terverifikasi</span>
                    </div>

                    <!-- Participant Details -->
                    <div class="mb-3">
                        <h5 class="text-warning mb-1"><strong>Nama :</strong> {{ $certificate->name }} </p>
                        <h5 class="text-warning mb-1"><strong>Nomor :</strong> {{ $certificate->certificate_number }}</p>
                    </div>

                    <!-- Barcode Image -->
                    <div class="mb-3 text-center">
											@if ($certificate->qrcode)
                        <img src="{{ asset($certificate->qrcode) }}" width="150px" height="auto" alt="Barcode" class="img-fluid">
												@endif
											</div>

                    <!-- Button -->

                </div>

            </div>
        </div>
    </div>
</section>

<!-- =======================
Main Banner END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

@endsection
