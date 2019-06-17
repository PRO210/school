-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 16-Jun-2019 às 02:50
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school-laravel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(10) UNSIGNED NOT NULL,
  `INEP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NASCIMENTO` date DEFAULT NULL,
  `CERTIDAO_CIVIL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MODELO_CERTIDAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MATRICULA_CERTIDAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DADOS_CERTIDAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NUMERO_RG` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ORGAO_EXPEDIDOR_RG` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EXPEDICAO_CERTIDAO` date DEFAULT NULL,
  `NATURALIDADE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ESTADO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NACIONALIDADE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SEXO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BOLSA_FAMILIA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SUS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NECESSIDADES_ESPECIAIS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `COR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FONE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FONE_II` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PROF_MAE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PAI` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PROF_PAI` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ENDERECO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `URBANO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CIDADE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CIDADE_ESTADO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TRANSPORTE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PONTO_ONIBUS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MOTORISTA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MOTORISTA_II` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MATRICULA` date DEFAULT NULL,
  `MATRICULA_RENOVADA` date DEFAULT NULL,
  `DECLARACAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DECLARACAO_DATA` date DEFAULT NULL,
  `DECLARACAO_RESPONSAVEL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TRANSFERENCIA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TRANSFERENCIA_DATA` date DEFAULT NULL,
  `TRANSFERENCIA_RESPONSAVEL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OBSERVACOES` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `INEP`, `NOME`, `NASCIMENTO`, `CERTIDAO_CIVIL`, `MODELO_CERTIDAO`, `MATRICULA_CERTIDAO`, `DADOS_CERTIDAO`, `NUMERO_RG`, `ORGAO_EXPEDIDOR_RG`, `EXPEDICAO_CERTIDAO`, `NATURALIDADE`, `ESTADO`, `NACIONALIDADE`, `SEXO`, `NIS`, `BOLSA_FAMILIA`, `SUS`, `NECESSIDADES_ESPECIAIS`, `COR`, `FONE`, `FONE_II`, `MAE`, `PROF_MAE`, `PAI`, `PROF_PAI`, `ENDERECO`, `URBANO`, `CIDADE`, `CIDADE_ESTADO`, `TRANSPORTE`, `PONTO_ONIBUS`, `MOTORISTA`, `MOTORISTA_II`, `MATRICULA`, `MATRICULA_RENOVADA`, `DECLARACAO`, `DECLARACAO_DATA`, `DECLARACAO_RESPONSAVEL`, `TRANSFERENCIA`, `TRANSFERENCIA_DATA`, `TRANSFERENCIA_RESPONSAVEL`, `OBSERVACOES`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ANDRÉ', NULL, 'RG', 'NOVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FEMININO', NULL, 'SIM', NULL, 'SIM', 'INDÍGENA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SIM', NULL, NULL, 'SIM', 'Ponto Escolhido', 'INCOMPLETO', 'INCOMPLETO II', NULL, NULL, 'SIM', NULL, NULL, 'SIM', NULL, NULL, NULL, NULL, '2019-06-11 10:58:40'),
(2, NULL, 'GIL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'ARTUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'SOCORRO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, 'VALENTINA', '2019-06-12', 'NASCIMENTO', 'NOVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MASCULINO', NULL, 'NAO', NULL, 'SIM', 'BRANCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAO', NULL, NULL, 'NAO', 'Ponto Escolhido', 'INCOMPLETO', 'INCOMPLETO II', NULL, NULL, 'NAO', NULL, NULL, 'NAO', NULL, NULL, NULL, '2019-06-12 22:05:27', '2019-06-12 22:07:39'),
(14, NULL, 'TESTE DO USUARIO', '2019-06-14', 'NASCIMENTO', 'NOVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MASCULINO', NULL, 'NAO', NULL, 'NAO', 'BRANCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NAO', NULL, NULL, 'NAO', 'Ponto Escolhido', 'INCOMPLETO', 'INCOMPLETO II', NULL, NULL, 'NAO', NULL, NULL, 'NAO', NULL, NULL, NULL, '2019-06-14 16:52:28', '2019-06-14 16:55:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_classificacaos`
--

CREATE TABLE `aluno_classificacaos` (
  `id` int(10) UNSIGNED NOT NULL,
  `STATUS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ORDEM_I` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ORDEM_II` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ORDEM_III` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `aluno_classificacaos`
--

INSERT INTO `aluno_classificacaos` (`id`, `STATUS`, `ORDEM_I`, `ORDEM_II`, `ORDEM_III`, `created_at`, `updated_at`) VALUES
(1, 'APROVADO', '5', NULL, NULL, NULL, NULL),
(2, 'CURSANDO', 'S', NULL, NULL, NULL, NULL),
(3, 'DESISTENTE', 'S', NULL, NULL, NULL, NULL),
(4, 'ADMITIDO_DEPOIS', 'S', NULL, NULL, '2019-06-06 03:00:00', '2019-06-06 03:00:00'),
(5, 'TRANSFERIDO', 'N', NULL, NULL, '2019-06-06 03:00:00', '2019-06-06 03:00:00'),
(6, 'REPROVADO', '6', NULL, NULL, '2019-06-10 03:00:00', '2019-06-10 03:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_solicitacaos`
--

CREATE TABLE `aluno_solicitacaos` (
  `id` int(10) UNSIGNED NOT NULL,
  `turma_id` int(10) UNSIGNED NOT NULL,
  `aluno_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `SOLICITANTE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TURMA_ANO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATA_SOLICITACAO` date NOT NULL,
  `TRANSFERENCIA_STATUS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATA_TRANSFERENCIA_STATUS` date DEFAULT NULL,
  `DECLARACAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RESPONSAVEL_DECLARACAO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATA_DECLARACAO` date DEFAULT NULL,
  `TRANSFERENCIA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RESPONSAVEL_TRANSFERENCIA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATA_TRANSFERENCIA` date DEFAULT NULL,
  `T1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `T7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_turmas`
--

CREATE TABLE `aluno_turmas` (
  `id` int(10) UNSIGNED NOT NULL,
  `turma_id` int(10) UNSIGNED NOT NULL,
  `aluno_id` int(10) UNSIGNED NOT NULL,
  `aluno_classificacao_id` int(10) UNSIGNED NOT NULL,
  `TURMA_ANO` date NOT NULL,
  `OUVINTE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EXCLUIDO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EXCLUIDO_PASTA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `aluno_turmas`
--

INSERT INTO `aluno_turmas` (`id`, `turma_id`, `aluno_id`, `aluno_classificacao_id`, `TURMA_ANO`, `OUVINTE`, `EXCLUIDO`, `EXCLUIDO_PASTA`, `created_at`, `updated_at`) VALUES
(28, 2, 2, 2, '2019-05-19', NULL, NULL, NULL, NULL, '2019-06-11 01:15:32'),
(40, 4, 1, 4, '2019-05-19', 'NAO', NULL, NULL, NULL, '2019-06-12 12:48:34'),
(48, 2, 13, 4, '2019-05-19', 'NAO', NULL, NULL, NULL, '2019-06-12 22:12:50'),
(83, 5, 3, 4, '2019-05-27', 'NAO', NULL, NULL, NULL, '2019-06-12 22:30:34'),
(87, 1, 14, 4, '2019-05-19', 'NAO', NULL, NULL, NULL, '2019-06-14 17:01:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolas`
--

CREATE TABLE `escolas` (
  `id` int(10) UNSIGNED NOT NULL,
  `NOME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INEP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CADASTRO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CNPJ` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DO` date NOT NULL,
  `ATO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATA_MATRICULA` date DEFAULT NULL,
  `DATA_CENSO` date DEFAULT NULL,
  `ENDERECO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIDADE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ESTADO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CEP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FONE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOGO` blob,
  `ESCUDO` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `escolas`
--

INSERT INTO `escolas` (`id`, `NOME`, `INEP`, `CADASTRO`, `CNPJ`, `DO`, `ATO`, `DATA_MATRICULA`, `DATA_CENSO`, `ENDERECO`, `CIDADE`, `ESTADO`, `CEP`, `EMAIL`, `FONE`, `LOGO`, `ESCUDO`, `created_at`, `updated_at`) VALUES
(1, 'EMTRGS', '3213214564', '465413', '31325445', '2019-06-11', '454132', '2019-03-30', '2019-03-29', '', '', '', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `USUARIO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TABELA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CADASTRAR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ALTERAR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EXCLUIR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ACAO` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `USUARIO`, `TABELA`, `CADASTRAR`, `ALTERAR`, `EXCLUIR`, `ACAO`, `created_at`, `updated_at`) VALUES
(1, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em : STATUS =  De APROVADO  para CURSANDO /    /   updated_at = De 2019-06-06 21:18:35 para 2019-06-06 21:20:17 /  ', '2019-06-07 00:20:17', '2019-06-07 00:20:17'),
(2, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em : STATUS =  De TRANSFERIDO  para APROVADO /    /   updated_at = De 2019-06-06 21:20:17 para 2019-06-06 21:20:33 /  ', '2019-06-07 00:20:33', '2019-06-07 00:20:33'),
(3, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em : TURMA =  De 1 ano  b\r\n  para  2 ano  b\r\n  / OUVINTE De SIM para NAO /    /   updated_at = De 2019-06-06 21:20:33 para 2019-06-06 21:21:12 /  ', '2019-06-07 00:21:12', '2019-06-07 00:21:12'),
(4, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ para: 1 ano a', '2019-06-11 01:09:04', '2019-06-11 01:09:04'),
(5, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) GIL para: 3 ano a (matutino)', '2019-06-11 01:11:14', '2019-06-11 01:11:14'),
(6, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ,GIL,ARTUR para: SEM TURMA  ()', '2019-06-11 01:11:58', '2019-06-11 01:11:58'),
(7, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ,GIL,ARTUR para: 2 ano b\r\n (matutino)', '2019-06-11 01:12:37', '2019-06-11 01:12:37'),
(8, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ para: 1 ano a (matutino)', '2019-06-11 01:13:51', '2019-06-11 01:13:51'),
(9, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ,GIL,ARTUR para: 1 ano a (matutino)', '2019-06-11 01:15:12', '2019-06-11 01:15:12'),
(10, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ,GIL,ARTUR para: 2 ano b\r\n (matutino)', '2019-06-11 01:15:32', '2019-06-11 01:15:32'),
(11, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ para: 4 ano b\r\n (matutino)', '2019-06-11 01:16:14', '2019-06-11 01:16:14'),
(12, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou a Turma do(as) aluno(as) ANDRÉ para: 1 ano a (matutino)', '2019-06-11 01:17:35', '2019-06-11 01:17:35'),
(13, 'ANDRÉ', 'ALUNOS', 'SIM', NULL, NULL, 'Cadastrou TESTE na Turma:  4 ano  b\r\n', '2019-06-11 10:46:20', '2019-06-11 10:46:20'),
(14, 'ANDRÉ', 'ALUNOS', 'SIM', NULL, NULL, 'Cadastrou TESTE 02 na Turma:  3 ano  a', '2019-06-11 10:46:50', '2019-06-11 10:46:50'),
(15, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em : STATUS =  De APROVADO  para CURSANDO / OUVINTE De  para NAO /    /  NECESSIDADES_ESPECIAIS = De Vazio para NAO / updated_at = De 2019-06-06 21:21:12 para 2019-06-11 07:58:24 /  ', '2019-06-11 10:58:24', '2019-06-11 10:58:24'),
(16, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em :    /  NECESSIDADES_ESPECIAIS = De NAO para SIM / updated_at = De 2019-06-11 07:58:24 para 2019-06-11 07:58:40 /  ', '2019-06-11 10:58:40', '2019-06-11 10:58:40'),
(17, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de TESTE 02 em :    /  NECESSIDADES_ESPECIAIS = De Vazio para SIM / updated_at = De 2019-06-11 07:46:49 para 2019-06-11 07:59:48 /  ', '2019-06-11 10:59:48', '2019-06-11 10:59:48'),
(18, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de TESTE 02 em :    /  NECESSIDADES_ESPECIAIS = De SIM para NAO / updated_at = De 2019-06-11 07:59:48 para 2019-06-11 08:00:00 /  ', '2019-06-11 11:00:00', '2019-06-11 11:00:00'),
(19, 'ANDRÉ', 'ALUNOS', 'SIM', NULL, NULL, 'Cadastrou ANDRE FREITAS DA SILVA na Turma:  4 ano  b\r\n', '2019-06-12 12:39:18', '2019-06-12 12:39:18'),
(20, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ANDRÉ da(s) Turma(s):  e Vinculou a(s) Turma(s) 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 12:46:48', '2019-06-12 12:46:48'),
(21, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ANDRÉ da(s) Turma(s): 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s) 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 12:48:34', '2019-06-12 12:48:34'),
(22, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou TESTE 02 da(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s)  ', '2019-06-12 12:54:47', '2019-06-12 12:54:47'),
(23, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou TESTE da(s) Turma(s): 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s) 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 12:56:01', '2019-06-12 12:56:01'),
(24, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou TESTE da(s) Turma(s): 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s) Nenhuma Turma ', '2019-06-12 12:56:24', '2019-06-12 12:56:24'),
(25, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou teste da(s) Turma(s): 4 ano b\r\n ,Status: DESISTENTE ,Ouvinte: /  e Vinculou a(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 13:00:42', '2019-06-12 13:00:42'),
(26, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou teste da(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/    ', '2019-06-12 13:00:50', '2019-06-12 13:00:50'),
(27, 'ANDRÉ', 'ALUNOS', 'SIM', NULL, NULL, 'Cadastrou VALENTINA na Turma:  3 ano  a', '2019-06-12 22:05:27', '2019-06-12 22:05:27'),
(28, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou VALENTINA da(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:06:18', '2019-06-12 22:06:18'),
(29, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de VALENTINA em :    /  NECESSIDADES_ESPECIAIS = De NAO para SIM / updated_at = De 2019-06-12 19:05:27 para 2019-06-12 19:07:39 /  ', '2019-06-12 22:07:39', '2019-06-12 22:07:39'),
(30, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou VALENTINA da(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:08:04', '2019-06-12 22:08:04'),
(31, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou VALENTINA da(s) Turma(s): 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:12:50', '2019-06-12 22:12:50'),
(32, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: CURSANDO ,Ouvinte: /  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:14:28', '2019-06-12 22:14:28'),
(33, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:15:19', '2019-06-12 22:15:19'),
(34, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:15:59', '2019-06-12 22:15:59'),
(35, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:18:40', '2019-06-12 22:18:40'),
(36, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:19:17', '2019-06-12 22:19:17'),
(37, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:19:25', '2019-06-12 22:19:25'),
(38, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:22:51', '2019-06-12 22:22:51'),
(39, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:26:10', '2019-06-12 22:26:10'),
(40, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s):  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:27:39', '2019-06-12 22:27:39'),
(41, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:27:51', '2019-06-12 22:27:51'),
(42, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: N/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: A/  ', '2019-06-12 22:28:39', '2019-06-12 22:28:39'),
(43, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: N/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: A/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: N/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: A/  ', '2019-06-12 22:29:19', '2019-06-12 22:29:19'),
(44, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: N/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: A/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:29:31', '2019-06-12 22:29:31'),
(45, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:29:40', '2019-06-12 22:29:40'),
(46, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-12 22:29:47', '2019-06-12 22:29:47'),
(47, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 4 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:30:05', '2019-06-12 22:30:05'),
(48, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:30:21', '2019-06-12 22:30:21'),
(49, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou ARTUR da(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/ 3 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): SEM TURMA  ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-12 22:30:34', '2019-06-12 22:30:34'),
(50, 'root', 'ALUNOS', 'SIM', NULL, NULL, 'Cadastrou TESTE DO USUARIO na Turma:  4 ano  b\r\n', '2019-06-14 16:52:28', '2019-06-14 16:52:28'),
(51, 'Andre', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de TESTE DO USUARIO em : TURMA =  De 4 ano  a  para  1 ano  a  / OUVINTE De SIM para NAO /    /  NECESSIDADES_ESPECIAIS = De SIM para NAO / updated_at = De 2019-06-14 13:52:28 para 2019-06-14 13:55:13 /  ', '2019-06-14 16:55:13', '2019-06-14 16:55:13'),
(52, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou TESTE DO USUARIO da(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  e Vinculou a(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  ', '2019-06-14 16:58:32', '2019-06-14 16:58:32'),
(53, 'André', 'ALUNOS', NULL, 'SIM', NULL, 'Desvinculou TESTE DO USUARIO da(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/ 2 ano b\r\n ,Status: ADMITIDO_DEPOIS ,Ouvinte: SIM/  e Vinculou a(s) Turma(s): 1 ano a ,Status: ADMITIDO_DEPOIS ,Ouvinte: NAO/  ', '2019-06-14 17:01:39', '2019-06-14 17:01:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2018_09_05_075327_create_alunos_table', 1),
(9, '2019_04_29_093829_create_turmas_table', 1),
(10, '2019_05_16_140252_create_logs_table', 1),
(11, '2019_05_28_122256_create_escolas_table', 1),
(12, '2019_06_02_093736_create_aluno_status_table', 1),
(15, '2019_06_02_094133_create_aluno_solicitacaos_table', 2),
(16, '2019_06_02_101501_create_aluno_turmas_table', 2),
(18, '2019_06_02_192244_create_aluno_classificacaos_table', 3),
(24, '2019_06_02_192623_create_aluno_turmas_table', 4),
(25, '2019_06_02_195515_create_aluno_solicitacaos_table', 4),
(26, '2019_06_13_081108_create_roles_table', 5),
(27, '2019_06_13_081136_create_permissions_table', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'LISTAR_ALUNOS', 'LISTAR ALUNOS', NULL, NULL),
(2, 'EDITAR_ALUNOS', 'EDITAR ALUNOS', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL),
(2, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(2, 'SECRETARIA', 'SECRETARIA', NULL, NULL),
(4, 'COORDENAÇÃO', 'COORDENAÇÃO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(10) UNSIGNED NOT NULL,
  `TURMA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TURMA_EXTRA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CATEGORIA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TURNO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UNICO` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ANO` date NOT NULL,
  `TURMA_IDADE` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id`, `TURMA`, `TURMA_EXTRA`, `CATEGORIA`, `TURNO`, `UNICO`, `STATUS`, `ANO`, `TURMA_IDADE`, `created_at`, `updated_at`) VALUES
(1, '1 ano', 'nao', '1 grau', 'matutino', 'a', 'ocupada', '2019-05-19', 6, '2019-05-19 09:00:00', '2019-05-19 09:00:00'),
(2, '2 ano', 'nao', '1 grau', 'matutino', 'b\r\n', 'ocupada', '2019-05-19', 6, '2019-05-19 09:00:00', '2019-05-19 09:00:00'),
(3, '3 ano', 'nao', '1 grau', 'matutino', 'a', 'CURSANDO', '2019-05-19', 6, '2019-05-19 09:00:00', '2019-05-19 09:00:00'),
(4, '4 ano', 'EXTRA', '1 grau', 'matutino', 'b\r\n', 'CURSANDO', '2019-05-19', 6, '2019-05-19 09:00:00', '2019-05-19 09:00:00'),
(5, 'SEM TURMA', 'NAO', '', '', '', '', '2019-05-27', 0, NULL, '2019-05-27 06:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `tipo`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin','Root', 'proandre21@hotmail.com', '$2y$10$e3vSJSqFBE6dpfkSite6teq5q9Fhd.niCub6Y/FgQ55oXGWLs3fqO', 'jjA3toOogjLlZR98czbZxwpkvI73f7edojAy14R3nTRE61ae75xO1UjllNZb', '2019-06-12 23:01:14', '2019-06-12 23:01:14'),
(2, 'Pedagogico', 'Ced', 'proandre210@gmail.com', '$2y$10$NGMm3gD3ismxUIMNE5tAWuMN7oTF227NNdn1yclBZP0R5QH5kG2LC', 'F0xs6I1U1uwKGRyXMyEWALxu3uvG2255bBtXMEoA0yfW5vTLbR6bRdx38RZ2', '2019-06-13 11:39:27', '2019-06-13 11:39:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aluno_classificacaos`
--
ALTER TABLE `aluno_classificacaos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aluno_solicitacaos`
--
ALTER TABLE `aluno_solicitacaos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_solicitacaos_turma_id_foreign` (`turma_id`),
  ADD KEY `aluno_solicitacaos_aluno_id_foreign` (`aluno_id`),
  ADD KEY `aluno_solicitacaos_status_id_foreign` (`status_id`);

--
-- Indexes for table `aluno_turmas`
--
ALTER TABLE `aluno_turmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_turmas_turma_id_foreign` (`turma_id`),
  ADD KEY `aluno_turmas_aluno_id_foreign` (`aluno_id`),
  ADD KEY `aluno_turmas_aluno_classificacao_id_foreign` (`aluno_classificacao_id`);

--
-- Indexes for table `escolas`
--
ALTER TABLE `escolas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `aluno_classificacaos`
--
ALTER TABLE `aluno_classificacaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aluno_solicitacaos`
--
ALTER TABLE `aluno_solicitacaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aluno_turmas`
--
ALTER TABLE `aluno_turmas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `escolas`
--
ALTER TABLE `escolas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno_solicitacaos`
--
ALTER TABLE `aluno_solicitacaos`
  ADD CONSTRAINT `aluno_solicitacaos_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aluno_solicitacaos_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `aluno_classificacaos` (`id`),
  ADD CONSTRAINT `aluno_solicitacaos_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `aluno_turmas`
--
ALTER TABLE `aluno_turmas`
  ADD CONSTRAINT `aluno_turmas_aluno_classificacao_id_foreign` FOREIGN KEY (`aluno_classificacao_id`) REFERENCES `aluno_classificacaos` (`id`),
  ADD CONSTRAINT `aluno_turmas_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aluno_turmas_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
