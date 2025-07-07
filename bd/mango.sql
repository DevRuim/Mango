-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/07/2025 às 07:41
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mango`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `idUsuario` int(11) DEFAULT NULL,
  `idManga` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mangas`
--

CREATE TABLE `mangas` (
  `idManga` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nomeManga` varchar(150) NOT NULL,
  `editora` varchar(30) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `volume` float NOT NULL,
  `classificacao_etaria` varchar(20) NOT NULL,
  `ano_publicacao` date NOT NULL,
  `encadernacao` varchar(20) NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT 1,
  `valor` float NOT NULL,
  `estoque` int(11) NOT NULL,
  `descricaoManga` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mangas`
--

INSERT INTO `mangas` (`idManga`, `foto`, `nomeManga`, `editora`, `autor`, `volume`, `classificacao_etaria`, `ano_publicacao`, `encadernacao`, `disponivel`, `valor`, `estoque`, `descricaoManga`) VALUES
(1, 'img/jujutsu kaisen.png', 'Jujutsu Kaisen', 'Panini', 'Gege Akutami', 21, '16', '2022-12-02', 'perfeita', 1, 45, 9, 'Hakari e Panda entram na Colônia 2 de Tóquio em busca de Kashimo. Separados, Hakari enfrenta Charles, um mangaká peculiar, enquanto Panda cai frente ao poderoso Kashimo.'),
(3, 'img/tokyo.webp', 'Tokyo Ghoul', 'Panini', 'Sui Ishida', 13, '18', '2014-08-20', 'capa dura', 1, 60, 7, 'Kaneki, agora mais determinado, confronta Yamori de novo, enquanto a Aogiri Tree se movimenta pelas sombras. Touka enfrenta seus próprios conflitos internos sobre Kaneki e o futuro dos ghouls. A operação do CCG culmina em um grande cerco ao café Anteiku, forçando Yoshimura a revelar seu passado.'),
(6, 'img/blue period.png', 'Blue Period', 'Panini', 'Tsubasa Yamaguchi', 16, '16', '2025-09-11', 'perfeita', 1, 45, 19, ' Yatora encara as pressões intensas do segundo ano na universidade de artes.\nEle precisa conciliar a criação de obras cada vez mais ousadas com a cobrança dos professores e suas próprias inseguranças.\nEnquanto busca um propósito mais profundo para sua arte, Yatora também se confronta com questões pessoais e o medo do fracasso.'),
(8, 'img/Blue_Lock_vol1.jpg', 'Blue Lock', 'Kodansha', 'Muneyuki Kaneshiro e Yusuke No', 1, '14', '2023-06-16', 'capa dura', 1, 40, 10, 'Isagi Yoichi joga pelo Bastard München na Alemanha. Ele enfrenta a pressão de evoluir para competir com Rin e Kaiser, ao mesmo tempo em que busca seu “próximo nível” para se tornar o maior atacante do mundo. As partidas se intensificam com estratégias inovadoras, colocando o intelecto e instinto dos jogadores à prova. Isagi começa a explorar novas dimensões do seu jogo, incluindo a percepção espacial e leitura de jogadas. A rivalidade entre talentos explode em campo, prometendo transformar o fut'),
(9, 'img/DemonSlayervol1.jpg', 'Demon Slayer', 'Panini', 'Koyoharu Gotouge', 1, '14', '2016-06-16', 'perfeita', 1, 15, 2, 'Tanjiro Kamado é um jovem bondoso que vive com sua família nas montanhas, vendendo carvão. Um dia, ao voltar para casa, encontra todos brutalmente assassinados por demônios, exceto sua irmã Nezuko, que foi transformada em um deles. Desesperado para salvá-la, Tanjiro decide se tornar um caçador de demônios. Ele inicia um árduo treinamento sob a tutela de Sakonji Urokodaki. Essa jornada marca o início de sua busca por vingança e cura.'),
(10, 'img/fullmetal.jpg', 'Fullmetal Alchemist', 'JBC', 'Hiromu Arakawa', 1, '14', '2002-01-22', 'perfeita', 1, 32, 15, 'No primeiro volume conhecemos Edward e Alphonse Elric, dois irmãos alquimistas que tentaram ressuscitar sua mãe usando alquimia proibida. O experimento fracassou terrivelmente: Edward perdeu um braço e uma perna, e Alphonse teve o corpo inteiro tomado, restando apenas sua alma presa a uma armadura. Agora eles partem em uma jornada em busca da Pedra Filosofal, um artefato lendário que poderia restaurar seus corpos. Durante essa busca, eles enfrentam militares, outros alquimistas e descobrem consp'),
(11, 'img/chainsawman.jpg', 'Chainsaw man', 'Panini Comics', 'Tatsuki Fujimoto', 1, '16', '2019-03-04', 'capa dura', 1, 36, 22, 'O jovem Denji vive endividado por conta do falecido pai e trabalha para a Yakuza caçando demônios, com a ajuda de seu companheiro motosserra, Pochita. Após ser traído e brutalmente assassinado pela máfia, Denji faz um pacto com Pochita, renascendo como o híbrido demoníaco Chainsaw Man. Ele é encontrado por Makima, uma misteriosa agente do setor público de caça a demônios, que o recruta. Agora Denji entra em um mundo violento e cheio de monstros, sonhando com coisas simples como comer pão com gel'),
(12, 'img/onepiece.jpg', 'One Piece', 'Panini', 'Eiichiro Oda', 57, '14', '2010-03-04', 'perfeita', 1, 40, 5, 'A guerra em Marineford explode em escala total quando Barba Branca invade a base da Marinha para salvar Ace. Luffy chega ao campo de batalha ao lado dos prisioneiros do Impel Down, decidido a resgatar seu irmão. Enquanto isso, os almirantes, Shichibukais e oficiais da Marinha mostram toda sua força contra os piratas. Ace enfrenta seu destino enquanto segredos sobre o lendário Gol D. Roger e Barba Branca vêm à tona. O volume termina com o campo de batalha mergulhado em caos e incertezas.'),
(13, 'img/hunterxhunter.jpg', 'Hunter x Hunter', 'JBC', 'Yoshihiro Togashi', 34, '14', '2017-07-26', 'capa dura', 1, 34, 11, 'O volume 34 dá sequência à viagem do navio rumo ao Continente Negro, focando no brutal jogo de sucessão do trono de Kakin. Kurapika intensifica sua estratégia para proteger o príncipe Woble, enquanto conspirações e assassinatos se espalham pelos andares do navio. O príncipe Tserriednich revela habilidades assustadoras e seu potencial como usuário de Nen. Paralelamente, Leorio e outros Hunters se mobilizam para lidar com as ameaças. A tensão cresce, prometendo grandes confrontos no perigoso tabul');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idManga` int(11) NOT NULL,
  `DataPedido` date NOT NULL,
  `Valor` float NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `idManga`, `DataPedido`, `Valor`, `quantidade`) VALUES
(28, 2, 1, '2025-07-06', 45, 1),
(29, 2, 2, '2025-07-06', 72, 2),
(30, 2, 3, '2025-07-06', 180, 3),
(31, 2, 6, '2025-07-07', 45, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `tipoUsuario` varchar(15) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `telefone` char(15) NOT NULL,
  `preferencias` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tipoUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `telefone`, `preferencias`) VALUES
(1, 'administrador', 'Vinicius Lopes Camargo', 'camargovinicius16@gmail.com', '9f3afe1c39283f4130e3cbbc61359fa2', '(42) 98408-6395', ''),
(2, 'cliente', 'teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', '(44) 44444-4444', ''),
(14, 'cliente', 'a', 'a@gmail.com', '202cb962ac59075b964b07152d234b70', '(22) 22222-2222', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`idManga`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mangas`
--
ALTER TABLE `mangas`
  MODIFY `idManga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
