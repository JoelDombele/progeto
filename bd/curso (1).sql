-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22-Nov-2023 às 13:51
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `link_aula` varchar(255) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id`, `nome`, `descricao`, `link_aula`, `curso_id`) VALUES
(1, 'IntroducÃ£o', 'Vamos aprender sobre realidade virtual', '../Cursos/RV/introducao.html', 17),
(11, 'IntroducÃ£o', 'php', '../cursos/RV/introducao.html', 1),
(12, 'Operadores Aritmeticos', 'Aprender', '../cursos/RV/introducao.htm', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(1, 'Marketing Digital', 'Aqui voce Aprende sobre o mundo do negocio online!'),
(3, 'ProgramaÃ§Ã£o', 'Aprender a Programar'),
(4, 'Desenvolvimento Pessoal', 'Um curso que te ajuda a encontrar a tua melhor VersÃ£o'),
(5, 'Tecnologia', 'O mundo da inovaÃ§Ã£o');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `instrutor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `descricao`, `imagem`, `categoria_id`, `instrutor_id`) VALUES
(1, 'PHP', 'Aqui voce vai aprender a programar em PHP', NULL, 3, 2),
(3, 'Mercado de afiliados', 'O mundo de negocios online', 'uploads/imagens/cursos', 2, 3),
(11, 'Java', 'ProgramaÃ§Ã£ desktop', 'uploads/imagens/cursos/transferir.jpeg', 1, 2),
(14, 'HTML5 e CSS3', 'ProgramaÃ§Ã£o WEb', 'uploads/imagens/cursos/transferir.jpeg', 3, 3),
(16, 'HTML5 e CSS3', 'ProgramaÃ§Ã£o WEb', 'uploads/imagens/cursos/transferir.jpeg', 3, 3),
(17, 'Realidade Virtual', 'Realidade virtual', 'uploads/imagens/cursos/transferir.jpeg', 1, 2),
(18, 'Pyton', 'logica de programaÃ§Ã£o', 'uploads/imagens/cursos/transferir.jpeg', 3, 2),
(19, 'Calistenia Basica', 'Um corpo fitness', 'uploads/imagens/cursos/transferir.jpeg', 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrutor`
--

CREATE TABLE `instrutor` (
  `instrutor_id` int(11) NOT NULL,
  `instrutor_nome` varchar(255) DEFAULT NULL,
  `instrutor_email` varchar(255) DEFAULT NULL,
  `instrutor_senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nome`, `email`, `senha`) VALUES
(1, ' joel', 'joelantoniodombele@gmail.com', 'joel4002'),
(2, 'Dombele', 'joelantoniodombele@gmail.com', '4321joel'),
(3, ' Vania', 'vania@gmail.com', 'vania1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`instrutor_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instrutor`
--
ALTER TABLE `instrutor`
  MODIFY `instrutor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD CONSTRAINT `inscricoes_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `inscricoes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
