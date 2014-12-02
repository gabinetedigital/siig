-- phpMyAdmin SQL Dump
-- version 4.2.1
-- http://www.phpmyadmin.net
--
-- Host: mysql01-farm55.uni5.net
-- Tempo de geração: 01/12/2014 às 20:11
-- Versão do servidor: 5.5.39-log
-- Versão do PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `siig`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`idcategoria` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `sid`, `nome`, `ativo`) VALUES
(4, 1, 'Saúde', 1),
(5, 1, 'Meio Ambiente', 1),
(6, 1, 'Educação', 1),
(14, 1, 'Obras', 1),
(18, 1, 'Segurança', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
`idcidade` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Fazendo dump de dados para tabela `cidade`
--

INSERT INTO `cidade` (`idcidade`, `sid`, `nome`, `ativo`) VALUES
(1, 1, 'Porto Alegre', 1),
(5, 1, 'Caxias do Sul', 1),
(6, 1, 'Rio Grande', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`idcomentario` int(10) unsigned NOT NULL,
  `evento_idevento` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned DEFAULT NULL,
  `texto` text,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
`idestado` int(10) unsigned NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(3) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `estado`
--

INSERT INTO `estado` (`idestado`, `nome`, `sigla`, `ativo`) VALUES
(1, 'Rio Grande do Sul', 'RS', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
`idevento` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `cidade_idcidade` int(10) unsigned NOT NULL,
  `categoria_idcategoria` int(10) unsigned DEFAULT NULL,
  `subcategoria_idsubcategoria` int(10) unsigned DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text,
  `assunto` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `datahora` datetime NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Fazendo dump de dados para tabela `evento`
--

INSERT INTO `evento` (`idevento`, `sid`, `cidade_idcidade`, `categoria_idcategoria`, `subcategoria_idsubcategoria`, `titulo`, `texto`, `assunto`, `tags`, `datahora`, `latitude`, `longitude`, `ativo`) VALUES
(1, 1, 1, 6, 0, 'Reforma da UFRGS', 'Quisque hendrerit euismod sapien et eleifend. Ut euismod velit eget dolor sagittis, sit amet pellentesque risus pretium. Curabitur condimentum lectus quis lorem lacinia, ut ornare velit imperdiet. Curabitur commodo nec nisi sit amet malesuada. In dignissim urna leo, sed blandit nulla malesuada eget. Pellentesque at neque massa. Aenean id efficitur nisl. Nunc nec tincidunt lacus. Cras urna odio, auctor id lacinia ac, mattis eu nisi. Quisque interdum ipsum lorem, non molestie risus auctor nec. Sed aliquet turpis et tortor ultrices, vitae sollicitudin neque hendrerit. Maecenas in augue at ex accumsan congue sit amet ut mi. Curabitur rutrum ligula at sem laoreet volutpat. Pellentesque volutpat dignissim pulvinar. Pellentesque hendrerit congue tortor eget venenatis. UPDATE', 'Reforma UFRS', 'reforma, UFRS, universidade, teste, cadastro', '2014-11-26 17:13:28', '-30.03405', '-51.21865', 1),
(3, 1, 1, 4, 0, 'Hospital de Pronto Socorro', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis. Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.', 'Obras HPS', 'hospital, teste, porto alegre, saúde', '0000-00-00 00:00:00', '-30.03673', '-51.20946', 1),
(4, 1, 1, 4, 0, 'HCPA update', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.\r\n\r\nSuco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.\r\n\r\nupdate.', 'Obras HCPA update', 'teste, hospital, update', '0000-00-00 00:00:00', '-30.03752', '-51.20693', 1),
(5, 1, 1, 5, 0, 'Revitalização Orla Ipanema', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.\r\n\r\nSuco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.', 'Revitalização Orla', 'revitalização, limpeza, guaíba', '0000-00-00 00:00:00', '-30.13370', '-51.23086', 1),
(7, 1, 1, 6, 1, 'Teste Escola', 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.\r\n\r\nSuco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.', 'Inauguração Escola', 'escola, teste, inauguração', '0000-00-00 00:00:00', '-30.03879', '-51.21339', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
`idfoto` int(10) unsigned NOT NULL,
  `comentario_idcomentario` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned DEFAULT NULL,
  `diretorio` varchar(45) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
`idsubcategoria` int(10) unsigned NOT NULL,
  `categoria_idcategoria` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Fazendo dump de dados para tabela `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`, `categoria_idcategoria`, `sid`, `nome`, `ativo`) VALUES
(1, 6, 1, 'Ensino Fundamental', 1),
(6, 6, 1, 'Universidades', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`idusuario` int(10) unsigned NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `ativo`) VALUES
(1, 'Admin', 'siig', '8962139b5b7e5eac50294e12b4dbed2a01d5e2ae', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `video`
--

CREATE TABLE IF NOT EXISTS `video` (
`idvideo` int(10) unsigned NOT NULL,
  `comentario_idcomentario` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`idcategoria`), ADD KEY `SID` (`sid`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
 ADD PRIMARY KEY (`idcidade`), ADD KEY `SID` (`sid`);

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`idcomentario`), ADD KEY `SID` (`sid`), ADD KEY `comentario_FKIndex1` (`evento_idevento`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
 ADD PRIMARY KEY (`idestado`);

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`idevento`), ADD KEY `SID` (`sid`), ADD KEY `catid` (`categoria_idcategoria`), ADD KEY `subid` (`subcategoria_idsubcategoria`), ADD KEY `cidid` (`cidade_idcidade`);

--
-- Índices de tabela `foto`
--
ALTER TABLE `foto`
 ADD PRIMARY KEY (`idfoto`), ADD KEY `SID` (`sid`), ADD KEY `foto_FKIndex1` (`comentario_idcomentario`);

--
-- Índices de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
 ADD PRIMARY KEY (`idsubcategoria`), ADD KEY `SID` (`sid`), ADD KEY `subcategoria_FKIndex1` (`categoria_idcategoria`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idusuario`);

--
-- Índices de tabela `video`
--
ALTER TABLE `video`
 ADD PRIMARY KEY (`idvideo`), ADD KEY `SID` (`sid`), ADD KEY `video_FKIndex1` (`comentario_idcomentario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
MODIFY `idcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
MODIFY `idcidade` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
MODIFY `idcomentario` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
MODIFY `idestado` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
MODIFY `idevento` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `foto`
--
ALTER TABLE `foto`
MODIFY `idfoto` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `subcategoria`
--
ALTER TABLE `subcategoria`
MODIFY `idsubcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
MODIFY `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `video`
--
ALTER TABLE `video`
MODIFY `idvideo` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`evento_idevento`) REFERENCES `evento` (`idevento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `foto`
--
ALTER TABLE `foto`
ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`comentario_idcomentario`) REFERENCES `comentario` (`idcomentario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `subcategoria`
--
ALTER TABLE `subcategoria`
ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `video`
--
ALTER TABLE `video`
ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`comentario_idcomentario`) REFERENCES `comentario` (`idcomentario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
