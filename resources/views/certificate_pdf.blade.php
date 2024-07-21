<!-- resources/views/certificates/template.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0cm;
        }
        body {
            background: url('{{ $backgroundImage }}') no-repeat center center;
            background-size: cover;
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            color: #333;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content {
            text-align: center;
            width: 100%;
        }
        .spacing-half-br {
            padding-bottom: 0.5em; /* Atau Anda bisa menggunakan pixel, misal '10px' */
    }
    </style>
</head>
<body>
    <div class="content">
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <p style="font-size: 50px;"><strong>NOMOR: {{ $certificate->certificate_number }}</strong></p>


        <p style="font-size: 100px;"><strong>{{ $certificate->name }}</strong></p><br><br><br><br><br>

    </div>
    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
    <img src="{{ $qrCodeImage }}" alt="QR Code" style="width: 300px; height: 300px;">
</body>
</html>

