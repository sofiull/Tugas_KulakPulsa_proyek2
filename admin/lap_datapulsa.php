<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
// $pdf->Image('../logo/malasngoding.png',1,1,2,2);
$pdf->SetX(1);            
$pdf->MultiCell(19.5,0.5,'KULAK PULSA',0,'L');
$pdf->SetX(1);
$pdf->MultiCell(19.5,0.5,'Telpon : 0038-0200-4000',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(19.5,0.5,'JL. Kidul Pasar',0,'L');
$pdf->SetX(1);
$pdf->MultiCell(19.5,0.5,'website : www.kulakpulsa.com email : pulsa@kulak.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Data Harga Jual Pulsa",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Cetakan Tanggal: ".date("d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Operator', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Penyedia', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nominal Pulsa', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Harga pulsa', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Admin', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'tanggal', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($con,"SELECT DISTINCT o.nama_operator,p.namapenyedia,pl.nominal, dp.harga, a.usernameAdmin, k.tanggal FROM kulak_pulsa k , operator o , penyedia p , pulsa pl , infopenyedia ip , detailkulakpulsa dp , admin a WHERE o.id_operator =k.id_operator AND k.id_penyedia = p.id_penyedia AND k.id_detailkulakpulsa = dp.id_detailkulakpulsa ORDER BY k.id_kulakpulsa ASC");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['nama_operator'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['namapenyedia'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['nominal'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['harga'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['usernameAdmin'],1, 0, 'C');
	$pdf->Cell(4.5, 0.8, $lihat['tanggal'],1, 1, 'C');
	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

