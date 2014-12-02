<?php
//die($_SERVER['PHP_SELF']);
//caminho do diretуrio base para imagens
ini_set("allow_url_fopen", true);
define('IMGDIR', 'http://crfrs.org.br/portal/img');
//-------------------------------------

/**
 * funзгo para formataзгo do valor moeda
 */
function nome_img($var) 
{
	$var = strtolower($var);	
	$var = ereg_replace("[бавг]","a",$var);	
	$var = ereg_replace("[БАВГ]","a",$var);	
	$var = ereg_replace("[йик]","e",$var);	
	$var = ereg_replace("[ЙИК]","e",$var);	
	$var = ereg_replace("[нмо]","i",$var);
	$var = ereg_replace("[НМО]","i",$var);
	$var = ereg_replace("[утфх]","o",$var);	
	$var = ereg_replace("[УТФХ]","o",$var);	
	$var = ereg_replace("[ъщыь]","u",$var);	
	$var = ereg_replace("[ЪЩЫЬ]","u",$var);	
	$var = str_replace("Є","a",$var);
	$var = str_replace("є","o",$var);
	$var = str_replace("з","c",$var);
	$var = str_replace("З","c",$var);
	$var = str_replace("с","n",$var);
	$var = str_replace("С","n",$var);
	$var = str_replace(' ','-',$var);
	$var = str_replace("/",'-',$var);
	$var = str_replace("\\",'-',$var);
	$var = str_replace("\'",'',$var);
	$var = str_replace("\"",'',$var);
	$var = str_replace("(",'',$var);
	$var = str_replace(")",'',$var);
	$var = str_replace(",",'',$var);
	$var = str_replace(";",'',$var);
	return $var;
}


/**
 * funзгo para formataзгo do valor moeda
 */
function moeda($val, $cif=''){
	switch ($cif) {
		case '':
			$val = number_format($val,2,',','.');
			break;
		case 'R$':
			$val = $cif.' '.number_format($val,2,',','.');
			break;
		case 'U$':
			$val = $cif.' '.number_format($val,2,'.',',');
			break;
	}
	return $val;
}


/**
 * funзгo para formataзгo do valor moeda para o PagSeguro (PS)
 */
function moedaPS($val){
	$val = number_format($val,2,'','');
	return $val;
}


/**
 * recebe um valor no formato moeda BR e retorna um n?mero
 */
function numero($val) {
	$val = str_replace('.', '', $val); //primeiro tira o ponto 1.519,80
	$val = str_replace(',', '.', $val); //troca a v?rgula por ponto 1519.8
	return $val * 1; //gambeta pra tirar o zero do final se existir
}


/**
 * recebe uma data no formato aaaa-mm-dd e retorna no formato BR
 */
function date_ptbr($val, $sep = '-') {
	$vet = explode($sep, $val);
	return $vet[2].'/'.$vet[1].'/'.$vet[0];
}


/**
 * recebe uma hora no formato hh:mm:ss e retorna no formato 00h00
 */
function time_ptbr($val, $sep = ':') {
	$vet = explode($sep, $val);
	return $vet[0].'h'.$vet[1];
}


/**
 * recebe uma data no formato dd/mm/aaaa e retorna no formato MySQL
 */
function date_mysql($val, $sep = '/') {
	$vet = explode($sep, $val);
	return $vet[2].'-'.$vet[1].'-'.$vet[0];
}


/**
 * recebe um datetime e retorna somente a data em pt-br
 */
function datetime_date_ptbr($val, $sep = '-') {
	$vet = explode(' ', $val);
	$vet = explode($sep, $vet[0]);
	return $vet[2].'/'.$vet[1].'/'.$vet[0];
}


/**
 * recebe um datetime e retorna somente a hora em pt-br
 */
function datetime_time_ptbr($val, $sep = ':') {
	$vet = explode(' ', $val);
	$vet = explode($sep, $vet[1]);
	return $vet[0].':'.$vet[1];
}


/**
 * recebe a data e a hora e converte para datetime de mysql
 */
function datetime_mysql($dat, $hor, $sep = '/') {
	$vet = explode($sep, $dat);
	$dat = $vet[2].'-'.$vet[1].'-'.$vet[0];
	return $dat.' '.$hor;
}


function addDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $days, $thisyear );
     return strftime("%Y%m%d", $nextdate);
}

function subDayIntoDate($date,$days) {
     $thisyear = substr ( $date, 0, 4 );
     $thismonth = substr ( $date, 4, 2 );
     $thisday =  substr ( $date, 6, 2 );
     $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $days, $thisyear );
     return strftime("%Y%m%d", $nextdate);
}

?>