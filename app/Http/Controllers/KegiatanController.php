<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantsImport;
use App\Models\Certificate;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'logo' => 'nullable|image',
            'template' => 'required|file',
            'certificate_number' => 'nullable|string' // Menambahkan validasi untuk nomor sertifikat.
        ]);

        $kegiatan = new Kegiatan($request->all());
        $kegiatan->id_user = auth()->id();
        if ($request->hasFile('logo')) {
            $kegiatan->logo = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('template')) {
            $kegiatan->template = $request->file('template')->store('templates', 'public');
        }
        $kegiatan->save();

        return redirect()->route('kegiatan.index');
    }
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama' => 'required',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'logo' => 'nullable|image',
            'template' => 'file',
            'certificate_number' => 'nullable|string' // Validasi untuk nomor sertifikat.
        ]);

        // Ambil semua data kecuali data file
        $data = $request->except(['logo', 'template']);

        // Update data non-file terlebih dahulu
        $kegiatan->update($data);

        // Proses file logo jika ada
        if ($request->hasFile('logo')) {
            $kegiatan->logo = $request->file('logo')->store('logos', 'public');
            $kegiatan->save(); // Simpan perubahan path logo
        }

        // Proses file template jika ada
        if ($request->hasFile('template')) {
            $kegiatan->template = $request->file('template')->store('templates', 'public');
            $kegiatan->save(); // Simpan perubahan path template
            // $request->session()->flash('success', 'Kegiatan berhasil diperbarui!');
        }

        return redirect()->route('kegiatan.index');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index');
    }

    public function uploadParticipants(Request $request, $kegiatanId)
    {
        $file = $request->file('participant_file');

        // Membuat instance import dengan menyertakan id_kegiatan
        $import = new ParticipantsImport($kegiatanId);
        Excel::import($import, $file);

        return redirect()->route('kegiatan.show', $kegiatanId)->with('success', 'Data peserta telah diupload dan sertifikat dibuat.');
    }



    private function generateCertificateNumber($kegiatanId)
    {
        $number = Kegiatan::find($kegiatanId)->certificate_number;
        return $number . rand(100, 999);
    }

    private function generateQrCode($certificateNumber)
    {
        $url = "http://127.0.0.1:8000/verif/" . $certificateNumber;
        $qrCodePath = 'qrcodes/' . $certificateNumber . '.svg';
        QrCode::size(200)->format('svg')->generate($url, public_path($qrCodePath));
        return $qrCodePath;
    }

    public function publicIndex()
    {
        $kegiatan = Kegiatan::paginate(10); // Ambil semua kegiatan, sesuaikan query jika perlu (misal, hanya kegiatan yang aktif)
        return view('home.index', compact('kegiatan'));
    }
    public function publicShow(Kegiatan $kegiatan)
    {
        return view('home.show', compact('kegiatan'));
    }

    public function searchCertificate(Request $request, Kegiatan $kegiatan)
    {
        $phoneNumber = $request->input('phone_number');
        $certificate = Certificate::where('id_kegiatan', $kegiatan->id)
            ->where('phone_number', $phoneNumber)
            ->first();

        if (!$certificate) {
            return redirect()->back()->with('error', 'Maaf, Nomor telepon yang anda masukan salah atau tidak ada dalam data kami.');
        }

        // Jika sertifikat ditemukan, alihkan ke halaman detail sertifikat
        return redirect()->route('public.certificate.show', $certificate->id);
    }
    public function showCertificate(Certificate $certificate)
    {
        return view('home.showsertif', compact('certificate'));
    }

    public function createCertificate(Certificate $certificate)
    {
        $kegiatan = $certificate->kegiatan;
        if (!$kegiatan) {
            abort(404, "Kegiatan tidak ditemukan untuk sertifikat ini.");
        }

        $templatePath = public_path('storage/' . $kegiatan->template);
        $templateType = pathinfo($templatePath, PATHINFO_EXTENSION);
        $templateData = file_get_contents($templatePath);
        $templateBase64 = 'data:image/' . $templateType . ';base64,' . base64_encode($templateData);

        $qrPath = public_path($certificate->qrcode); // Pastikan jalur ini benar
        $qrType = pathinfo($qrPath, PATHINFO_EXTENSION);
        $qrData = file_get_contents($qrPath);
        $qrBase64 = 'data:image/' . $qrType . ';base64,' . base64_encode($qrData);

        return FacadePdf::loadView('certificate_pdf', [
            'certificate' => $certificate,
            'kegiatan' => $kegiatan,
            'backgroundImage' => $templateBase64,
            'qrCodeImage' => $qrBase64, // Menggunakan nama yang lebih deskriptif
        ])->setPaper('a4', 'landscape')
            ->setOptions(['dpi' => 250])
            ->stream('certificate.pdf');
    }


    public function verifyCertificate($certificate_number)
    {
        Log::info('Received number in URL: ' . $certificate_number);

        $adjusted_number = str_replace('-', '/', $certificate_number);
        Log::info('Adjusted number for query: ' . $adjusted_number);

        $certificate = Certificate::where('certificate_number', $adjusted_number)->first();

        if (!$certificate) {
            Log::error('Certificate not found for number: ' . $adjusted_number);
            abort(404, 'Sertifikat tidak ditemukan.');
        }

        return view('home.verify', compact('certificate'));
    }
    public function showParticipants($kegiatanId)
    {
        $kegiatan = Kegiatan::with('certificates')->findOrFail($kegiatanId);  // Asumsi Anda memiliki relasi `participants` dalam model `Kegiatan`

        return view('kegiatan.participants', compact('kegiatan'));
    }

    public function downloadCertificate($certificateId)
    {
        // Ambil sertifikat dan pastikan modelnya adalah 'Certificate'
        $certificate = Certificate::with('kegiatan')->findOrFail($certificateId); // Asumsi 'kegiatan' adalah relasi dalam model 'Certificate'

        // Ambil kegiatan dari relasi
        $kegiatan = $certificate->kegiatan;

        // Jika kegiatan tidak ada, handle kasus ini
        if (!$kegiatan) {
            abort(404, "Kegiatan tidak ditemukan untuk sertifikat ini.");
        }

        // Persiapan gambar latar belakang
        $path = public_path('storage/' . $kegiatan->template);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Gunakan PDF facade untuk membuat PDF
        return FacadePdf::loadView('certificate_pdf', [
            'certificate' => $certificate,
            'kegiatan' => $kegiatan,
            'backgroundImage' => $base64
        ])->setPaper('a4', 'landscape')->stream('certificate.pdf');
    }
}
