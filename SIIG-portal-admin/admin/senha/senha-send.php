<?php
$conteudo = "
<h1>Cadastro de Senha para Acesso Restrito</h1>
Ol� <b>$nom</b>, <br />".
strtoupper($col).": $nro
<br /><br />
No link abaixo voc� ser� direcionado para a p�gina de 
cadastramento de senha para profissionais e empresas
ligadas ao CRF-RS.
<br /><br />
Esse link cont�m um c�digo gerado pela sua solicita��o
ao informar o CPF ou CPNJ.
<br /><br />
$lnk";

$from = 'acessorestrito@crfrs.org.br';
$mailheaders = "from: $from\r\nReplay-to: $from\r\nBcc: odair@crfrs.org.br\r\n";
$mailheaders .= "MIME-version: 1.0\n";
$mailheaders .= "Content-type: multipart/related;";
$mailheaders .= "boundary=\"limite\"\n";

$msg_body = "--limite\n";
$msg_body .= "Content-type: text/html; charset=iso-8859-1\n";
$msg_body .= "$conteudo";

$destino = $ema;
$assunto = 'CRF-RS: solicita��o/recupera��o de senha - Acesso Restrito';

//op��o de execu��o e retorno usando POST ou GET direto do form
if ( mail($destino, $assunto, $msg_body, $mailheaders) ){
	$msg = md5(04.3);
	//echo 'E-mail enviado com sucesso!';
} else {
	$msg = md5(04.4);
	//echo 'Problemas ao enviar o e-mail. Tente novamente mais tarde.';
}
?>