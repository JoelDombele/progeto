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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'mateus@gmail.com','$2a$12$lIR2ER09a3ldfsnN31AtdOWqBsQY.HV2v0VsELAbkpDSvM32aMy0i',NULL),(4,'joel@gmail.com','$2y$10$wxK.bLLFOCTeh0Jchq/19.r8EjNxphiS6nGEy0eGW20gz7tpUoJY2','Joel Antonio'),(5,'vania@gmail.com','$2y$10$0tNq6/rBzgehDu/28Ja6JOX2BpCQQYsbs0rHM.kO9zmxbeuRzoq/m','Vania');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Javascript',1,1,'Explore o mundo dinâmico e interativo do desenvolvimento web com nosso curso abrangente de JavaScript. Este curso é projetado para iniciantes que desejam mergulhar no universo da programação web e construir experiências de usuário incríveis.',2,0.00,'',65,'Unofficial_JavaScript_logo_2.svg.png'),(4,'PHP PARA INICIANTES',1,1,'Este curso abrangente de Desenvolvimento Web com PHP foi projetado para iniciantes e desenvolvedores intermediários que desejam aprimorar suas habilidades na criação de aplicações web dinâmicas e robustas. PHP é uma linguagem de script server-side amplamente utilizada para o desenvolvimento web, permitindo a criação de páginas dinâmicas, interação com bancos de dados e construção de aplicativos web poderosos.',2,0.00,'',35,'baixados (1).png'),(5,'Desenvolvimento Web - Do Iniciante ao Avançado',1,1,'Bem-vindo ao curso \"Desenvolvimento Web - Do Iniciante ao Avançado\"! Este curso abrangente é projetado para levar você a uma jornada fascinante no mundo da programação web, começando desde os fundamentos até habilidades avançadas, capacitando-o a criar sites dinâmicos, interativos e de alto desempenho.',2,0.00,'',93,'curso1.jpg'),(6,'Laravel',1,1,'Explore as maravilhas da programação web com nosso curso de Laravel, onde você mergulhará nas técnicas avançadas desse framework PHP moderno. Desde a construção de aplicativos elegantes até a gestão eficiente de bancos de dados, este curso oferece uma jornada prática e abrangente para dominar o desenvolvimento web com Laravel.',2,0.00,'',5,'escolas-de-PHP-Laravel-scaled.jpg'),(8,'Nutricão Desportiva',2,2,'Alcance o máximo desempenho e bem-estar com nosso curso de Nutrição Esportiva, onde você aprenderá a otimizar sua alimentação para potencializar seus treinos, acelerar a recuperação e atingir seus objetivos fitness. Descubra os segredos da nutrição específica para esportes e transforme sua abordagem alimentar em um impulso para o sucesso atlético.',2,0.00,'',10,'int1-2.jpg');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
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
  PRIMARY KEY (`inscricao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricoes`
--

LOCK TABLES `inscricoes` WRITE;
/*!40000 ALTER TABLE `inscricoes` DISABLE KEYS */;
INSERT INTO `inscricoes` VALUES (1,1,5,'2024-02-14 12:16:30'),(2,1,1,'2024-02-14 15:53:14'),(3,1,4,'2024-02-14 16:01:52'),(6,4,5,'2024-02-15 21:42:39'),(7,4,4,'2024-02-15 21:46:48'),(8,4,1,'2024-02-15 21:48:54'),(9,5,5,'2024-02-15 21:58:51'),(10,5,1,'2024-02-15 21:59:03');
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

-- Dump completed on 2024-02-21 16:02:17
