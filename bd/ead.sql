-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: ead
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `senhaHash` varchar(255) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'mateus@gmail.com','$2a$12$lIR2ER09a3ldfsnN31AtdOWqBsQY.HV2v0VsELAbkpDSvM32aMy0i',NULL),(4,'joel@gmail.com','$2y$10$wxK.bLLFOCTeh0Jchq/19.r8EjNxphiS6nGEy0eGW20gz7tpUoJY2','Joel Antonio'),(5,'vania@gmail.com','$2y$10$0tNq6/rBzgehDu/28Ja6JOX2BpCQQYsbs0rHM.kO9zmxbeuRzoq/m','Vania'),(6,'suzana@gmail.com','$2y$10$axp8Sh8.9xKJkZ1B/LblFeyY2V.K4HOlgBCze0Dkt0sGSR3YXDawi','Suzana');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `categoria_id` int NOT NULL,
  `instrutor_id` int NOT NULL,
  `descricao` text NOT NULL,
  `tipo_curso` int NOT NULL,
  `preco_curso` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(255) NOT NULL,
  `visualizacoes` int DEFAULT '0',
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categorias` (`categoria_id`),
  KEY `fk_instrutores` (`instrutor_id`),
  CONSTRAINT `fk_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `fk_instrutores` FOREIGN KEY (`instrutor_id`) REFERENCES `instrutores` (`instrutor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Javascript',1,1,'Explore o mundo dinâmico e interativo do desenvolvimento web com nosso curso abrangente de JavaScript. Este curso é projetado para iniciantes que desejam mergulhar no universo da programação web e construir experiências de usuário incríveis.',2,0.00,'',73,'Unofficial_JavaScript_logo_2.svg.png'),(4,'PHP PARA INICIANTES',1,1,'Este curso abrangente de Desenvolvimento Web com PHP foi projetado para iniciantes e desenvolvedores intermediários que desejam aprimorar suas habilidades na criação de aplicações web dinâmicas e robustas. PHP é uma linguagem de script server-side amplamente utilizada para o desenvolvimento web, permitindo a criação de páginas dinâmicas, interação com bancos de dados e construção de aplicativos web poderosos.',2,0.00,'',38,'baixados (1).png'),(5,'Desenvolvimento Web - Do Iniciante ao Avançado',1,1,'Bem-vindo ao curso \"Desenvolvimento Web - Do Iniciante ao Avançado\"! Este curso abrangente é projetado para levar você a uma jornada fascinante no mundo da programação web, começando desde os fundamentos até habilidades avançadas, capacitando-o a criar sites dinâmicos, interativos e de alto desempenho.',2,0.00,'',99,'curso1.jpg'),(6,'Laravel',1,1,'Explore as maravilhas da programação web com nosso curso de Laravel, onde você mergulhará nas técnicas avançadas desse framework PHP moderno. Desde a construção de aplicativos elegantes até a gestão eficiente de bancos de dados, este curso oferece uma jornada prática e abrangente para dominar o desenvolvimento web com Laravel.',2,0.00,'',14,'escolas-de-PHP-Laravel-scaled.jpg'),(8,'Nutricão Desportiva',2,2,'Alcance o máximo desempenho e bem-estar com nosso curso de Nutrição Esportiva, onde você aprenderá a otimizar sua alimentação para potencializar seus treinos, acelerar a recuperação e atingir seus objetivos fitness. Descubra os segredos da nutrição específica para esportes e transforme sua abordagem alimentar em um impulso para o sucesso atlético.',2,0.00,'',16,'int1-2.jpg'),(9,'Saúde Mental e Bem-Estar Emocional',2,2,'Este curso aborda aspectos fundamentais da saúde mental e do bem-estar emocional, oferecendo uma compreensão abrangente das práticas e estratégias que contribuem para uma vida mentalmente saudável. Os participantes terão a oportunidade de explorar conceitos-chave relacionados ao equilíbrio emocional, resiliência e desenvolvimento pessoal.',2,0.00,'',10,'a male head getting shocked.jpg');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aulas`
--

DROP TABLE IF EXISTS `aulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aulas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `link_aula` varchar(255) NOT NULL,
  `video` varchar(1000) DEFAULT NULL,
  `curso_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `curso_id` (`curso_id`),
  CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aulas`
--

LOCK TABLES `aulas` WRITE;
/*!40000 ALTER TABLE `aulas` DISABLE KEYS */;
INSERT INTO `aulas` VALUES (1,'Introducão','A aula \"Introdução ao JavaScript\" é um mergulho inicial e abrangente no universo da programação web utilizando JavaScript. Concebida para alunos iniciantes, esta aula destaca os principais conceitos, estruturas e características fundamentais dessa poderosa linguagem de programação.','https://developer.mozilla.org/pt-BR/docs/Web/JavaScript','<iframe width=\"880\" height=\"495\" src=\"https://www.youtube.com/embed/qoSksQ4s_hg?list=PL4cUxeGkcC9i9Ae2D9Ee1RvylH38dKuET\" title=\"JavaScript Tutorial For Beginners 01 - Introduction\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>',1),(3,'Variáveis e Tipos de Dados','A aula de \"Variáveis e Tipos de Dados\" é uma introdução crucial para qualquer estudante de JavaScript, pois ela estabelece as bases fundamentais para a compreensão do funcionamento dessa linguagem de programação. Durante esta aula, os participantes serão guiados através dos conceitos essenciais de como armazenar e manipular informações em JavaScript.','https://developer.mozilla.org/pt-BR/docs/Web/JavaScript','<iframe width=\"880\" height=\"495\" src=\"https://www.youtube.com/embed/Yv9c63_96CY\" title=\"JavaScript Bebê: Variáveis e tipos de dados\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>',1),(4,'Operadores','A aula de \"Operadores em JavaScript\" é uma exploração abrangente dos operadores fundamentais que capacitam os desenvolvedores a realizar operações diversas e complexas em JavaScript. Durante esta sessão, os alunos mergulharão nos diferentes tipos de operadores, compreendendo seu funcionamento e aprendendo como aplicá-los de maneira eficaz em seus scripts.','https://developer.mozilla.org/pt-BR/docs/Web/JavaScript','<iframe width=\"880\" height=\"495\" src=\"https://www.youtube.com/embed/hZG9ODUdxHo\" title=\"Operadores (Parte1) - Curso JavaScript #07\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>',1);
/*!40000 ALTER TABLE `aulas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Programação','Tudo sobre Programação'),(2,'Saude e Bem-Estar','Tudo sobre Saude e bem estar');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricoes`
--

DROP TABLE IF EXISTS `inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscricoes` (
  `inscricao_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inscricao_id`),
  KEY `fk_usuario` (`usuario_id`),
  KEY `fk_curso` (`curso_id`),
  CONSTRAINT `fk_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricoes`
--

LOCK TABLES `inscricoes` WRITE;
/*!40000 ALTER TABLE `inscricoes` DISABLE KEYS */;
INSERT INTO `inscricoes` VALUES (1,1,5,'2024-02-14 12:16:30'),(2,1,1,'2024-02-14 15:53:14'),(3,1,4,'2024-02-14 16:01:52'),(6,4,5,'2024-02-15 21:42:39'),(7,4,4,'2024-02-15 21:46:48'),(8,4,1,'2024-02-15 21:48:54'),(9,5,5,'2024-02-15 21:58:51'),(10,5,1,'2024-02-15 21:59:03'),(11,6,8,'2024-02-28 13:56:30'),(12,6,1,'2024-02-28 13:57:18'),(13,4,9,'2024-02-29 14:22:36'),(14,5,6,'2024-03-07 12:07:42');
/*!40000 ALTER TABLE `inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instrutores`
--

DROP TABLE IF EXISTS `instrutores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instrutores` (
  `instrutor_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `senhaHash` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `area_formacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`instrutor_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instrutores`
--

LOCK TABLES `instrutores` WRITE;
/*!40000 ALTER TABLE `instrutores` DISABLE KEYS */;
INSERT INTO `instrutores` VALUES (1,'Joel Antonio','$2y$10$YiANP4oQr02/i9BrLMTyWOlMl.a8/YA9yAhZ46HYZXl5.xZfGThbK','joel@gmail.com',NULL),(2,'Vania','$2y$10$aY/GMve98.lCYS2O7YVUP.9Y.Em2W48ch0eAiVm6fu3VQF.frnk/O','vania@gmail.com',NULL);
/*!40000 ALTER TABLE `instrutores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instrutores_categorias`
--

DROP TABLE IF EXISTS `instrutores_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instrutores_categorias` (
  `instrutor_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  PRIMARY KEY (`instrutor_id`,`categoria_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `instrutores_categorias_ibfk_1` FOREIGN KEY (`instrutor_id`) REFERENCES `instrutores` (`instrutor_id`),
  CONSTRAINT `instrutores_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instrutores_categorias`
--

LOCK TABLES `instrutores_categorias` WRITE;
/*!40000 ALTER TABLE `instrutores_categorias` DISABLE KEYS */;
INSERT INTO `instrutores_categorias` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `instrutores_categorias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-08 18:43:29
