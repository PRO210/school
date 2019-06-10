-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 10-Jun-2019 às 03:12
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
(1, NULL, 'ANDRÉ', NULL, 'RG', 'NOVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FEMININO', NULL, 'SIM', NULL, NULL, 'INDÍGENA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SIM', NULL, NULL, 'SIM', 'Ponto Escolhido', 'INCOMPLETO', 'INCOMPLETO II', NULL, NULL, 'SIM', NULL, NULL, 'SIM', NULL, NULL, NULL, NULL, '2019-06-07 00:21:12'),
(2, NULL, 'GIL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'ARTUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'SOCORRO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 'APROVADO', NULL, NULL, NULL, NULL, NULL),
(2, 'CURSANDO', NULL, NULL, NULL, NULL, NULL),
(3, 'DESISTENTE', NULL, NULL, NULL, NULL, NULL),
(4, 'ADMITIDO_DEPOIS', NULL, NULL, NULL, '2019-06-06 03:00:00', '2019-06-06 03:00:00'),
(5, 'TRANSFERIDO', NULL, NULL, NULL, '2019-06-06 03:00:00', '2019-06-06 03:00:00');

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
(5, 2, 2, 2, '2019-06-05', 'SIM', NULL, NULL, NULL, NULL),
(6, 4, 2, 1, '2019-06-05', 'SIM', NULL, NULL, NULL, NULL),
(7, 4, 1, 2, '0000-00-00', NULL, NULL, NULL, NULL, NULL),
(8, 2, 1, 1, '0000-00-00', NULL, NULL, NULL, NULL, NULL),
(9, 3, 3, 3, '2019-06-09', NULL, NULL, NULL, NULL, NULL);

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
(3, 'ANDRÉ', 'ALUNOS', NULL, 'SIM', NULL, 'Alterou o(s) Campo(s) de ANDRÉ em : TURMA =  De 1 ano  b\r\n  para  2 ano  b\r\n  / OUVINTE De SIM para NAO /    /   updated_at = De 2019-06-06 21:20:33 para 2019-06-06 21:21:12 /  ', '2019-06-07 00:21:12', '2019-06-07 00:21:12');

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
(25, '2019_06_02_195515_create_aluno_solicitacaos_table', 4);

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aluno_classificacaos`
--
ALTER TABLE `aluno_classificacaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aluno_solicitacaos`
--
ALTER TABLE `aluno_solicitacaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aluno_turmas`
--
ALTER TABLE `aluno_turmas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `escolas`
--
ALTER TABLE `escolas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
