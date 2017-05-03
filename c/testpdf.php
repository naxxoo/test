<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/2/3 0003
 * Time: 17:35
 */
require_once "../FPDF/fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output('F','abc.pdf');
