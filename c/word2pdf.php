<?php
/**
 * TCPDF DOMPDF
 */
header("Content-type:text/html;charset=UTF-8");
date_default_timezone_set('Asia/Shanghai');
set_time_limit(0);
require_once "../PHPWord/PhpWord.php";
require_once  '../PHPWord/Autoloader.php';
//require_once "../FPDF/fpdf.php";
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
Autoloader::register();
Settings::loadConfig();


error_reporting(99999999999);

$filepath = "abc.docx";

$rendererLibraryPath = '../dompdf/dompdf_config.inc.php';

Settings::setPdfRendererPath($rendererLibraryPath);
Settings::setPdfRendererName('DomPDF');

//var_dump(Settings::getPdfRendererPath());
$phpWord = PhpOffice\PhpWord\IOFactory::load( $filepath );
$pdfWriter = PhpOffice\PhpWord\IOFactory::createWriter( $phpWord, 'PDF' );
$pdfWriter->save( '123.pdf' );

