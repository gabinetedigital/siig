<?php
if ( isset($_GET['msg']) && !empty($_GET['msg']) ) 
{
	$msg = $_GET['msg'];
	switch ($msg) {
		case md5(01):
			$msg = 'Preencha todos os campos do formul�rio de login.';
			break;
		case md5(02):
			$msg = 'Usu�rio ou senha n�o encontrados.';
			break;
		case md5(03):
			$msg = 'Voc� n�o tem permiss�o para esse acesso.';
			break;
		case md5(04.1):
			$msg = 'CPF n�o encontrado ou SEM recadastramento';
			break;
		case md5(04.2):
			$msg = 'CNPJ n�o encontrado ou SEM recadastramento';
			break;
		case md5(04.3):
			$msg = 'Enviamos um e-mail para voc� com os procedimentos para cadastrar ou alterar sua senha';
			break;
		case md5(04.4):
			$msg = 'Ocorreu um problema ao enviar o e-mail com as informa��es para cadastro ou altera��o da senha';
			break;
		case md5(05.1):
			$msg = 'O link informado no e-mail cont�m dados incorretos. Fa�a a solicita��o novamente.';
			break;
		case md5(05.2):
			$msg = 'As senhas informadas s�o diferentes. Informe duas vezes a MESMA senha.';
			break;
		case md5(05.3):
			$msg = 'A senha deve ter 6 d�gitos ou mais.';
			break;
		case md5(05.4):
			$msg = 'Ocorreu um problema ao efetuar o registro no sistema do CRF-RS';
			break;
		case md5(05.5):
			$msg = 'Parab�ns! Voc� concluiu a solicita��o de cadastro/altera��o de senha para o acesso restrito.';
			break;
			
			
		
		case md5(11):
			$msg = 'Afastamento CADASTRADO com sucesso.';
			break;
		case md5(11.1):
			$msg = 'Justificativa de Afastamento CADASTRADA com sucesso.';
			break;
		case md5(12):
			$msg = 'Afastamento ATUALIZADO com sucesso.';
			break;
		case md5(13):
			$msg = 'Afastamento EXCLU�DO com sucesso.';
			break;
		case md5(14):
			$msg = 'STATUS do afastamento alterado com sucesso.';
			break;
		case md5(15):
			$msg = 'Problemas ao CADASTRAR o afastamento.';
			break;
		case md5(16):
			$msg = 'Problemas ao ATUALIZAR o afastamento.';
			break;
		case md5(17):
			$msg = 'Problemas ao EXCLUIR o afastamento.';
			break;
		case md5(18):
			$msg = 'Problemas ao modificar o STATUS do evento.';
			break;
		case md5(19):
			$msg = 'O cadastro s� pode ser realizado com 48h de anteced�ncia: '.date("d/m/Y", strtotime("+2 day"));
			break;
		case md5(19.1):
			$msg = 'A justificativa de aus�ncia pode ser cadastrada em at� 5 dias �teis ap�s o ocorrido.';
			break;
		case md5(20):
			$msg = 'O intervalo entre a data inicial e a data final N�O pode ser superior a 30 dias.';
			break;
		case md5(20.1):
			$msg = 'Anexo (foto ou digitaliza��o) n�o enviado OU tipo de arquivo incompat�vel.';
			break;
		
		
		
		
		case md5(21):
			$msg = 'Inscri�ao realizada com sucesso!';
			break;
		case md5(22):
			$msg = 'Problemas ao efetuar o cadastro em um curso.';
			break;
		case md5(23.1):
			$msg = 'Foi enviado a voc� um e-mail para confirma��o da inscri��o.';
			break;
		case md5(23.2):
			$msg = 'Ocorreu um problema ao enviar o e-mail de confirma�ao.';
			break;
		case md5(24):
			$msg = 'Voc� j� estava inscrito nesse curso OU o n�o h� mais vagas.';
			break;
		case md5(25):
			$msg = 'N�o encontramos seu cadastro no CRF-RS para realizar a inscri��o.';
			break;
		case md5(26):
			$msg = 'H� conflito de data/hora. Voc� j� est� inscrito em um curso/evento no mesmo hor�rio.';
			break;
		
		
		case md5(30):
			$msg = 'Problemas ao identificar o curso para proceder com o cancelamento.';
			break;
		case md5(31):
			$msg = 'O prazo para cancelar a inscri��o � de 48h ANTES do in�cio do curso.';
			break;
		case md5(32):
			$msg = 'Ocorreu um problema ao cancelar a inscric�o. Tente novamente mais tarde.';
			break;
		case md5(33):
			$msg = 'Inscri��o do curso/evento cancelada com sucesso!';
			break;
		
		
		
		case md5(99):
			$msg = 'Estamos formatando seu HD... (27%) - Aguarde!';
			break;
		
		default:
			$msg = '';
	}
	//fim do switch com as mensagens ($msg)
	//coloca na marca��o
	$tpl->gotoBlock('_ROOT');
	$tpl->assign('msg', $msg);
}
?>