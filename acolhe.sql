-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Out-2024 às 01:29
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `acolhe`
--
CREATE DATABASE IF NOT EXISTS `acolhe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `acolhe`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `id_unidade` int(11) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` enum('Masculino','Feminino','Outro') DEFAULT NULL,
  `nome_pai` varchar(255) DEFAULT NULL,
  `nome_mae` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `oficina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `alunos`:
--   `id_unidade`
--       `unidades` -> `id`
--

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `idade`, `endereco`, `id_unidade`, `cpf`, `data_nascimento`, `sexo`, `nome_pai`, `nome_mae`, `responsavel`, `contato`, `complemento`, `oficina`) VALUES
(1, 'Lucas Mendes', 18, 'Rua A, 123, Cuiabá', 1, '888.888.888', '2024-10-01', 'Masculino', 'Fulano de Tal', 'Beltrana de 123', 'Beltrana de 123', '65992252525', 'Esquina 1', 1),
(2, 'Julia Costa', 19, 'Rua B, 456, Várzea Grande', 2, '2222', '2024-10-09', 'Feminino', 'asdasd', 'asdasd', 'asdasd', '99999', 'asdasd', 2),
(3, 'Pedro Lima', 17, 'Rua C, 789, Rondonópolis', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Mariana Rocha', 20, 'Rua D, 321, Nova Olímpia', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Thiago Martins', 22, 'Rua E, 654, Cáceres', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Ana Clara Silva', 0, '', 1, '123.456.789', '2005-02-15', 'Feminino', NULL, NULL, NULL, NULL, NULL, 1),
(17, 'Carlos Eduardo Santos', 0, '', 1, '987.654.321', '2006-05-20', 'Masculino', NULL, NULL, NULL, NULL, NULL, 1),
(18, 'Juliana Ferreira', 0, '', 1, '321.654.987', '2004-08-10', 'Feminino', NULL, NULL, NULL, NULL, NULL, 1),
(19, 'Rafael Almeida', 0, '', 1, '654.321.987', '2007-11-30', 'Masculino', NULL, NULL, NULL, NULL, NULL, 1),
(20, 'Mariana Costa', 0, '', 1, '147.258.369', '2005-03-25', 'Feminino', NULL, NULL, NULL, NULL, NULL, 1),
(21, 'Thiago Oliveira', 0, '', 1, '258.369.147', '2006-07-14', 'Masculino', NULL, NULL, NULL, NULL, NULL, 1),
(22, 'Luciana Ribeiro', 0, '', 1, '951.753.486', '2004-01-19', 'Feminino', NULL, NULL, NULL, NULL, NULL, 1),
(23, 'Pedro Henrique', 0, '', 1, '753.159.864', '2007-12-05', 'Masculino', NULL, NULL, NULL, NULL, NULL, 1),
(24, 'Fernanda Almeida', 0, '', 1, '321.123.456', '2005-09-16', 'Feminino', NULL, NULL, NULL, NULL, NULL, 1),
(25, 'Gustavo Lima', 0, '', 1, '654.987.321', '2006-10-22', 'Masculino', NULL, NULL, NULL, NULL, NULL, 1),
(26, 'Bruna Souza', 0, '', 1, '369.258.147', '2005-11-01', 'Feminino', NULL, NULL, NULL, NULL, NULL, 2),
(27, 'Eduardo Martins', 0, '', 1, '963.852.741', '2006-04-18', 'Masculino', NULL, NULL, NULL, NULL, NULL, 2),
(28, 'Clara Ribeiro', 0, '', 1, '159.753.852', '2004-06-23', 'Feminino', NULL, NULL, NULL, NULL, NULL, 2),
(29, 'Felipe Santos', 0, '', 1, '741.258.963', '2007-03-30', 'Masculino', NULL, NULL, NULL, NULL, NULL, 2),
(30, 'Ana Beatriz', 0, '', 1, '852.963.147', '2005-12-15', 'Feminino', NULL, NULL, NULL, NULL, NULL, 2),
(31, 'Roberto Carlos', 0, '', 1, '258.147.369', '2006-02-11', 'Masculino', NULL, NULL, NULL, NULL, NULL, 2),
(32, 'Marina Lima', 0, '', 1, '159.456.789', '2004-09-27', 'Feminino', NULL, NULL, NULL, NULL, NULL, 2),
(33, 'João Vitor', 0, '', 1, '369.147.258', '2007-01-05', 'Masculino', NULL, NULL, NULL, NULL, NULL, 2),
(34, 'Patrícia Almeida', 0, '', 1, '654.321.987', '2005-10-29', 'Feminino', NULL, NULL, NULL, NULL, NULL, 2),
(35, 'Lucas Oliveira', 0, '', 1, '147.258.369', '2006-08-08', 'Masculino', NULL, NULL, NULL, NULL, NULL, 2),
(36, 'Isabela Ferreira', 0, '', 1, '369.258.147', '2005-01-15', 'Feminino', NULL, NULL, NULL, NULL, NULL, 3),
(37, 'Thiago Mendes', 0, '', 1, '963.852.741', '2006-06-17', 'Masculino', NULL, NULL, NULL, NULL, NULL, 3),
(38, 'Sofia Santos', 0, '', 1, '159.753.852', '2004-03-09', 'Feminino', NULL, NULL, NULL, NULL, NULL, 3),
(39, 'Gabriel Costa', 0, '', 1, '741.258.963', '2007-07-22', 'Masculino', NULL, NULL, NULL, NULL, NULL, 3),
(40, 'Luana Alves', 0, '', 1, '852.963.147', '2005-05-12', 'Feminino', NULL, NULL, NULL, NULL, NULL, 3),
(41, 'Renan Lima', 0, '', 1, '258.147.369', '2006-11-30', 'Masculino', NULL, NULL, NULL, NULL, NULL, 3),
(42, 'Camila Ribeiro', 0, '', 1, '159.456.789', '2004-02-27', 'Feminino', NULL, NULL, NULL, NULL, NULL, 3),
(43, 'Victor Hugo', 0, '', 1, '369.147.258', '2007-04-14', 'Masculino', NULL, NULL, NULL, NULL, NULL, 3),
(44, 'Flávia Alves', 0, '', 1, '654.321.987', '2005-08-25', 'Feminino', NULL, NULL, NULL, NULL, NULL, 3),
(45, 'Marcelo Ferreira', 0, '', 1, '147.258.369', '2006-03-19', 'Masculino', NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL,
  `data_matricula` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `matriculas`:
--   `id_aluno`
--       `alunos` -> `id`
--   `id_oficina`
--       `oficinas` -> `id`
--

--
-- Extraindo dados da tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `id_aluno`, `id_oficina`, `data_matricula`) VALUES
(1, 1, 1, '2024-08-01'),
(2, 2, 2, '2024-08-02'),
(3, 3, 3, '2024-08-03'),
(4, 4, 4, '2024-08-04'),
(5, 5, 5, '2024-08-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacoes`
--

CREATE TABLE `observacoes` (
  `id` int(11) NOT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `data` date NOT NULL,
  `tipo` enum('Psicossocial','Professor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `observacoes`:
--   `id_matricula`
--       `matriculas` -> `id`
--

--
-- Extraindo dados da tabela `observacoes`
--

INSERT INTO `observacoes` (`id`, `id_matricula`, `comentario`, `data`, `tipo`) VALUES
(1, 1, 'Aluno demonstrou interesse nas atividades.', '2024-08-05', 'Professor'),
(2, 2, 'Participação ativa nas aulas.', '2024-08-06', 'Psicossocial'),
(3, 3, 'Necessita de acompanhamento.', '2024-08-07', 'Professor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `oficinas`
--

CREATE TABLE `oficinas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_unidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `oficinas`:
--   `id_unidade`
--       `unidades` -> `id`
--

--
-- Extraindo dados da tabela `oficinas`
--

INSERT INTO `oficinas` (`id`, `nome`, `id_unidade`) VALUES
(1, 'Oficina de Informática', 1),
(2, 'Oficina de Artes', 1),
(3, 'Oficina de Música', 1),
(4, 'Oficina de Dança', 1),
(5, 'Oficina de Esporte', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `presencas`
--

CREATE TABLE `presencas` (
  `id` int(11) NOT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `status` enum('Presente','Ausente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `presencas`:
--   `id_matricula`
--       `matriculas` -> `id`
--

--
-- Extraindo dados da tabela `presencas`
--

INSERT INTO `presencas` (`id`, `id_matricula`, `data`, `status`) VALUES
(1, 1, '2024-08-05', 'Presente'),
(2, 1, '2024-08-12', 'Ausente'),
(3, 2, '2024-08-05', 'Presente'),
(4, 3, '2024-08-12', 'Presente'),
(5, 4, '2024-08-05', 'Ausente'),
(66, 1, '2024-10-09', 'Ausente'),
(67, 2, '2024-10-09', 'Ausente'),
(68, 3, '2024-10-09', 'Ausente'),
(69, 4, '2024-10-09', 'Ausente'),
(70, 5, '2024-10-09', 'Ausente'),
(71, 1, '2024-10-09', 'Ausente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_oficinas`
--

CREATE TABLE `professor_oficinas` (
  `id` int(11) NOT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `professor_oficinas`:
--   `id_professor`
--       `usuarios` -> `id`
--   `id_oficina`
--       `oficinas` -> `id`
--

--
-- Extraindo dados da tabela `professor_oficinas`
--

INSERT INTO `professor_oficinas` (`id`, `id_professor`, `id_oficina`) VALUES
(1, 6, 3),
(3, 6, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `unidades`:
--

--
-- Extraindo dados da tabela `unidades`
--

INSERT INTO `unidades` (`id`, `nome`) VALUES
(1, 'Cuiabá'),
(2, 'Várzea Grande'),
(3, 'Rondonópolis'),
(4, 'Nova Olímpia'),
(5, 'Cáceres');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('Psicossocial','Professor','Coordenador') NOT NULL,
  `id_unidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `usuarios`:
--   `id_unidade`
--       `unidades` -> `id`
--

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `id_unidade`) VALUES
(1, 'João da Silva', 'joao@exemplo.com', 'senha123', 'Psicossocial', NULL),
(2, 'Maria Oliveira', 'maria@exemplo.com', 'senha456', 'Professor', 1),
(3, 'Carlos Pereira', 'carlos@exemplo.com', 'senha789', 'Coordenador', 1),
(4, 'Ana Santos', 'ana@exemplo.com', 'senha123', 'Professor', 2),
(5, 'Fernanda Almeida', 'fernanda@exemplo.com', 'senha456', 'Coordenador', 2),
(6, 'Rafael Mendes', 'mendes.analista@gmail.com', '123456', 'Professor', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- Índices para tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_oficina` (`id_oficina`);

--
-- Índices para tabela `observacoes`
--
ALTER TABLE `observacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_matricula` (`id_matricula`);

--
-- Índices para tabela `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- Índices para tabela `presencas`
--
ALTER TABLE `presencas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_matricula` (`id_matricula`);

--
-- Índices para tabela `professor_oficinas`
--
ALTER TABLE `professor_oficinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor` (`id_professor`),
  ADD KEY `id_oficina` (`id_oficina`);

--
-- Índices para tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `observacoes`
--
ALTER TABLE `observacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `presencas`
--
ALTER TABLE `presencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `professor_oficinas`
--
ALTER TABLE `professor_oficinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`);

--
-- Limitadores para a tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`id_oficina`) REFERENCES `oficinas` (`id`);

--
-- Limitadores para a tabela `observacoes`
--
ALTER TABLE `observacoes`
  ADD CONSTRAINT `observacoes_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `matriculas` (`id`);

--
-- Limitadores para a tabela `oficinas`
--
ALTER TABLE `oficinas`
  ADD CONSTRAINT `oficinas_ibfk_1` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`);

--
-- Limitadores para a tabela `presencas`
--
ALTER TABLE `presencas`
  ADD CONSTRAINT `presencas_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `matriculas` (`id`);

--
-- Limitadores para a tabela `professor_oficinas`
--
ALTER TABLE `professor_oficinas`
  ADD CONSTRAINT `professor_oficinas_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `professor_oficinas_ibfk_2` FOREIGN KEY (`id_oficina`) REFERENCES `oficinas` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
