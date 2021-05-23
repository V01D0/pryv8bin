-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2021 at 04:40 PM
-- Server version: 10.3.29-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pryv8bin`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL COMMENT 'reset+verification hash',
  `key` varchar(21) DEFAULT NULL COMMENT 'API key'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `langcodes`
--

CREATE TABLE `langcodes` (
  `id` int(11) NOT NULL,
  `language` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `langcodes`
--

INSERT INTO `langcodes` (`id`, `language`) VALUES
(1, 'apl'),
(2, 'asciiarmor'),
(3, 'asn'),
(4, 'asterisk'),
(5, 'brainfuck'),
(6, 'clike'),
(7, 'clojure'),
(8, 'cmake'),
(9, 'cobol'),
(10, 'coffeescript'),
(11, 'commonlisp'),
(12, 'crystal'),
(13, 'css'),
(14, 'cypher'),
(15, 'd'),
(16, 'dart'),
(17, 'diff'),
(18, 'django'),
(19, 'dockerfile'),
(20, 'dtd'),
(21, 'dylan'),
(22, 'ebnf'),
(23, 'ecl'),
(24, 'eiffel'),
(25, 'elm'),
(26, 'erlang'),
(27, 'factor'),
(28, 'fcl'),
(29, 'forth'),
(30, 'fortran'),
(31, 'gas'),
(32, 'gfm'),
(33, 'gherkin'),
(34, 'go'),
(35, 'groovy'),
(36, 'haml'),
(37, 'handlebars'),
(38, 'haskell'),
(39, 'haskell-literate'),
(40, 'haxe'),
(41, 'htmlembedded'),
(42, 'htmlmixed'),
(43, 'http'),
(44, 'idl'),
(45, 'javascript'),
(46, 'jinja2'),
(47, 'jsx'),
(48, 'julia'),
(49, 'livescript'),
(50, 'lua'),
(51, 'markdown'),
(52, 'mathematica'),
(53, 'mbox'),
(54, 'mirc'),
(55, 'mllike'),
(56, 'modelica'),
(57, 'mscgen'),
(58, 'mumps'),
(59, 'nginx'),
(60, 'nsis'),
(61, 'ntriples'),
(62, 'octave'),
(63, 'oz'),
(64, 'pascal'),
(65, 'pegjs'),
(66, 'perl'),
(67, 'php'),
(68, 'pig'),
(69, 'powershell'),
(70, 'properties'),
(71, 'protobuf'),
(72, 'pug'),
(73, 'puppet'),
(74, 'python'),
(75, 'q'),
(76, 'r'),
(77, 'rpm'),
(78, 'rst'),
(79, 'ruby'),
(80, 'rust'),
(81, 'sas'),
(82, 'sass'),
(83, 'scheme'),
(84, 'shell'),
(85, 'sieve'),
(86, 'slim'),
(87, 'smalltalk'),
(88, 'smarty'),
(89, 'solr'),
(90, 'soy'),
(91, 'sparql'),
(92, 'spreadsheet'),
(93, 'sql'),
(94, 'stex'),
(95, 'stylus'),
(96, 'swift'),
(97, 'tcl'),
(98, 'textile'),
(99, 'tiddlywiki'),
(100, 'tiki'),
(101, 'toml'),
(102, 'tornado'),
(103, 'troff'),
(104, 'ttcn'),
(105, 'ttcn-cfg'),
(106, 'turtle'),
(107, 'twig'),
(108, 'vb'),
(109, 'vbscript'),
(110, 'velocity'),
(111, 'verilog'),
(112, 'vhdl'),
(113, 'vue'),
(114, 'wast'),
(115, 'webidl'),
(116, 'xml'),
(117, 'xquery'),
(118, 'yacas'),
(119, 'yaml'),
(120, 'yaml-frontmatter'),
(121, 'z80'),
(122, NULL),
(123, 'apl'),
(124, 'asciiarmor'),
(125, 'asn'),
(126, 'asterisk'),
(127, 'brainfuck'),
(128, 'clike'),
(129, 'clojure'),
(130, 'cmake'),
(131, 'cobol'),
(132, 'coffeescript'),
(133, 'commonlisp'),
(134, 'crystal'),
(135, 'css'),
(136, 'cypher'),
(137, 'd'),
(138, 'dart'),
(139, 'diff'),
(140, 'django'),
(141, 'dockerfile'),
(142, 'dtd'),
(143, 'dylan'),
(144, 'ebnf'),
(145, 'ecl'),
(146, 'eiffel'),
(147, 'elm'),
(148, 'erlang'),
(149, 'factor'),
(150, 'fcl'),
(151, 'forth'),
(152, 'fortran'),
(153, 'gas'),
(154, 'gfm'),
(155, 'gherkin'),
(156, 'go'),
(157, 'groovy'),
(158, 'haml'),
(159, 'handlebars'),
(160, 'haskell'),
(161, 'haskell-literate'),
(162, 'haxe'),
(163, 'htmlembedded'),
(164, 'htmlmixed'),
(165, 'http'),
(166, 'idl'),
(167, 'javascript'),
(168, 'jinja2'),
(169, 'jsx'),
(170, 'julia'),
(171, 'livescript'),
(172, 'lua'),
(173, 'markdown'),
(174, 'mathematica'),
(175, 'mbox'),
(176, 'mirc'),
(177, 'mllike'),
(178, 'modelica'),
(179, 'mscgen'),
(180, 'mumps'),
(181, 'nginx'),
(182, 'nsis'),
(183, 'ntriples'),
(184, 'octave'),
(185, 'oz'),
(186, 'pascal'),
(187, 'pegjs'),
(188, 'perl'),
(189, 'php'),
(190, 'pig'),
(191, 'powershell'),
(192, 'properties'),
(193, 'protobuf'),
(194, 'pug'),
(195, 'puppet'),
(196, 'python'),
(197, 'q'),
(198, 'r'),
(199, 'rpm'),
(200, 'rst'),
(201, 'ruby'),
(202, 'rust'),
(203, 'sas'),
(204, 'sass'),
(205, 'scheme'),
(206, 'shell'),
(207, 'sieve'),
(208, 'slim'),
(209, 'smalltalk'),
(210, 'smarty'),
(211, 'solr'),
(212, 'soy'),
(213, 'sparql'),
(214, 'spreadsheet'),
(215, 'sql'),
(216, 'stex'),
(217, 'stylus'),
(218, 'swift'),
(219, 'tcl'),
(220, 'textile'),
(221, 'tiddlywiki'),
(222, 'tiki'),
(223, 'toml'),
(224, 'tornado'),
(225, 'troff'),
(226, 'ttcn'),
(227, 'ttcn-cfg'),
(228, 'turtle'),
(229, 'twig'),
(230, 'vb'),
(231, 'vbscript'),
(232, 'velocity'),
(233, 'verilog'),
(234, 'vhdl'),
(235, 'vue'),
(236, 'wast'),
(237, 'webidl'),
(238, 'xml'),
(239, 'xquery'),
(240, 'yacas'),
(241, 'yaml'),
(242, 'yaml-frontmatter'),
(243, 'z80');

-- --------------------------------------------------------

--
-- Table structure for table `lostpass`
--

CREATE TABLE `lostpass` (
  `uid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `when` datetime NOT NULL,
  `IP` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pastes`
--

CREATE TABLE `pastes` (
  `uid` int(11) NOT NULL COMMENT 'uid (from auth table)',
  `link` varchar(255) NOT NULL,
  `paste` text NOT NULL COMMENT 'paste string to 1k',
  `langcode` int(11) NOT NULL DEFAULT 122,
  `expiry` datetime DEFAULT NULL COMMENT 'paste expiry date',
  `burn` tinyint(1) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT 'paste title',
  `password` varchar(255) DEFAULT NULL COMMENT 'password, if any (for the paste)',
  `views` int(11) NOT NULL COMMENT 'number of views',
  `large` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `langcodes`
--
ALTER TABLE `langcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lostpass`
--
ALTER TABLE `lostpass`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `pastes`
--
ALTER TABLE `pastes`
  ADD KEY `language` (`langcode`);
ALTER TABLE `pastes` ADD FULLTEXT KEY `paste` (`paste`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `langcodes`
--
ALTER TABLE `langcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `lostpass`
--
ALTER TABLE `lostpass`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
