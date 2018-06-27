-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-26 16:40:51
-- 服务器版本： 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selection`
--

-- --------------------------------------------------------

--
-- 表的结构 `candidature`
--

CREATE TABLE `candidature` (
  `id` int(11) NOT NULL,
  `introduction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `candidature`
--

INSERT INTO `candidature` (`id`, `introduction`, `title`) VALUES
(6, 'Les Avengers et leurs alliés devront être prêts à tout sacrifier pour neutraliser le redoutable Thanos avant que son attaque éclair ne conduise à la destruction complète de l’univers.', 'Avengers Infinity War'),
(7, '2045. Le monde est au bord du chaos. Les êtres humains se réfugient dans l\'OASIS, univers virtuel mis au point par le brillant et excentrique James Halliday. Avant de disparaître, celui-ci a décidé de léguer son immense fortune à quiconque découvrira l\'œu', 'Ready Player One'),
(8, 'Allemagne de l\'est, 1956. Kurt, Theo et Lena ont 18 ans et s\'apprêtent à passer le bac. Avec leurs camarades, ils décident de faire une minute de silence en classe, en hommage aux révolutionnaires hongrois durement réprimés par l\'armée soviétique. Cette m', 'La Révolution silencieuse'),
(9, 'En raison d’une épidémie de grippe canine, le maire de Megasaki ordonne la mise en quarantaine de tous les chiens de la ville, envoyés sur une île qui devient alors l’Ile aux Chiens. Le jeune Atari, 12 ans, vole un avion et se rend sur l’île pour recherch', 'Lile aux chiens'),
(10, 'Jocelyn, homme d\'affaire en pleine réussite, est un dragueur et un menteur invétéré. Lassé d\'être lui-même, il se retrouve malgré lui à séduire une jeune et jolie femme en se faisant passer pour un handicapé. Jusqu\'au jour où elle lui présente sa sœur ell', 'Tout le Monde Debout'),
(11, 'Croc-Blanc est un fier et courageux chien-loup. Après avoir grandi dans les espaces enneigés et hostiles du Grand Nord, il est recueilli par Castor Gris et sa tribu indienne. Mais la méchanceté des hommes oblige Castor-Gris à céder l’animal à un homme cru', 'Croc-Blanc'),
(12, 'Padmavati, reine de Mewar au début du 14ème siècle, était connue bien sûr pour sa beauté, mais surtout pour son courage face à l’envahisseur qui assiégeait son royaume. Padmaavat est la légende de cette reine pour qui l\'honneur était au dessus de tout.', 'Padmaavat'),
(13, 'Suite au décès de sa tante, Pauline et ses deux filles héritent d’une maison. Mais dès la première nuit, des meurtriers pénètrent dans la demeure et Pauline doit se battre pour sauver ses filles. Un drame qui va traumatiser toute la famille mais surtout a', 'Ghostland'),
(14, 'Après les événements qui se sont déroulés dans Captain America : Civil War, T’Challa revient chez lui prendre sa place sur le trône du Wakanda, une nation africaine technologiquement très avancée. Mais lorsqu’un vieil ennemi resurgit, le courage de T’Chal', 'Black Panther'),
(15, 'Toute la famille Verdi est aux petits soins pour s’occuper de Roland, le grand-père, qui perd un peu la boule ces derniers temps. Tous sauf JB, l\'ado de la famille, qui n\'a qu\'un seul but :  monter à Paris pour disputer sa finale de basket. Mais ses paren', 'La Finale');

-- --------------------------------------------------------

--
-- 表的结构 `candidature_note`
--

CREATE TABLE `candidature_note` (
  `id` int(11) NOT NULL,
  `candidature` int(11) DEFAULT NULL,
  `noteGlobal` int(11) NOT NULL,
  `noteNumber` int(11) NOT NULL,
  `noteAvg` double NOT NULL,
  `noteNb5` int(11) NOT NULL,
  `noteNb4` int(11) NOT NULL,
  `noteNb3` int(11) NOT NULL,
  `noteNb2` int(11) NOT NULL,
  `noteNb1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `candidature_note`
--

INSERT INTO `candidature_note` (`id`, `candidature`, `noteGlobal`, `noteNumber`, `noteAvg`, `noteNb5`, `noteNb4`, `noteNb3`, `noteNb2`, `noteNb1`) VALUES
(1, 6, 6, 2, 3, 0, 0, 2, 0, 0),
(2, 7, 8, 2, 4, 1, 0, 1, 0, 0),
(3, 8, 12, 3, 4, 1, 1, 1, 0, 0),
(4, 9, 13, 3, 4.3333333333333, 2, 0, 1, 0, 0),
(5, 10, 9, 2, 4.5, 1, 1, 0, 0, 0),
(6, 11, 12, 3, 4, 1, 1, 1, 0, 0),
(7, 12, 3, 1, 3, 0, 0, 1, 0, 0),
(8, 13, 8, 2, 4, 0, 2, 0, 0, 0),
(9, 14, 15, 3, 5, 3, 0, 0, 0, 0),
(10, 15, 3, 1, 3, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse_mail`, `pseudo`, `mot_de_passe`) VALUES
(1, 'LIAN', 'WEI', 'shangque_009@163.com', 'SQ', '$2y$13$qf2pdF68rlsfx6aFR6IgY./SYsdJSmeC3QNf8rZibpj1qUjrHUImC'),
(2, '123', '123', '123@com', '123', '$2y$13$muslUm/s0f1EAvnHRTwrdOJHvNqLM5ksmwjsVzOnyBQngdCFk/xvW'),
(3, '111', '111', '111@com', '111', '$2y$13$AmVynIZRQP940.U8WNhcYuisbd6RfnPORFdzsTm7centdzQm6Aj6q'),
(4, '222', '222', '222@com', '222', '$2y$13$jp6jz/RwXc/UyNW5aC1rGuVuBvMQUtRD3sM/NxMC.WnTQrLp1lsKy');

-- --------------------------------------------------------

--
-- 表的结构 `client_vote`
--

CREATE TABLE `client_vote` (
  `id` int(11) NOT NULL,
  `client` int(11) DEFAULT NULL,
  `vote` int(11) DEFAULT NULL,
  `isCreator` tinyint(1) NOT NULL,
  `isParticipant` tinyint(1) NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `client_vote`
--

INSERT INTO `client_vote` (`id`, `client`, `vote`, `isCreator`, `isParticipant`, `creationDate`) VALUES
(1, 1, 2, 1, 1, '2018-06-26 00:00:00'),
(2, 1, 3, 1, 0, '2018-06-26 00:00:00'),
(3, 2, 4, 1, 1, '2018-06-26 00:00:00'),
(4, 2, 5, 1, 0, '2018-06-26 00:00:00'),
(5, 2, 6, 1, 0, '2018-06-26 00:00:00'),
(6, 3, 3, 0, 1, '2018-06-26 00:00:00'),
(7, 4, 5, 0, 1, '2018-06-26 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `candidature` int(11) DEFAULT NULL,
  `isPoster` tinyint(1) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `image`
--

INSERT INTO `image` (`id`, `candidature`, `isPoster`, `url`) VALUES
(1, 6, 1, 'uploads/film_images/Avengers Infinity War/Avengers Infinity War_Poster.jpg'),
(2, 6, 0, 'uploads/film_images/Avengers Infinity War/Avengers Infinity War_0.jpg'),
(3, 7, 1, 'uploads/film_images/Ready Player One/Ready Player One_Poster.jpg'),
(4, 7, 0, 'uploads/film_images/Ready Player One/Ready Player One_0.jpg'),
(5, 7, 0, 'uploads/film_images/Ready Player One/Ready Player One_1.jpg'),
(6, 7, 0, 'uploads/film_images/Ready Player One/Ready Player One_2.jpg'),
(7, 8, 1, 'uploads/film_images/La Révolution silencieuse/La Révolution silencieuse_Poster.jpg'),
(8, 8, 0, 'uploads/film_images/La Révolution silencieuse/La Révolution silencieuse_0.jpg'),
(9, 8, 0, 'uploads/film_images/La Révolution silencieuse/La Révolution silencieuse_1.jpg'),
(10, 8, 0, 'uploads/film_images/La Révolution silencieuse/La Révolution silencieuse_2.jpg'),
(11, 9, 1, 'uploads/film_images/Lile aux chiens/Lile aux chiens_Poster.jpg'),
(12, 9, 0, 'uploads/film_images/Lile aux chiens/Lile aux chiens_0.jpg'),
(13, 9, 0, 'uploads/film_images/Lile aux chiens/Lile aux chiens_1.jpg'),
(14, 9, 0, 'uploads/film_images/Lile aux chiens/Lile aux chiens_2.jpg'),
(15, 10, 1, 'uploads/film_images/Tout le Monde Debout/Tout le Monde Debout_Poster.jpg'),
(16, 10, 0, 'uploads/film_images/Tout le Monde Debout/Tout le Monde Debout_0.jpg'),
(17, 10, 0, 'uploads/film_images/Tout le Monde Debout/Tout le Monde Debout_1.jpg'),
(18, 10, 0, 'uploads/film_images/Tout le Monde Debout/Tout le Monde Debout_2.jpg'),
(19, 11, 1, 'uploads/film_images/Croc-Blanc/Croc-Blanc_Poster.jpg'),
(20, 11, 0, 'uploads/film_images/Croc-Blanc/Croc-Blanc_0.jpg'),
(21, 11, 0, 'uploads/film_images/Croc-Blanc/Croc-Blanc_1.jpg'),
(22, 11, 0, 'uploads/film_images/Croc-Blanc/Croc-Blanc_2.jpg'),
(23, 12, 1, 'uploads/film_images/Padmaavat/Padmaavat_Poster.jpg'),
(24, 12, 0, 'uploads/film_images/Padmaavat/Padmaavat_0.jpg'),
(25, 12, 0, 'uploads/film_images/Padmaavat/Padmaavat_1.jpg'),
(26, 12, 0, 'uploads/film_images/Padmaavat/Padmaavat_2.jpg'),
(27, 13, 1, 'uploads/film_images/Ghostland/Ghostland_Poster.jpg'),
(28, 13, 0, 'uploads/film_images/Ghostland/Ghostland_0.jpg'),
(29, 13, 0, 'uploads/film_images/Ghostland/Ghostland_1.jpg'),
(30, 13, 0, 'uploads/film_images/Ghostland/Ghostland_2.jpg'),
(31, 14, 1, 'uploads/film_images/Black Panther/Black Panther_Poster.jpg'),
(32, 14, 0, 'uploads/film_images/Black Panther/Black Panther_0.jpg'),
(33, 14, 0, 'uploads/film_images/Black Panther/Black Panther_1.jpg'),
(34, 14, 0, 'uploads/film_images/Black Panther/Black Panther_2.jpg'),
(35, 15, 1, 'uploads/film_images/La Finale/La Finale_Poster.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `client` int(11) DEFAULT NULL,
  `candidature` int(11) DEFAULT NULL,
  `vote` int(11) DEFAULT NULL,
  `note` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `note`
--

INSERT INTO `note` (`id`, `client`, `candidature`, `vote`, `note`) VALUES
(1, 1, 9, 2, 5),
(2, 1, 11, 2, 4),
(3, 1, 12, 2, 3),
(4, 1, 14, 2, 5),
(5, 2, 7, 6, 3),
(6, 2, 8, 6, 4),
(7, 2, 11, 6, 3),
(8, 2, 13, 6, 4),
(9, 2, 14, 6, 5),
(10, 2, 15, 6, 3),
(11, 3, 6, 3, 3),
(12, 3, 7, 3, 5),
(13, 3, 8, 3, 3),
(14, 3, 9, 3, 3),
(15, 3, 10, 3, 5),
(16, 3, 11, 3, 5),
(17, 4, 6, 5, 3),
(18, 4, 8, 5, 5),
(19, 4, 9, 5, 5),
(20, 4, 10, 5, 4),
(21, 4, 13, 5, 4),
(22, 4, 14, 5, 5);

-- --------------------------------------------------------

--
-- 表的结构 `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `vote`
--

INSERT INTO `vote` (`id`, `title`, `description`) VALUES
(1, 'titan', 'titan'),
(2, 'Quel le meilleur film?', 'Choisir le film vous péférez'),
(3, 'Film super !!!', 'Le fim que vous préférez.'),
(4, 'Film!!!!!!!!!!!!!!!', 'Film'),
(5, 'Avangers-- le meilleur film?', 'Avangers'),
(6, 'Chaos', 'Chaos');

-- --------------------------------------------------------

--
-- 表的结构 `vote_candidature`
--

CREATE TABLE `vote_candidature` (
  `id` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `candidature` int(11) DEFAULT NULL,
  `noteGlobal` int(11) NOT NULL,
  `noteNumber` int(11) NOT NULL,
  `noteAvg` double NOT NULL,
  `noteNb5` int(11) NOT NULL,
  `noteNb4` int(11) NOT NULL,
  `noteNb3` int(11) NOT NULL,
  `noteNb2` int(11) NOT NULL,
  `noteNb1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `vote_candidature`
--

INSERT INTO `vote_candidature` (`id`, `vote`, `candidature`, `noteGlobal`, `noteNumber`, `noteAvg`, `noteNb5`, `noteNb4`, `noteNb3`, `noteNb2`, `noteNb1`) VALUES
(1, 2, 9, 5, 1, 5, 1, 0, 0, 0, 0),
(2, 2, 11, 4, 1, 4, 0, 1, 0, 0, 0),
(3, 2, 12, 3, 1, 3, 0, 0, 1, 0, 0),
(4, 2, 14, 5, 1, 5, 1, 0, 0, 0, 0),
(5, 3, 6, 3, 1, 3, 0, 0, 1, 0, 0),
(6, 3, 7, 5, 1, 5, 1, 0, 0, 0, 0),
(7, 3, 8, 3, 1, 3, 0, 0, 1, 0, 0),
(8, 3, 9, 3, 1, 3, 0, 0, 1, 0, 0),
(9, 3, 10, 5, 1, 5, 1, 0, 0, 0, 0),
(10, 3, 11, 5, 1, 5, 1, 0, 0, 0, 0),
(11, 4, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 4, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 4, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 4, 11, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 5, 6, 3, 1, 3, 0, 0, 1, 0, 0),
(16, 5, 8, 5, 1, 5, 1, 0, 0, 0, 0),
(17, 5, 9, 5, 1, 5, 1, 0, 0, 0, 0),
(18, 5, 10, 4, 1, 4, 0, 1, 0, 0, 0),
(19, 5, 13, 4, 1, 4, 0, 1, 0, 0, 0),
(20, 5, 14, 5, 1, 5, 1, 0, 0, 0, 0),
(21, 6, 7, 3, 1, 3, 0, 0, 1, 0, 0),
(22, 6, 8, 4, 1, 4, 0, 1, 0, 0, 0),
(23, 6, 11, 3, 1, 3, 0, 0, 1, 0, 0),
(24, 6, 13, 4, 1, 4, 0, 1, 0, 0, 0),
(25, 6, 14, 5, 1, 5, 1, 0, 0, 0, 0),
(26, 6, 15, 3, 1, 3, 0, 0, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidature_note`
--
ALTER TABLE `candidature_note`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DBA375F3E33BD3B8` (`candidature`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_vote`
--
ALTER TABLE `client_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B8C4606C7440455` (`client`),
  ADD KEY `IDX_8B8C46065A108564` (`vote`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045FE33BD3B8` (`candidature`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFBDFA14C7440455` (`client`),
  ADD KEY `IDX_CFBDFA14E33BD3B8` (`candidature`),
  ADD KEY `IDX_CFBDFA145A108564` (`vote`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_candidature`
--
ALTER TABLE `vote_candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_50B6E5EC5A108564` (`vote`),
  ADD KEY `IDX_50B6E5ECE33BD3B8` (`candidature`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `candidature_note`
--
ALTER TABLE `candidature_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `client_vote`
--
ALTER TABLE `client_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用表AUTO_INCREMENT `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `vote_candidature`
--
ALTER TABLE `vote_candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 限制导出的表
--

--
-- 限制表 `candidature_note`
--
ALTER TABLE `candidature_note`
  ADD CONSTRAINT `FK_DBA375F3E33BD3B8` FOREIGN KEY (`candidature`) REFERENCES `candidature` (`id`) ON DELETE CASCADE;

--
-- 限制表 `client_vote`
--
ALTER TABLE `client_vote`
  ADD CONSTRAINT `FK_8B8C46065A108564` FOREIGN KEY (`vote`) REFERENCES `vote` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8B8C4606C7440455` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- 限制表 `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FE33BD3B8` FOREIGN KEY (`candidature`) REFERENCES `candidature` (`id`) ON DELETE CASCADE;

--
-- 限制表 `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_CFBDFA145A108564` FOREIGN KEY (`vote`) REFERENCES `vote` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CFBDFA14C7440455` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CFBDFA14E33BD3B8` FOREIGN KEY (`candidature`) REFERENCES `candidature` (`id`) ON DELETE CASCADE;

--
-- 限制表 `vote_candidature`
--
ALTER TABLE `vote_candidature`
  ADD CONSTRAINT `FK_50B6E5EC5A108564` FOREIGN KEY (`vote`) REFERENCES `vote` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_50B6E5ECE33BD3B8` FOREIGN KEY (`candidature`) REFERENCES `candidature` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
