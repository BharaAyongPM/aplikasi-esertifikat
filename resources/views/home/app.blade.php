

<!DOCTYPE html>
<html lang="en">
<head>
	<title>E SERTIFIKAT BISABOLA</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Eduport- LMS, Education and Course Theme">

	<!-- Favicon -->
    <link href="{{ asset('assets/images/putih_bb.png') }}" rel="shortcut icon">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style2.css') }}">

</head>

<body>

	<!-- Header START -->
	<header class="navbar-light header-static">
	</header>
	<!-- Header END -->



@yield('content')
<footer class="pt-0 bg-success position-relative overflow-hidden">

</footer>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/isotope/isotope.pkgd.min.js"></script>
<script src="assets/vendor/imagesLoaded/imagesloaded.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.js"></script>
<script src="assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>
<script>
	const itemsPerPage = 4;
	let currentPage = 1;
	const items = document.querySelectorAll('.item');

	function showPage(page) {
		const start = (page - 1) * itemsPerPage;
		const end = start + itemsPerPage;
		items.forEach((item, index) => {
			if (index >= start && index < end) {
				item.classList.remove('hidden');
			} else {
				item.classList.add('hidden');
			}
		});
	}

	function goToPage(page) {
		currentPage = page;
		showPage(page);
	}

	function prevPage() {
		if (currentPage > 1) {
			currentPage--;
			showPage(currentPage);
		}
	}

	function nextPage() {
		if (currentPage * itemsPerPage < items.length) {
			currentPage++;
			showPage(currentPage);
		}
	}

	// Initialize the first page
	showPage(1);
</script>

</body>
</html>
