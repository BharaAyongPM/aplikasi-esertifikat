<?php

namespace App\Imports;

use App\Models\Certificate;
use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    protected $kegiatanId;

    public function __construct($kegiatanId)
    {
        $this->kegiatanId = $kegiatanId;
    }

    public function model(array $row)
    {
        try {
            // Membuat nomor sertifikat unik
            $certificateNumber = $this->generateCertificateNumber();

            // Membuat QR code dan menyimpan lokasi file QR code
            $qrCodePath = $this->generateQrCode($certificateNumber);

            // Pastikan bahwa semua field yang dibutuhkan tersedia
            if (empty($row['name']) || empty($row['phone_number'])) {
                throw new \Exception('Field "name" or "phone_number" cannot be empty.');
            }

            return new Certificate([
                'id_kegiatan' => $this->kegiatanId,
                'name' => $row['name'],
                'phone_number' => $row['phone_number'],
                'certificate_number' => $certificateNumber,
                'qrcode' => $qrCodePath
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as per your requirement
            \Log::error('Error importing certificate: ' . $e->getMessage());
            // Optionally, you could also rethrow the exception if you need to bubble it up:
            // throw $e;
        }

        // In case of error, return null or handle as necessary
        return null;
    }

    private function generateCertificateNumber()
    {
        $kegiatan = Kegiatan::find($this->kegiatanId);
        if (!$kegiatan) {
            throw new \Exception("Kegiatan tidak ditemukan");
        }

        $baseCertificateNumber = $kegiatan->certificate_number;

        do {
            $randomNumber = rand(1000, 9999);
            $newCertificateNumber = $baseCertificateNumber . $randomNumber;
            $exists = Certificate::where('certificate_number', $newCertificateNumber)->exists();
        } while ($exists);

        return $newCertificateNumber;
    }



    private function generateQrCode($certificateNumber)
    {
        // Mengganti semua slash di nomor sertifikat dengan strip untuk mencegah pembuatan subdirektori
        $safeCertificateNumber = str_replace('/', '-', $certificateNumber);

        // Menentukan lokasi penyimpanan QR code
        $qrCodePath = public_path('qrcodes/' . $safeCertificateNumber . '.svg');

        // Memeriksa direktori
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0777, true); // Membuat direktori dengan izin read-write-execute untuk semua user
        }

        // Menghasilkan QR code
        QrCode::size(200)->format('svg')->generate('sertifikat.bisabola.id/verif/' . $safeCertificateNumber, $qrCodePath);

        return 'qrcodes/' . $safeCertificateNumber . '.svg';
    }
}
