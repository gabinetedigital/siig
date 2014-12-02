<?php
if ( isset($_GET['msg']) && !empty($_GET['msg']) ) 
{
	$msg = $_GET['msg'];
	switch ($msg) {
		case md5(01):
			$msg = 'Preencha todos os campos do formulсrio de login.';
			break;
		case md5(02):
			$msg = 'Usuсrio ou senha nуo encontrados.';
			break;
		case md5(03):
			$msg = 'Vocъ nуo tem permissуo para esse acesso.';
			break;
		case md5(04.1):
			$msg = 'CPF nуo encontrado ou SEM recadastramento';
			break;
		case md5(04.2):
			$msg = 'CNPJ nуo encontrado ou SEM recadastramento';
			break;
		case md5(04.3):
			$msg = 'Enviamos um e-mail para vocъ com os procedimentos para cadastrar ou alterar sua senha';
			break;
		case md5(04.4):
			$msg = 'Ocorreu um problema ao enviar o e-mail com as informaчѕes para cadastro ou alteraчуo da senha';
			break;
		case md5(05.1):
			$msg = 'O link informado no e-mail contщm dados incorretos. Faчa a solicitaчуo novamente.';
			break;
		case md5(05.2):
			$msg = 'As senhas informadas sуo diferentes. Informe duas vezes a MESMA senha.';
			break;
		case md5(05.3):
			$msg = 'A senha deve ter 6 dэgitos ou mais.';
			break;
		case md5(05.4):
			$msg = 'Ocorreu um problema ao efetuar o registro no sistema do CRF-RS';
			break;
		case md5(05.5):
			$msg = 'Parabщns! Vocъ concluiu a solicitaчуo de cadastro/alteraчуo de senha para o acesso restrito.';
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
			$msg = 'Afastamento EXCLUЭDO com sucesso.';
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
			$msg = 'O cadastro sѓ pode ser realizado com 48h de antecedъncia: '.date("d/m/Y", strtotime("+2 day"));
			break;
		case md5(19.1):
			$msg = 'A justificativa de ausъncia pode ser cadastrada em atщ 5 dias њteis apѓs o ocorrido.';
			break;
		case md5(20):
			$msg = 'O intervalo entre a data inicial e a data final NУO pode ser superior a 30 dias.';
			break;
		case md5(20.1):
			$msg = 'Anexo (foto ou digitalizaчуo) nуo enviado OU tipo de arquivo incompatэvel.';
			break;
		
		
		
		
		case md5(21):
			$msg = 'Inscriчao realizada com sucesso!';
			break;
		case md5(22):
			$msg = 'Problemas ao efetuar o cadastro em um curso.';
			break;
		case md5(23.1):
			$msg = 'Foi enviado a vocъ um e-mail para confirmaчуo da inscriчуo.';
			break;
		case md5(23.2):
			$msg = 'Ocorreu um problema ao enviar o e-mail de confirmaчao.';
			break;
		case md5(24):
			$msg = 'Vocъ jс estava inscrito nesse curso OU o nуo hс mais vagas.';
			break;
		case md5(25):
			$msg = 'Nуo encontramos seu cadastro no CRF-RS para realizar a inscriчуo.';
			break;
		case md5(26):
			$msg = 'Hс conflito de data/hora. Vocъ jс estс inscrito em um curso/evento no mesmo horсrio.';
			break;
		
		
		case md5(30):
			$msg = 'Problemas ao identificar o curso para proceder com o cancelamento.';
			break;
		case md5(31):
			$msg = 'O prazo para cancelar a inscriчуo щ de 48h ANTES do inэcio do curso.';
			break;
		case md5(32):
			$msg = 'Ocorreu um problema ao cancelar a inscricуo. Tente novamente mais tarde.';
			break;
		case md5(33):
			$msg = 'Inscriчуo do curso/evento cancelada com sucesso!';
			break;
		
		
		
		case md5(99):
			$msg = 'Estamos formatando seu HD... (27%) - Aguarde!';
			break;
		
		default:
			$msg = '';
	}
	//fim do switch com as mensagens ($msg)
	//coloca na marcaчуo
	$tpl->gotoBlock('_ROOT');
	$tpl->assign('msg', $msg);
}
?>