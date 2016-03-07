-- phpMyAdmin SQL Dump
-- version 4.4.2
-- http://www.phpmyadmin.net
--
-- Počítač: hz-mysql4
-- Vytvořeno: Stř 10. úno 2016, 23:31
-- Verze serveru: 5.5.47-MariaDB
-- Verze PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `mysql69894`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` text NOT NULL,
  `pin` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `category`, `pin`, `publish`) VALUES
(1, 'Kontakt', '<p style="text-align: center;"><span style="font-size: 18pt;">Mateřsk&aacute; &scaron;kola, Fr&aacute;ni &Scaron;r&aacute;mka 2620,Teplice</span></p>\n<table style="width: 100%; margin: 0px auto; border-color: #c9c9c9;" border="2" cellpadding="10px">\n<tbody>\n<tr style="height: 14px;">\n<td style="width: 100%; height: 14px;" colspan="4">&nbsp;<span style="font-size: 12pt;">&nbsp;</span><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px; text-align: left;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Adresa mateřsk&eacute; &scaron;koly:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2">\n<div><span style="font-size: 12pt;">Mateřsk&aacute; &scaron;kola</span></div>\n</td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">Fr&aacute;ni &Scaron;r&aacute;mka 2620</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">41501 Teplice</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Ředitelka mateřsk&eacute; &scaron;koly:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">Bc. Irena Sl&aacute;mov&aacute;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 14px;">\n<td style="width: 7%; height: 14px;">&nbsp;</td>\n<td style="width: 41%; height: 14px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Telefon do mateřsk&eacute; &scaron;koly:</span></td>\n<td style="width: 52%; height: 14px;" colspan="2"><span style="font-size: 12pt;">417575744 na ředitelku, &scaron;koln&iacute; j&iacute;delnu</span></td>\n</tr>\n<tr style="height: 14px;">\n<td style="width: 7%; height: 14px;">&nbsp;</td>\n<td style="width: 41%; height: 14px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 14px;" colspan="2"><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Telefon na jednotliv&eacute; tř&iacute;dy:</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du A -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 537 482 do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du B -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 532 999&nbsp;do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du C -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417&nbsp;533 303 <strong>do 16.30</strong></span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du D -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 532 844&nbsp; do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du E -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 535 877 do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du F -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 532 412 do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">na tř&iacute;du G -</span></td>\n<td style="width: 41.7903%; height: 13px;"><span style="font-size: 12pt;">417 537 392 do 15.30</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 10.2097%; height: 13px;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 41.7903%; height: 13px;">&nbsp;</td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Mobiln&iacute; telefon:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">776813220</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">E-mailov&aacute; adresa:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;"><a href="mailto:ms.f.sramka@seznam.cz">ms.f.sramka@seznam.cz</a></span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Internetov&aacute;&nbsp;adresa:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;"><a href="http://www.msfsramka.benjamin.cz/">www.msfsramka.benjamin.cz</a></span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">Telefon do &scaron;koln&iacute; j&iacute;delny:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">417575744 p&iacute;. Blanka Buchbauerov&aacute;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&Uacute;čet mateřsk&eacute; &scaron;koly:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">742170287/0100 Komerčn&iacute; banka Teplice</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">&nbsp;</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">&nbsp;</span></td>\n</tr>\n<tr style="height: 13px;">\n<td style="width: 7%; height: 13px;">&nbsp;</td>\n<td style="width: 41%; height: 13px; padding-right: 20px; text-align: right;"><span style="font-size: 12pt;">IČO&nbsp;organizace:</span></td>\n<td style="width: 52%; height: 13px;" colspan="2"><span style="font-size: 12pt;">63788110</span></td>\n</tr>\n</tbody>\n</table>\n<p style="text-align: center;"><span style="font-size: 14pt;">&nbsp;</span></p>\n<p style="text-align: center;"><iframe style="width: 100%; border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10120.702582853135!2d13.8521938!3d50.642429!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbfa40a58d17d63e9!2zTWF0ZcWZc2vDoSDFoWtvbGE!5e0!3m2!1scs!2scz!4v1454318046491" width="600" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', '2016-02-01 08:30:53', 'Ostatni', 0, 0),
(2, 'O nás', '<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;<font size="2">Mateřsk&aacute; &scaron;kola zah&aacute;jila provoz v roce 1972. Zřizovatelem&nbsp; je Statut&aacute;rn&iacute; město Teplice, od roku 1996 je &scaron;kola samostan&yacute;m pr&aacute;vn&iacute;m subjektem.&nbsp;&nbsp; Nach&aacute;z&iacute; se v oblasti Teplice - &Scaron;anov. V&yacute;hodn&eacute; um&iacute;stěn&iacute; nedaleko Doubravsk&eacute;ho lesa s horou Doubravkou, tře&scaron;ňov&eacute;ho sadu a P&iacute;sečn&eacute;ho vrchu umožňuje využit&iacute; př&iacute;rodn&iacute;ho ter&eacute;nu pro děti. M&aacute; v&yacute;bornou dostupnost pě&scaron;ky i městskou hromadnou dopravou. Mateřskou &scaron;kolu přev&aacute;žně nav&scaron;těvuj&iacute; děti ze s&iacute;dli&scaron;ť Trnovansk&aacute;, Sochorova a Doubravick&aacute;. Are&aacute;l mateřsk&eacute; &scaron;koly tvoř&iacute; komplex 8 pavilonů, kter&eacute; spojuje kryt&yacute; chodn&iacute;k. Hospod&aacute;řsk&yacute; pavilon, kde je &scaron;koln&iacute; j&iacute;delna, pr&aacute;delna, mandlovna, sklady a kancel&aacute;ře, se nach&aacute;z&iacute; mezi dvěma řadami na sebe přil&eacute;haj&iacute;c&iacute;ch pavilonů. V&nbsp;sedmi pavilonech jsou um&iacute;stěny děti do tř&iacute;d. Každ&yacute; pavilon je rozdělen na hernu - ložnici, tř&iacute;du , hern&iacute; koutky, &scaron;atnu, soci&aacute;ln&iacute; zař&iacute;zen&iacute;, kabinet a kuchyňku. Ke každ&eacute;mu pavilonu n&aacute;lež&iacute; zahrada se zahradn&iacute;m vybaven&iacute;m a terasou. Souč&aacute;st&iacute; are&aacute;lu je i parkovi&scaron;tě př&iacute;stupn&eacute; z ulice Fr&aacute;ni &Scaron;r&aacute;mka. Současn&aacute; kapacita mateřsk&eacute; &scaron;koly&nbsp;je 175 dět&iacute;, kapacita &scaron;koln&iacute; j&iacute;delny je&nbsp;200 str&aacute;vn&iacute;ků.</font></p>', '2015-12-30 15:30:13', 'Ostatni', 0, 0),
(4, 'Program školky', '<p>Program mateřsk&eacute; &scaron;koly vych&aacute;z&iacute; z&nbsp;R&aacute;mcov&eacute;ho vzděl&aacute;vac&iacute;ho programu pro před&scaron;koln&iacute; vzděl&aacute;v&aacute;n&iacute;.V n&aacute;vaznosti na obecn&eacute; c&iacute;le vzděl&aacute;v&aacute;n&iacute; formulovan&eacute; ve &scaron;kolsk&eacute;m z&aacute;koně jsou hlavn&iacute;mi c&iacute;li před&scaron;koln&iacute;ho vzděl&aacute;v&aacute;n&iacute; :</p>\n<ul>\n<li><strong><strong>Rozv&iacute;jen&iacute; d&iacute;těte , jeho&nbsp;učen&iacute; a pozn&aacute;n&iacute;</strong></strong></li>\n<li><strong><strong><strong>Osvojen&iacute; si z&aacute;kladů hodnot, na nichž je založena na&scaron;e společnost</strong></strong></strong></li>\n<li><strong>Z&iacute;sk&aacute;n&iacute; osobn&iacute; samostatnosti a schopnosti projevovat se jako samostatn&aacute; osobnost působ&iacute;c&iacute; na sv&eacute; okol&iacute;</strong></li>\n</ul>\n<p><strong>Z&aacute;sady &scaron;koln&iacute;ho vzděl&aacute;vac&iacute;ho programu :</strong></p>\n<ul>\n<li><strong>D&iacute;tě se sv&yacute;mi z&aacute;jmy a přirozen&yacute;mi potřebami stoj&iacute; ve středu z&aacute;jmu v&scaron;ech.</strong></li>\n<li><strong>Prospěch d&iacute;těte je rozhoduj&iacute;c&iacute; a to bez ohledu na n&aacute;ročnost pr&aacute;ce pedagogů a ostatn&iacute;ch dospěl&yacute;ch.</strong></li>\n<li><strong>D&iacute;tě se mus&iacute; c&iacute;tit v&nbsp;bezpeč&iacute;.</strong></li>\n<li><strong>D&iacute;tě z&iacute;sk&aacute;v&aacute; z&aacute;klady pro zdrav&eacute; sebevědom&iacute;, důvěru ve vlastn&iacute; s&iacute;lu a schopnosti, prosoci&aacute;ln&iacute; postoje, vstř&iacute;cn&yacute; a otevřen&yacute; vztah ke společnosti i ke světu formou prožitkov&eacute;ho učen&iacute;.</strong></li>\n<li><strong>D&iacute;tě se uč&iacute; t&iacute;m, co samo děl&aacute;, co samo zkus&iacute; a v&nbsp;čem se aktivně uplatn&iacute;.</strong></li>\n<li><strong>Vzděl&aacute;v&aacute;n&iacute; d&iacute;těte prob&iacute;h&aacute; nepřetržitě za v&scaron;ech situac&iacute; a okolnost&iacute;.</strong></li>\n<li><strong>D&iacute;tě vn&iacute;m&aacute; chov&aacute;n&iacute; okol&iacute; a je ovlivňov&aacute;no v&scaron;&iacute;m, čeho se v&nbsp;M&Scaron; &uacute;častn&iacute;, co prož&iacute;v&aacute; a co se v&nbsp;jeho okol&iacute; děje</strong></li>\n<li><strong>Každ&eacute; d&iacute;tě m&aacute; pr&aacute;vo se projevovat jako jedinečn&aacute; osobnost, rozv&iacute;jet se , učit se v&nbsp;rozsahu sv&yacute;ch individu&aacute;ln&iacute;ch potřeb a postupovat sv&yacute;m tempem</strong></li>\n<li><strong>Př&iacute;prava na &scaron;kolu je přirozenou a samozřejmou souč&aacute;st&iacute; pr&aacute;ce M&Scaron;</strong></li>\n<li><strong>Každ&eacute;mu d&iacute;těti by měly b&yacute;t v&nbsp;průběhu před&scaron;koln&iacute;ho vzděl&aacute;v&aacute;n&iacute; vytv&aacute;řeny takov&eacute; vzděl&aacute;vac&iacute; podm&iacute;nky, aby postupně dostatečně rozv&iacute;jelo svůj v&scaron;estrann&yacute; potenci&aacute;l a&nbsp;aby v&nbsp;době, kdy opou&scaron;t&iacute; M&Scaron; dos&aacute;hlo &uacute;rovně rozvoje a v&yacute;sledků učen&iacute;, kter&eacute; optim&aacute;lně odpov&iacute;daj&iacute; jeho osobnostn&iacute;m schopnostem a možnostem.</strong></li>\n</ul>\n<p><strong>&Scaron;koln&iacute; vzděl&aacute;vac&iacute; program Uč&iacute;me se navz&aacute;jem je koncipov&aacute;n do těchto bloků :</strong></p>\n<p>&nbsp;</p>\n<p><strong>Z&aacute;ř&iacute;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\n<p>a tak&eacute; o tom, kdo je n&aacute;&scaron; kamar&aacute;d, co je domov, &scaron;kolka,&nbsp; jak se m&aacute;me chovat, kdo se o n&aacute;s star&aacute;</p>\n<p>&nbsp;</p>\n<p><strong>Ř&iacute;jen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\n<p>a tak&eacute; o tom, jak se př&iacute;roda měn&iacute;, co n&aacute;m d&aacute;v&aacute;, jak se k&nbsp;n&iacute; chov&aacute;m</p>\n<p>&nbsp;</p>\n<p><strong>Listopad&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\n<p>a tak&eacute; o tom, jak se člověk domluv&iacute; s druh&yacute;m</p>\n<p>&nbsp;</p>\n<p><strong>Prosinec</strong></p>\n<p>a tak&eacute; o tom, jak um&iacute;m druh&eacute;mu udělat radost</p>\n<p>&nbsp;</p>\n<p><strong>Leden</strong></p>\n<p>a tak&eacute; o tom, jak se v&scaron;ichni připravujeme do &scaron;koly</p>\n<p>&nbsp;</p>\n<p><strong>&Uacute;nor</strong></p>\n<p>&nbsp;a tak&eacute; o tom co mi &scaron;kod&iacute; a co mi prosp&iacute;v&aacute;</p>\n<p>&nbsp;</p>\n<p><strong>Březen</strong></p>\n<p>a tak&eacute; o tom, jak&nbsp;cestujeme kř&iacute;žem kr&aacute;žem cel&yacute;m světem</p>\n<p>&nbsp;</p>\n<p><strong>Duben</strong></p>\n<p>a tak&eacute; o tom, jak ct&iacute;m česk&eacute; tradice</p>\n<p>&nbsp;</p>\n<p><strong>Květen</strong></p>\n<p>a tak&eacute; o tom co se d&aacute; v&scaron;echno objevit, vyzkou&scaron;et,pozorovat a t&iacute;m se &nbsp;učit</p>\n<p>&nbsp;</p>\n<p><strong>Červen</strong></p>\n<p>a tak&eacute; o tom &nbsp;co už v&scaron;echno um&iacute;me</p>', '2015-12-30 17:11:31', 'Ostatni', 1, 1),
(5, 'Jídelní lístek', 'text', '2016-02-10 22:25:24', 'Ostatni', 0, 0),
(6, 'Nabídka dne', 'text', '2016-02-10 22:26:25', 'Ostatni', 0, 0),
(10, 'Docházka v pondělí 16.listopadu', '<p>Ž&aacute;d&aacute;me rodiče, aby z&aacute;vazně nahl&aacute;sili na tř&iacute;d&aacute;ch doch&aacute;zku d&iacute;těte v ponděl&iacute; 16. listopadu. Druh&yacute; den 17.listopadu je st&aacute;tn&iacute; sv&aacute;tek.</p>', '2015-12-30 15:30:13', 'Aktuality', 1, 1),
(11, 'Návštěva u hasičů', '<p>V ponděl&iacute; 23.11. jdou na n&aacute;v&scaron;těvu k hasičům tř&iacute;dy B,E,F,G. V &uacute;ter&yacute; 24.11. jsou tř&iacute;dy A,C,D. Program je dopoledn&iacute;. Děti se sezn&aacute;m&iacute; s prostřed&iacute;m stanice, shl&eacute;dnou hasičskou techniku při pr&aacute;ci, podiskutuj&iacute; s hasiči.</p>', '2015-12-30 15:30:13', 'Novinky', 1, 1),
(12, 'Rodičovská poradna', '<p>klub rodičů</p>', '2016-02-01 14:02:21', 'Klub', 0, 1),
(14, 'Fotografování dětí - 3.listopadu', '<p>V &uacute;ter&yacute; dopoledne se budou děti fotografovat . V&aacute;nočn&iacute; soubor v ceně 250,- Kč včetně stoln&iacute;ho kalend&aacute;ře zaplat&iacute;te až po prohl&eacute;dnut&iacute; fotografii&iacute;. Učitelk&aacute;m na tř&iacute;d&aacute;ch nahlaste, jestli m&aacute;te či nem&aacute;te o fotografov&aacute;n&iacute; z&aacute;jem.</p>', '2015-12-30 17:11:31', 'Novinky', 1, 1),
(15, 'Aktualita z novinky', '<p>Testovac&iacute; novinka - nyn&iacute;&nbsp;aktualita</p>', '2016-02-01 15:46:10', 'Aktuality', 1, 1),
(16, 'Nový clanek klubu', '<p>Top test</p>', '2016-02-01 16:04:36', 'Klub', 1, 1),
(17, 'novy na webu', '<p>test</p>', '2016-02-02 12:33:56', 'Novinky', 1, 1),
(18, 'asdasdsad', '<p>asdasdads</p>', '2016-02-06 16:31:26', 'Novinky', 0, 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
