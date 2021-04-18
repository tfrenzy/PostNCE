<?php
function toNumber($dest)
{
    if ($dest)
        return ord(strtolower($dest)) - 96;
    else
        return 0;
}

function myFunction($s,$x,$y){
 $x = toNumber($x);
 return $s->getCellByColumnAndRow($x, $y)->getFormattedValue();
}


$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);
$objPHPExcel->setActiveSheetIndex(0);
$sheetData = $objPHPExcel->getActiveSheet();


$cellData = myFunction($sheetData,'B','2');
var_dump($cellData);
?>