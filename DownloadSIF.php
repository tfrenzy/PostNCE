<?php
session_start();
include("Connect.php");
$nu = new Connect();
if ((isset($_SESSION['User']))&&($nu->isConfirmed($_SESSION['User']))) {
require_once('TCPDF/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tonye Amienyo');
$pdf->SetTitle('Student Information Form');
$pdf->SetSubject('Student Information');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
$pdf->SetFont('dejavusans', '', 14);
$html = $nu->createSIFHTML($_SESSION['User']);
for ($i = 0; $i <= count($html)-1; $i++) {
$pdf->AddPage();
$pdf->writeHTML($html[$i], true, false, true, false, '');
}
$pdf->Output('StudentInformation.pdf', 'I');
}
?>