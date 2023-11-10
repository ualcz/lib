-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para lib
CREATE DATABASE IF NOT EXISTS `lib` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lib`;

-- Copiando estrutura para tabela lib.autor
CREATE TABLE IF NOT EXISTS `autor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `nacionalidade` varchar(50) NOT NULL DEFAULT '0',
  `sexo` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela lib.autor: ~2 rows (aproximadamente)
INSERT INTO `autor` (`id`, `nome`, `nacionalidade`, `sexo`) VALUES
	(10, 'Karl Marx', 'DE', 'M'),
	(11, 'Friedrich Engels', 'DE', 'M'),
	(12, 'Felipe Saraiça', 'Br', 'M'),
	(14, ' Jorge Amado', 'Br', 'M'),
	(15, ' Kiera Cass', 'USA', 'F'),
	(16, 'Paula Pimenta', 'Br', 'F'),
	(17, 'Itamar Vieira Junior', 'Br', 'M'),
	(18, 'Racionais MC', 'BR', 'M'),
	(19, 'George Orwell', '??', 'M');

-- Copiando estrutura para tabela lib.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `livro_id` int NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__livros` (`livro_id`),
  KEY `FK_comentarios_user` (`user_id`),
  CONSTRAINT `FK__livros` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`),
  CONSTRAINT `FK_comentarios_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela lib.comentarios: ~0 rows (aproximadamente)
INSERT INTO `comentarios` (`id`, `comentario`, `livro_id`, `user_id`, `data`) VALUES
	(2, 'Verdadeira obra da litaria brasileira não é atoa que faz partes das leituras obrigatórias para o seu vestibular  da Unicamp', 6, 4, '2023-11-10');

-- Copiando estrutura para tabela lib.livros
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `genero` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `sinopse` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela lib.livros: ~2 rows (aproximadamente)
INSERT INTO `livros` (`id`, `titulo`, `genero`, `image`, `link`, `sinopse`) VALUES
	(1, 'Manifesto comunista', 'História, sociologia, filosofia', './upload/_654ea5f35c58e_comun.jpeg', './upload/_654ea5f35c32e_MARX; ENGELS. Manifesto Comunista.pdf', 'Escrito há quase 200 anos, O manifesto comunista, de Karl Marx e Friedrich Engels, foi concebido excepcionalmente para comunicar as ideias seminais da organização política do proletariado a um público amplo e popular. A finalidade dos autores era aproximar a classe trabalhadora das teorias políticas que formariam as bases do comunismo na Europa. A empreitada resultou num texto claro e objetivo, que chegou aos quatro cantos do planeta e se tornou um dos principais acontecimentos políticos do mundo moderno e contemporâneo'),
	(2, 'Capitães da Areia', ' Romance, Ficção', './upload/_654ea6438a469_81iVW0VvbUL._SL1500_.jpg', './upload/_654ea6438a461_Capitães da Areia - Jorge Amado.pdf', 'Desde o seu lançamento, em 1937, Capitães da Areia causou escândalo: inúmeros exemplares do livro foram queimados em praça pública, por determinação do Estado Novo. Ao longo de sete décadas a narrativa não perdeu viço nem atualidade, pelo contrário: a vida urbana dos meninos pobres e infratores ganhou contornos trágicos e urgentes. Várias gerações de brasileiros sofreram o impacto e a sedução desses meninos que moram num trapiche abandonado no areal do cais de Salvador, vivendo à margem das convenções sociais. Verdadeiro romance de formação, o livro nos torna íntimos de suas pequenas criaturas, cada uma delas com suas carências e suas ambições: do líder Pedro Bala ao religioso Pirulito, do ressentido e cruel Sem-Pernas ao aprendiz de cafetão Gato, do sensato Professor ao rústico sertanejo Volta Seca. Com a força envolvente da sua prosa, Jorge Amado nos aproxima desses garotos e nos contagia com seu intenso desejo de liberdade.'),
	(3, 'A Seleção', 'Romance, Ficção juvenil, Literatura fantástica, Ficção distópica', './upload/_654ea666ae851_917W9lLP8qL._SY522_.jpg', './upload/_654ea666ae849_8ff490f62185d29dfcc6411f279c8098.pdf', 'Para trinta e cinco garotas, a Seleção é a chance de uma vida. É a oportunidade de ser alçada a um mundo de vestidos deslumbrantes e joias valiosas. De morar em um palácio, conquistar o coração do belo príncipe Maxon e um dia ser a rainha. America Singer, no entanto, estar entre as Selecionadas é um pesadelo. Significa deixar para trás o rapaz que ama. Abandonar sua família e seu lar para entrar em uma disputa ferrenha por uma coroa que ela não quer. E viver em um palácio sob a ameaça constante de ataques rebeldes. Então America conhece pessoalmente o príncipe - e percebe que a vida com que sempre sonhou talvez não seja nada comparada ao futuro que nunca tinha ousado imaginar.'),
	(4, 'fazendo meu filme romance', ' Romance', './upload/_654ea7abc35e4_Sem-Titulo-2-jpg.webp', './upload/_654ea7abc32a5_Paula Pimenta  - Fazendo meu filme.pdf', 'Depois de conquistar milhares de leitores e leitoras, a nossa doce e querida Fani volta ainda mais divertida e encantadora. O segundo volume do livro Fazendo meu filme apresenta as aventuras de Estefânia Castelino Belluz na terra da rainha. Sim, na Inglaterra! Longe do grande amor, ela passa por momentos de alegria, dor, saudade, tristeza e, mais do que isso, pode conhecer melhor a si mesma. Sem deixar de lado suas amigas inseparáveis e sua família, ela consegue, no outro continente, viver momentos cheios de suspense, revelações, aventuras, descobertas e emoções fortíssimas! Feliz, triste, preocupada, ansiosa, temerosa, otimista, insegura, cheia de si, apaixonada, desiludida, seja como estiver, Fani mostra a cada página deste livro que não é mais aquela menina tão frágil que muitas vezes se escondia por trás de sua timidez'),
	(5, 'Torto arado', 'Ficção, Realismo mágico, Romance de amor', './upload/_654ea8c375ca8_41L2ffvMKIL.jpg', './upload/_654ea8c375b0f_10_Torto Arado - Itamar Vieira Junior.pdf', 'Torto Arado é um romance brasileiro de 2019 escrito pelo autor baiano Itamar Vieira Junior. Conta a história de duas irmãs, Bibiana e Belonísia, marcadas por um acidente de infância, e que vivem em condições de trabalho escravo contemporâneo em uma fazenda no sertão da Chapada Diamantina.'),
	(6, 'Sobrevivendo no inferno livro', 'Poesia', './upload/_654eaa86b14ae_Sobrevivendo-no-inferno.jpg', './upload/_654eaa86b126f_Racionais-Mcs-Sobrevivendo-no-Inferno.pdf', 'A principal obra do maior grupo de rap do Brasil agora publicada em livro, contundente como sempre e atual como nunca. Leitura obrigatória do vestibular da Unicamp.  Na virada para os anos 1990, os Racionais MC’s emergiram como um dos mais importantes acontecimentos da cultura brasileira. Incensado pela crítica, o disco Sobrevivendo no infernovendeu mais de um milhão e meio de cópias.  Agora publicados em livro, precedidos por um texto de apresentação e intermeados por fotos clássicas e inéditas, os raps dos Racionais são a imagem mais bem-acabada de uma sociedade que se tornou humanamente inviável, e uma tentativa radical, esteticamente brilhante, de sobreviver a ela.'),
	(7, 'A revolução dos Bichos', 'Alegoria, Sátira, Fábula, Novela, Sátira política, Ficção distópica, Roman à clef', './upload/_654ead3ed370e_91BsZhxCRjL._SL1500_.jpg', './upload/_654ead3ed3708_revolucao-dos-bichos.pdf', 'Verdadeiro clássico moderno, concebido por um dos mais influentes escritores do século XX, A revolução dos bichos é uma fábula sobre o poder. Narra a insurreição dos animais de uma granja contra seus donos. Progressivamente, porém, a revolução degenera numa tirania ainda mais opressiva que a dos humanos.');

-- Copiando estrutura para tabela lib.livro_autor
CREATE TABLE IF NOT EXISTS `livro_autor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livro_id` int NOT NULL DEFAULT '0',
  `autor_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_livro_autor_livros` (`livro_id`),
  KEY `FK_livro_autor_autor` (`autor_id`),
  CONSTRAINT `FK_livro_autor_autor` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`),
  CONSTRAINT `FK_livro_autor_livros` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela lib.livro_autor: ~0 rows (aproximadamente)
INSERT INTO `livro_autor` (`id`, `livro_id`, `autor_id`) VALUES
	(1, 1, 10),
	(2, 1, 11),
	(3, 2, 14),
	(4, 3, 15),
	(5, 4, 16),
	(6, 5, 17),
	(7, 6, 18),
	(8, 7, 19);

-- Copiando estrutura para tabela lib.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `admin` int DEFAULT NULL,
  `senha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela lib.user: ~2 rows (aproximadamente)
INSERT INTO `user` (`id`, `user`, `email`, `admin`, `senha`, `data`) VALUES
	(2, 'pesoa', 'pessoa@gmail.com', 1, '827ccb0eea8a706c4c34a16891f84e7b', '2023-11-02'),
	(3, 'rana', 'rana@gmail.com', 2, '827ccb0eea8a706c4c34a16891f84e7b', '2023-11-09'),
	(4, 'claudin', 'claudin@gmail.com', 2, '827ccb0eea8a706c4c34a16891f84e7b', '2023-11-09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
