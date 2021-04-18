//  Include PHPExcel_IOFactory
<?php
include 'PHPExcel/IOFactory.php';

$inputFileName = './sampleData/example1.xls';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    //  Insert row data array into your database of choice here
}
?>
<?php
$objPHPExcel = PHPExcel_IOFactory::load($dataFfile);
    $sheet = $objPHPExcel->getActiveSheet();
    $data = $sheet->rangeToArray('A2:AB5523');
    echo "Rows available: " . count($data) . "\n";
    foreach ($data as $row) {
        print_r($row);
    }
?>