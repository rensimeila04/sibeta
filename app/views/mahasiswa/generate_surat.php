<?php
require($_SERVER['DOCUMENT_ROOT'] . "/sibeta/public/assets/fpdf/fpdf.php");
$nim = $_SESSION['nim'];
$mahasiswaController = new MahasiswaController($conn);

$mahasiswaDetails = $mahasiswaController->getMahasiswaInfo($nim);
require_once  $_SERVER['DOCUMENT_ROOT'] . '/sibeta/app/controllers/MahasiswaController.php';

$mahasiswaController = new MahasiswaController($conn);

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $logoHeight = 25; // Tinggi logo yang sama
        $logoY = 10; // Posisi Y untuk logo

        // Tambahkan logo di sebelah kiri
        $this->Image($_SERVER['DOCUMENT_ROOT'] . "/sibeta/public/assets/img/logo1.jpg", 10, $logoY, 0, $logoHeight); // (path, x, y, width, height)

        // Tambahkan logo di sebelah kanan
        $this->Image($_SERVER['DOCUMENT_ROOT'] . "/sibeta/public/assets/img/logo2.png", 180, $logoY, 0, $logoHeight); // (path, x, y, width, height)

        // Set font Arial bold 12
        $this->SetFont('Arial', 'B', 12);

        // Title
        $this->SetY($logoY + $logoHeight / 2 - 10); // Menempatkan teks di tengah logo
        $this->MultiCell(0, 6, 'KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI
POLITEKNIK NEGERI MALANG
JURUSAN TEKNOLOGI INFORMASI', 0, 'C');

        // Address
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'Jl. Soekarno Hatta No.9 Malang 65141 Telp (0341) 404424 - 404425', 0, 1, 'C');
        $this->Ln(2); // Tambahkan spasi
        $this->Line(10, $this->GetY(), 200, $this->GetY()); // Garis horizontal

        // Document title
        $this->SetFont('Arial', 'B', 11);
        $this->Ln(5);
        $this->MultiCell(0, 6, 'REKOMENDASI PENGAMBILAN TRANSKRIP DAN IJAZAH
DIPLOMA 3 DAN DIPLOMA 4', 0, 'C');

        // Document number - centered
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, 'NO : 23417/PL2.TI/2016', 0, 1, 'C');

        $this->Ln(5);
    }
}

// Create new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

// Add recipient - using separate Cell commands to maintain margin
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, '', 0, 1, 'L');
$pdf->Cell(0, 6, 'Yth. Ka. Subbag. Administrasi Akademik', 0, 1, 'L');
$pdf->Ln(1); // tambahkan spasi
$pdf->Cell(0, 6, 'Politeknik Negeri Malang', 0, 1, 'L');

$pdf->Ln(5);

// Reset font to normal for main content
$pdf->SetFont('Arial', '', 10);
// Add main content
$pdf->MultiCell(0, 6, 'Kami menyatakan bahwa mahasiswa dibawah ini :', 0, 'L');

// Add student details
$pdf->Ln(5);
$pdf->Cell(30, 6, 'Nama', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(0, 6, $mahasiswaDetails['NamaMahasiswa'], 0, 1, 'L');

$pdf->Cell(30, 6, 'NIM', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(0, 6, $mahasiswaDetails['NIM'], 0, 1, 'L');

$pdf->Cell(30, 6, 'Program Studi', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(0, 6, $mahasiswaDetails['NamaProdi'], 0, 1, 'L');

$pdf->Ln(5);

// Add declaration
$pdf->MultiCell(0, 6, 'Berhak menerima Transkip Ijazah D3 dan D4 Politeknik Negeri Malang, Jurusan Teknologi Informasi, dengan keterangan bebas tanggungan yang bersangkutan.', 0, 'L');

$pdf->Ln(5);
$pdf->MultiCell(0, 6, 'Demikian rekomendasi ini dibuat untuk dipergunakan sebagaimana mestinya.', 0, 'L');

// Add signature section
$pdf->Ln(10);
$pdf->Cell(120, 6, '', 0, 0);
$locale = 'id_ID';
$formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$formatter->setPattern('d MMMM yyyy');
$tanggal = $formatter->format(new DateTime());

$pdf->Cell(0, 6, 'Malang, ' . $tanggal, 0, 1, 'L');

$pdf->Cell(120, 6, '', 0, 0);
$pdf->Cell(0, 6, 'Ketua Jurusan Teknologi Informasi', 0, 1, 'L');

// Add signature image
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . "/sibeta/public/assets/img/ttd.png", 140, $pdf->GetY(), 25, 25); // (path, x, y, width, height)

$pdf->Ln(25);

$pdf->Cell(120, 6, '', 0, 0);
$pdf->Cell(0, 6, 'Dr.Eng. Rosa Andire Asmara, ST, MT', 0, 1, 'L');

$pdf->Cell(120, 6, '', 0, 0);
$pdf->Cell(0, 6, 'NIP. 198010102005011001', 0, 1, 'L');

// Output the PDF
$pdf->Output('rekomendasi.pdf', 'I');
