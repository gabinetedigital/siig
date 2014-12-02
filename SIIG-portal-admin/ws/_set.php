<?php
/**
 * @author			Odix - v 1.0 - nov/204
 * @description 	Grava os eventos no BD, conforme par�metros enviados das secretarias
 * @params
		aut 		autentica��o do WS, aut=c2lpZy1kZWQtM3dk - base64_encode('siig-ded-3wd')
		url			endere�o do arquivo da sa�da JSON com os dados dos eventos
					- teste com http://3wd.com.br/secretaria-gera-json.php
					- pode ser tamb�m http://dominio.com/arquivo.json
		
		- parametros lidos do arquivo
		estado (obrigatorio, sigla com 2 letras em maiuscula, ex.: RS)
		cidade (obrigatorio, nome completo, case sensitive, ex.: Porto Alegre)
		categoria (obrigatorio, nome completo, case sensitive, ex.: Meio Ambiente)
		subcategoria (opcional, nome completo, case sensitive, ex.: Jardins)
		titulo 
		texto
		assunto (do que se trata)
		tags (palavras separadas por v�rgula)
		latitude
		longitude
 */
 
if (isset($_REQUEST['aut']) && $_REQUEST['aut']=='c2lpZy1kZWQtM3dk') 
{
	//pega os par�metros
	if (isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {
		$url = $_REQUEST['url'];
		
		//pega json do arquivo remoto (definido na URL enviada)
		//allow_url_fopen deve estar habilitado
		$json = file_get_contents($url);
		
		//decodifica o json e coloca em um obj
		$obj = json_decode($json);
		var_dump($json);
		$eve = $obj->eventos;
		
		//separa os "peda�os" do arquivo e grava no BD
		
	}
	else {
		die('O par�metro "url" deve ser enviado!');
	}
}
else 
{
	die('Falha de autentica��o do WS!'); 
}
?>