<?php
/**
 * Fun��o para upload de arquivo de imagem (JPG por enquanto)
 * - Recebe 4 par�metros: arquivo, destino, largura, algura
 */

function upload($origem, $destino, $lar, $alt)
{
	$quality = 90; //qualidade (de 0 a 100)
	$wmax = $lar; //largura m�xima
	$hmax = $alt; //altura m�xima
	$source = imagecreatefromjpeg($origem); //jpeg file
    
	$orig_w = imagesx($source);
	$orig_h = imagesy($source);
		
	if ($orig_w>$wmax || $orig_h>$hmax){
	   $thumb_w = $wmax;
	   $thumb_h = $hmax;
	   if ($thumb_w/$orig_w*$orig_h > $thumb_h) {
		   $thumb_w = round($thumb_h*$orig_w/$orig_h);
	   } else {
		   $thumb_h = round($thumb_w*$orig_h/$orig_w);
	   }
	} 
	else {
	   $thumb_w = $orig_w;
	   $thumb_h = $orig_h;
	}
		
	$thumb = imagecreatetruecolor($thumb_w,$thumb_h);
	imagecopyresampled($thumb,$source,0,0,0,0,$thumb_w,$thumb_h,$orig_w,$orig_h);
	
	if (imagejpeg($thumb, $destino, $quality)){
		return true;
		exit;
	} else {
		return false;
		exit;
	}
		
	imagedestroy($thumb);
}

/*
function upload($filename, $path, $target_width, $target_height)
{
	//obt�m a largura e altura da imagem que veio
	list($width, $height) = getimagesize($filename);
	
	//calcula a propor��o entre largura e altura
	$imgratio = ($width / $height);
	if ($imgratio > 1) {
	  $newwidth = $target_width;
	  $newheight = ($target_width / $imgratio);
	} else {
	  $newheight = $target_height;
	  $newwidth = ($target_height * $imgratio);
	}
	
	//cria a refer�ncia do thumb e do original
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($filename);
	
	//faz a c�pia redimensionada 
	//c�pia, original, new x, new y, old x, old y, new W, new H, old W, old H
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	//Tipo de conte�do para o navegador
	//header('Content-type: image/jpeg');
	
	//faz a c�pia para o diret�rio e retorna true ou false
	$ok = imagejpeg($thumb, $path, 80);
	return $ok;
}
*/
?>
