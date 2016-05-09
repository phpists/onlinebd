<?php
include_once('db.class.php');
$DB = new DB_CLASS();
//$products = $DB->getRows('SELECT * FROM products');
include_once 'Classes/PHPExcel/IOFactory.php';

$id = $_GET['id'];

$zayavka_res = $DB->getRows('SELECT CONCAT(companies.contragent, " ",companies.nazva) AS nazva, companies.nomer_dogovora, companies.date_c, zayavki.fio, zayavki.date_otgruzki, zayavki.comment, CONCAT(companies.id, "-",progects.id, "-", zayavki.id) AS nomer
FROM zayavki LEFT JOIN progects ON zayavki.progect_id = progects.id LEFT JOIN companies ON progects.company_id = companies.id WHERE zayavki.id = '.$id);
$zayavka = $zayavka_res[0];
//echo $zayavka['nazva'];



if($_GET['type']==0) {
	$products = $DB->getRows('SELECT `zayavki_rashod`.`id`, `zayavki_rashod`.`product_id`, `zayavki_rashod`.`cnt`, `products`.`nazva`, `products`.`artikl`, `products`.`edinica_izm`, `products`.`kilk`
	FROM `zayavki_rashod`
	LEFT JOIN `products` ON `zayavki_rashod`.`product_id` = `products`.`id`
	WHERE `zayavki_rashod`.`zayavka_id` = '.$id);

	$objPHPExcel = PHPExcel_IOFactory::load("otgruzka.xls");
	$objPHPExcel->setActiveSheetIndex(0);
	$aSheet = $objPHPExcel->getActiveSheet();

	$aSheet->setCellValue('D9', $zayavka['nazva']);
	$aSheet->setCellValue('C11', $zayavka['fio']);
	$aSheet->setCellValue('AL12', $zayavka['nomer_dogovora']);
	$aSheet->setCellValue('AL13', $zayavka['date_c']);
	$aSheet->setCellValue('Y17', $zayavka['nomer']);
	$aSheet->setCellValue('AH17', substr($zayavka['date_otgruzki'], 0, 10));
	$aSheet->setCellValue('C49', $zayavka['comment']);

	//$date = date('d.m.Y');
	//$aSheet->setCellValue('AH17', $date);
	$iter=28;
	foreach($products as $item){
		$aSheet->setCellValue('E'.$iter, $item['nazva']);
		$aSheet->setCellValue('M'.$iter, $item['artikl']);
		$aSheet->setCellValue('R'.$iter, $item['edinica_izm']);
		$aSheet->setCellValue('X'.$iter, $item['cnt']);
		$iter++;
	}
}

if($_GET['type']==1) {
	$products = $DB->getRows('SELECT zayavki_prihod.id, zayavki_prihod.nazva, zayavki_prihod.kilk, zayavki_prihod.edinica_izm, zayavki_prihod.artikl
	FROM `zayavki_prihod`
	WHERE `zayavki_prihod`.`zayavka_id` = '.$id);

	$objPHPExcel = PHPExcel_IOFactory::load("priem.xls");
	$objPHPExcel->setActiveSheetIndex(0);
	$aSheet = $objPHPExcel->getActiveSheet();

	$aSheet->setCellValue('D9', $zayavka['nazva']);
	$aSheet->setCellValue('C11', $zayavka['fio']);
	$aSheet->setCellValue('AR12', $zayavka['nomer_dogovora']);
	$aSheet->setCellValue('AR13', $zayavka['date_c']);
	$aSheet->setCellValue('AA17', $zayavka['nomer']);
	$aSheet->setCellValue('AK17', substr($zayavka['date_otgruzki'], 0, 10));
	$aSheet->setCellValue('N60', $zayavka['comment']);
	
	$iter=30;
	foreach($products as $item){
		$aSheet->setCellValue('J'.$iter, $item['nazva']);
		$aSheet->setCellValue('P'.$iter, $item['artikl']);
		$aSheet->setCellValue('W'.$iter, $item['edinica_izm']);
		$aSheet->setCellValue('AG'.$iter, $item['cnt']);
		$iter++;
	}
}

$filename = $zayavka['nazva'].'_'.$zayavka['fio'].'_'.$zayavka['nomer_dogovora'].'_'.$zayavka['date_c'];

//создаем объект класса-писателя
include("Classes/PHPExcel/Writer/Excel5.php");
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//выводим заголовки
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="print.xls"');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
//выводим в браузер таблицу с бланком
$objWriter->save('php://output');

?>