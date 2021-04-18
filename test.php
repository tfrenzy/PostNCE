<?php
include("Connect.inc");
$nu = new Connect();
$nu->readExcel("excel\ENG203_1.xls", "A5", "B5");
?>