-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2024 às 23:01
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

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
  `oficina` int(11) DEFAULT NULL,
  `foto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `alunos`:
--   `id_unidade`
--       `unidades` -> `id`
--

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `idade`, `endereco`, `id_unidade`, `cpf`, `data_nascimento`, `sexo`, `nome_pai`, `nome_mae`, `responsavel`, `contato`, `complemento`, `oficina`, `foto`) VALUES
(1, 'Lucas Mendes', 18, 'Rua A, 123, Cuiabá', 1, '888.888.888', '2024-10-01', 'Masculino', 'Fulano de Tal', 'Beltrana de 123', 'Beltrana de 123', '65992252525', 'Esquina 1', 1, NULL),
(2, 'Julia Costa', 19, 'Rua B, 456, Várzea Grande', 1, '2222', '2024-10-09', 'Feminino', 'asdasd', 'asdasd', 'asdasd', '99999', 'asdasd', 1, NULL),
(3, 'Pedro Lima', 17, 'Rua C, 789, Rondonópolis', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(4, 'Mariana Rocha', 20, 'Rua D, 321, Nova Olímpia', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(5, 'Thiago Martins', 22, 'Rua E, 654, Cáceres', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `id_unidade` int(11) DEFAULT NULL,
  `data_aviso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `avisos`:
--   `id_unidade`
--       `unidades` -> `id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL,
  `data_matricula` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `presencas`:
--   `id_matricula`
--       `matriculas` -> `id`
--

--
-- Extraindo dados da tabela `presencas`
--

INSERT INTO `presencas` (`id`, `id_matricula`, `data`, `status`) VALUES
(471, 1, '2024-10-11', 'Presente'),
(472, 2, '2024-10-11', 'Presente'),
(473, 3, '2024-10-11', 'Presente'),
(474, 4, '2024-10-11', 'Presente'),
(475, 5, '2024-10-11', 'Presente'),
(476, 1, '2024-10-11', 'Presente'),
(477, 2, '2024-10-11', 'Presente'),
(478, 3, '2024-10-11', 'Presente'),
(479, 4, '2024-10-11', 'Presente'),
(480, 5, '2024-10-11', 'Presente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_oficinas`
--

CREATE TABLE `professor_oficinas` (
  `id` int(11) NOT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 6, 1),
(3, 6, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tipo` enum('Psicossocial','Professor','Coordenador','Administrativo') NOT NULL,
  `id_unidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(6, 'Rafael Mendes', 'mendes.analista@gmail.com', '123456', 'Professor', 1),
(7, 'Roberto', '123@123.com', '123456', 'Administrativo', 1);

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
-- Índices para tabela `avisos`
--
ALTER TABLE `avisos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`);

--
-- Limitadores para a tabela `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `avisos_ibfk_1` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`id`);

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
