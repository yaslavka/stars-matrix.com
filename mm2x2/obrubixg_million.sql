-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 01 2022 г., 21:48
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `obrubixg_million`
--

-- --------------------------------------------------------

--
-- Структура таблицы `allussers`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 18:30
--

DROP TABLE IF EXISTS `allussers`;
CREATE TABLE `allussers` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(75) DEFAULT NULL,
  `Address` varchar(175) DEFAULT NULL,
  `City` varchar(75) DEFAULT NULL,
  `State` varchar(75) DEFAULT NULL,
  `Zip` varchar(15) DEFAULT NULL,
  `Country` varchar(75) DEFAULT NULL,
  `Email` varchar(75) DEFAULT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `Password` varchar(75) DEFAULT NULL,
  `active` int(10) UNSIGNED NOT NULL,
  `ref_by` varchar(75) DEFAULT NULL,
  `IP` varchar(25) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `Total` float DEFAULT NULL,
  `Unpaid` float DEFAULT NULL,
  `Paid` float DEFAULT NULL,
  `RDate` datetime DEFAULT NULL,
  `subscribed` int(10) UNSIGNED NOT NULL,
  `banners` int(10) UNSIGNED NOT NULL,
  `bannersused` int(10) UNSIGNED NOT NULL,
  `textads` int(10) UNSIGNED NOT NULL,
  `textadsused` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `allussers`
--

INSERT INTO `allussers` (`ID`, `Name`, `Address`, `City`, `State`, `Zip`, `Country`, `Email`, `Username`, `Password`, `active`, `ref_by`, `IP`, `Date`, `status`, `Total`, `Unpaid`, `Paid`, `RDate`, `subscribed`, `banners`, `bannersused`, `textads`, `textadsused`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, 'test@test.ru', 'test', '123456789', 1, '', '86.102.32.136', '2013-12-16 02:45:39', 1, 0, 0, 0, '2013-12-16 02:45:39', 1, 0, 0, 0, 0),
(2, NULL, NULL, NULL, NULL, NULL, NULL, 'vr.rkkvant@gmail.com', 'kvant', '4308388', 1, '', '176.196.80.74', '2013-12-20 13:50:06', 1, 0, 0, 0, '2013-12-20 13:50:06', 1, 0, 0, 0, 0),
(3, NULL, NULL, NULL, NULL, NULL, NULL, 'collaps2014@mail.ru', 'toshka', 'rbhbkk366332', 1, 'kvant', '95.139.21.23', '2013-12-20 13:59:06', 1, 0, 0, 0, '2013-12-20 13:59:06', 1, 0, 0, 0, 0),
(4, NULL, NULL, NULL, NULL, NULL, NULL, 'molart1@yandex.ru', 'artem', 'artem', 1, '', '85.26.235.213', '2013-12-27 09:22:58', 1, 0, 0, 0, '2013-12-27 09:22:58', 1, 0, 0, 0, 0),
(5, NULL, NULL, NULL, NULL, NULL, NULL, 'obrubinskii@gmail.com', 'admin', '08129391Slav-1', 1, '', '127.0.0.1', '2021-12-14 11:46:35', 2, 20, 5, 15, '2021-12-14 11:46:35', 1, 5, 0, 50, 0),
(6, NULL, NULL, NULL, NULL, NULL, NULL, 'SGUMatrix@gmail.com', 'natak2', '12345678', 1, 'natsliy', '127.0.0.1', '2021-12-14 11:48:36', 2, 15, 15, 0, '2021-12-14 11:48:36', 1, 5, 0, 50, 0),
(7, NULL, NULL, NULL, NULL, NULL, NULL, '12345678', 'sgumatrixz', '12345678', 1, 'natak2', '127.0.0.1', '2021-12-14 11:50:42', 2, 5, 5, 0, '2021-12-14 11:50:42', 1, 5, 0, 50, 0),
(8, NULL, NULL, NULL, NULL, NULL, NULL, '+79779317139', 'nasssn', '12345678', 1, 'sgumatrixz', '127.0.0.1', '2021-12-14 11:51:53', 2, 5, 5, 0, '2021-12-14 11:51:53', 1, 5, 0, 50, 0),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 'fdvdva', 'sfsdafasf', '12345678', 1, 'nasssn', '127.0.0.1', '2021-12-14 11:53:01', 2, 5, 5, 0, '2021-12-14 11:53:01', 1, 5, 0, 50, 0),
(10, NULL, NULL, NULL, NULL, NULL, NULL, 'dgsdsd', 'cdgsg', '12345678', 1, 'sfsdafasf', '127.0.0.1', '2021-12-14 11:54:05', 2, 5, 5, 0, '2021-12-14 11:54:05', 1, 5, 0, 50, 0),
(11, NULL, NULL, NULL, NULL, NULL, NULL, 'sfbsdgsd', 'dsdgsfb', '12345678', 1, 'cdgsg', '127.0.0.1', '2021-12-14 11:54:58', 2, 5, 5, 0, '2021-12-14 11:54:58', 1, 5, 0, 50, 0),
(12, NULL, NULL, NULL, NULL, NULL, NULL, 'zfdgxdh', 'hxdx', '12345678', 1, 'dsdgsfb', '127.0.0.1', '2021-12-14 11:57:17', 2, 5, 5, 0, '2021-12-14 11:57:17', 1, 5, 0, 50, 0),
(13, NULL, NULL, NULL, NULL, NULL, NULL, 'fhxxdg', 'hfhxdgd', '12345678', 1, 'hxdx', '127.0.0.1', '2021-12-14 11:58:34', 2, 5, 5, 0, '2021-12-14 11:58:34', 1, 5, 0, 50, 0),
(14, NULL, NULL, NULL, NULL, NULL, NULL, 'dherher', 'udjrgddfx', '12345678', 1, 'hfhxdgd', '127.0.0.1', '2021-12-14 11:59:51', 2, 5, 5, 0, '2021-12-14 11:59:51', 1, 5, 0, 50, 0),
(15, NULL, NULL, NULL, NULL, NULL, NULL, 'dfoskdvk', 'dgthtgrs', '12345678', 1, 'udjrgddfx', '127.0.0.1', '2021-12-14 12:01:02', 2, 5, 5, 0, '2021-12-14 12:01:02', 1, 5, 0, 50, 0),
(16, NULL, NULL, NULL, NULL, NULL, NULL, 'gzgzrgz', 'rdhxhxe', '12345678', 1, 'dgthtgrs', '127.0.0.1', '2021-12-14 12:37:51', 2, 0, 0, 0, '2021-12-14 12:37:51', 1, 5, 0, 50, 0),
(17, NULL, NULL, NULL, NULL, NULL, NULL, 'obrubidddnskii@gmail.com', 'natsliy3', '12345678', 1, 'natsliy', '85.115.248.228', '2021-12-14 20:54:43', 2, 0, 0, 0, '2021-12-14 20:54:43', 1, 30, 0, 0, 0),
(18, NULL, NULL, NULL, NULL, NULL, NULL, 'mogutovaanas@gmail.com', 'nastenka92', 'orofah4368', 1, 'admin', '81.9.127.99', '2021-12-14 21:30:11', 1, 0, 0, 0, '2021-12-14 21:30:11', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 17:43
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `ID` int(10) UNSIGNED NOT NULL,
  `BannerURL` text,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`ID`, `BannerURL`, `Date`) VALUES
(1, 'https://pervyimillion.host/banners/468x60.gif', '2021-12-14 20:43:26');

-- --------------------------------------------------------

--
-- Структура таблицы `bantopsettings`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `bantopsettings`;
CREATE TABLE `bantopsettings` (
  `maxban` int(10) UNSIGNED NOT NULL,
  `showban` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `bantopsettings`
--

INSERT INTO `bantopsettings` (`maxban`, `showban`) VALUES
(10000, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `btransactions`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 17:56
--

DROP TABLE IF EXISTS `btransactions`;
CREATE TABLE `btransactions` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `PaymentMode` varchar(75) DEFAULT NULL,
  `ussersmatrixid` int(10) UNSIGNED NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `freepag`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `freepag`;
CREATE TABLE `freepag` (
  `ID` int(10) UNSIGNED NOT NULL,
  `PName` varchar(255) DEFAULT NULL,
  `pagedesc` text,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `freepag`
--

INSERT INTO `freepag` (`ID`, `PName`, `pagedesc`, `Date`) VALUES
(1, '', '', '2013-12-16 02:22:17'),
(2, '', '', '2013-12-16 02:22:17'),
(3, '', '', '2013-12-16 02:22:17'),
(4, '', '', '2013-12-16 02:22:17'),
(5, '', '', '2013-12-16 02:22:17'),
(6, '', '', '2013-12-16 02:22:17');

-- --------------------------------------------------------

--
-- Структура таблицы `journal`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 17:56
--

DROP TABLE IF EXISTS `journal`;
CREATE TABLE `journal` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `memid` int(10) UNSIGNED NOT NULL,
  `ussersmatrix` int(10) UNSIGNED NOT NULL,
  `Amount` float DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `journal`
--

INSERT INTO `journal` (`ID`, `Username`, `memid`, `ussersmatrix`, `Amount`, `purpose`, `Date`) VALUES
(1, 'natsliy', 1, 1, 5, 'Referral Bonus', '2021-12-14 11:48:54'),
(2, 'natak2', 2, 1, 5, 'Referral Bonus', '2021-12-14 11:50:58'),
(3, 'sgumatrixz', 3, 1, 5, 'Referral Bonus', '2021-12-14 11:52:11'),
(4, 'nasssn', 4, 1, 5, 'Referral Bonus', '2021-12-14 11:53:20'),
(5, 'sfsdafasf', 5, 1, 5, 'Referral Bonus', '2021-12-14 11:54:25'),
(6, 'cdgsg', 6, 1, 5, 'Referral Bonus', '2021-12-14 11:55:18'),
(7, 'dsdgsfb', 7, 1, 5, 'Referral Bonus', '2021-12-14 11:57:39'),
(8, 'hxdx', 8, 1, 5, 'Referral Bonus', '2021-12-14 11:58:54'),
(9, 'hfhxdgd', 9, 1, 5, 'Referral Bonus', '2021-12-14 12:00:10'),
(10, 'udjrgddfx', 10, 1, 5, 'Referral Bonus', '2021-12-14 12:01:22'),
(11, 'dgthtgrs', 11, 1, 5, 'Referral Bonus', '2021-12-14 12:44:51'),
(12, 'natsliy', 1, 1, 5, 'Referral Bonus', '2021-12-14 20:56:53');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` text,
  `data` text,
  `status` int(10) UNSIGNED NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `sitenews`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `sitenews`;
CREATE TABLE `sitenews` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Subject` text,
  `Message` text,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `textopsettings`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `textopsettings`;
CREATE TABLE `textopsettings` (
  `maxads` int(10) UNSIGNED NOT NULL,
  `nads` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `textopsettings`
--

INSERT INTO `textopsettings` (`maxads`, `nads`) VALUES
(1000, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `topsettings`
--
-- Создание: Дек 14 2021 г., 14:54
-- Последнее обновление: Дек 14 2021 г., 15:00
--

DROP TABLE IF EXISTS `topsettings`;
CREATE TABLE `topsettings` (
  `sitename` text,
  `siteurl` text,
  `Email` text,
  `Username` varchar(75) DEFAULT NULL,
  `Password` varchar(75) DEFAULT NULL,
  `topbanner` float DEFAULT NULL,
  `bottombanner` float DEFAULT NULL,
  `perfectmoney` varchar(75) DEFAULT NULL,
  `skype` varchar(175) DEFAULT NULL,
  `qiwi` varchar(175) DEFAULT NULL,
  `dolkurs` varchar(75) DEFAULT NULL,
  `freemember` int(10) UNSIGNED NOT NULL,
  `startussersmatrix` int(10) UNSIGNED NOT NULL,
  `minwithdrawal` float DEFAULT NULL,
  `multipurchaseallowed` int(10) UNSIGNED NOT NULL,
  `maxposperlevel` int(10) UNSIGNED NOT NULL,
  `showAddress` int(10) UNSIGNED NOT NULL,
  `showCity` int(10) UNSIGNED NOT NULL,
  `showState` int(10) UNSIGNED NOT NULL,
  `showZip` int(10) UNSIGNED NOT NULL,
  `showCountry` int(10) UNSIGNED NOT NULL,
  `domser` int(10) UNSIGNED NOT NULL,
  `confirmreq` int(10) UNSIGNED NOT NULL,
  `refnotification` int(10) UNSIGNED NOT NULL,
  `Subject1` text,
  `Message1` text,
  `Subject2` text,
  `Message2` text,
  `Subject3` text,
  `Message3` text,
  `Subject4` text,
  `Message4` text,
  `Subject5` text,
  `Message5` text,
  `freebonus` text,
  `probonus` text,
  `Subject6` text,
  `Message6` text,
  `Subject7` text,
  `Message7` text,
  `eformat1` int(10) UNSIGNED NOT NULL,
  `eformat2` int(10) UNSIGNED NOT NULL,
  `eformat3` int(10) UNSIGNED NOT NULL,
  `eformat4` int(10) UNSIGNED NOT NULL,
  `eformat5` int(10) UNSIGNED NOT NULL,
  `eformat6` int(10) UNSIGNED NOT NULL,
  `eformat7` int(10) UNSIGNED NOT NULL,
  `Merchants` int(10) UNSIGNED NOT NULL,
  `MerchantName1` text,
  `MerchantCode1` text,
  `MerchantName2` text,
  `MerchantCode2` text,
  `MerchantName3` text,
  `MerchantCode3` text,
  `MerchantName4` text,
  `MerchantCode4` text,
  `MerchantName5` text,
  `MerchantCode5` text,
  `Subject8` text,
  `Message8` text,
  `eformat8` int(10) UNSIGNED NOT NULL,
  `Subject9` text,
  `Message9` text,
  `eformat9` int(10) UNSIGNED NOT NULL,
  `ipncode` varchar(255) DEFAULT NULL,
  `pospurnextlevel` int(10) UNSIGNED NOT NULL,
  `nonussersmatrixmatch` int(10) UNSIGNED NOT NULL,
  `freerefbonus` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `topsettings`
--

INSERT INTO `topsettings` (`sitename`, `siteurl`, `Email`, `Username`, `Password`, `topbanner`, `bottombanner`, `perfectmoney`, `skype`, `qiwi`, `dolkurs`, `freemember`, `startussersmatrix`, `minwithdrawal`, `multipurchaseallowed`, `maxposperlevel`, `showAddress`, `showCity`, `showState`, `showZip`, `showCountry`, `domser`, `confirmreq`, `refnotification`, `Subject1`, `Message1`, `Subject2`, `Message2`, `Subject3`, `Message3`, `Subject4`, `Message4`, `Subject5`, `Message5`, `freebonus`, `probonus`, `Subject6`, `Message6`, `Subject7`, `Message7`, `eformat1`, `eformat2`, `eformat3`, `eformat4`, `eformat5`, `eformat6`, `eformat7`, `Merchants`, `MerchantName1`, `MerchantCode1`, `MerchantName2`, `MerchantCode2`, `MerchantName3`, `MerchantCode3`, `MerchantName4`, `MerchantCode4`, `MerchantName5`, `MerchantCode5`, `Subject8`, `Message8`, `eformat8`, `Subject9`, `Message9`, `eformat9`, `ipncode`, `pospurnextlevel`, `nonussersmatrixmatch`, `freerefbonus`) VALUES
('PERVYIMILLION', 'https://pervyimillion.host', 'pervyimillion@project.com', 'admin', 'admin', 0, 0, 'U33574192', 'https://t.me/+LgmOgxf3_mg0MjNi', '', '73,52', 1, 1, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '?????????????? ?????????????????????????????? ?? {sitename}!', '??????????????????????????????????!\r\n\r\n?????????????????????????????? ?? ?????????????????????????????????? ?? ?????????????????? ????????????????????!\r\n?????????? ????????????: {username}\r\n?????????? ????????????????: {password}\r\n\r\n?? ??????????????????????????,\r\n???????????????????????????????? ???????????????????? {sitename}\r\n{siteurl}', '', '', '', '', '???????????????????????????????????????? ????????????????', '??????????????????????????????????!\r\n\r\n?????????? ????????????: {username}\r\n?????????? ????????????????: {password}\r\n\r\n?? ??????????????????????????,\r\n???????????????????????????????? ???????????????????? {sitename}\r\n{siteurl}', '', '', '?????????? ?????????????????? ??????????????????', '??????????????????????????????????!\r\n\r\n?????????? ??????????????????:\r\n??????????????????????????????????: {banner}\r\n??????????????????: {websiteurl}\r\n\r\n??????????????????! \r\n\r\n?? ??????????????????????????,\r\n???????????????????????????????? ???????????????????? {sitename}\r\n{siteurl}', '?????????? ?????????????????? ??????????????????', '??????????????????????????????????!\r\n\r\n?????????? ??????????????????:\r\n??????????????????????????????????: {banner}\r\n??????????????????: {websiteurl}\r\n\r\n??????????????????! \r\n\r\n?? ??????????????????????????,\r\n???????????????????????????????? ???????????????????? {sitename}\r\n{siteurl}', 1, 1, 1, 1, 1, 1, 1, 0, '0', '', '0.5', '', '', '', '', '', '', '', '', '', 1, '', '', 1, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `topsponsors`
--
-- Создание: Дек 14 2021 г., 17:42
--

DROP TABLE IF EXISTS `topsponsors`;
CREATE TABLE `topsponsors` (
  `ID` text,
  `ref` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `topsponsors`
--

INSERT INTO `topsponsors` (`ID`, `ref`) VALUES
('kvant', 1),
('natsliy', 1),
('natak2', 1),
('sgumatrixz', 1),
('nasssn', 1),
('sfsdafasf', 1),
('cdgsg', 1),
('dsdgsfb', 1),
('hxdx', 1),
('hfhxdgd', 1),
('udjrgddfx', 1),
('dgthtgrs', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `transaactions`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 17:44
--

DROP TABLE IF EXISTS `transaactions`;
CREATE TABLE `transaactions` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `PaymentMode` varchar(75) DEFAULT NULL,
  `Amount` float DEFAULT NULL,
  `approved` int(10) UNSIGNED NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `transaactions`
--

INSERT INTO `transaactions` (`ID`, `Username`, `PaymentMode`, `Amount`, `approved`, `Date`) VALUES
(1, 'natsliy', 'PerfectMoney:U3357419', 15, 1, '2021-12-14 20:44:13');

-- --------------------------------------------------------

--
-- Структура таблицы `ussersbanners`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `ussersbanners`;
CREATE TABLE `ussersbanners` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `BannerURL` text,
  `WebsiteURL` text,
  `assigned` int(10) UNSIGNED NOT NULL,
  `remaining` int(10) UNSIGNED NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL,
  `approved` int(10) UNSIGNED NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `ussersmatrices`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:59
--

DROP TABLE IF EXISTS `ussersmatrices`;
CREATE TABLE `ussersmatrices` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `fee` float DEFAULT NULL,
  `ussersmatrixtype` int(10) UNSIGNED NOT NULL,
  `levels` int(10) UNSIGNED NOT NULL,
  `forcedussersmatrix` int(10) UNSIGNED NOT NULL,
  `payouttype` int(10) UNSIGNED NOT NULL,
  `ussersmatrixbonus` float DEFAULT NULL,
  `matchingbonus` float DEFAULT NULL,
  `Level1` float DEFAULT NULL,
  `Level2` float DEFAULT NULL,
  `Level3` float DEFAULT NULL,
  `Level4` float DEFAULT NULL,
  `Level5` float DEFAULT NULL,
  `Level6` float DEFAULT NULL,
  `Level7` float DEFAULT NULL,
  `Level8` float DEFAULT NULL,
  `Level9` float DEFAULT NULL,
  `Level10` float DEFAULT NULL,
  `Level1m` float DEFAULT NULL,
  `Level2m` float DEFAULT NULL,
  `Level3m` float DEFAULT NULL,
  `Level4m` float DEFAULT NULL,
  `Level5m` float DEFAULT NULL,
  `Level6m` float DEFAULT NULL,
  `Level7m` float DEFAULT NULL,
  `Level8m` float DEFAULT NULL,
  `Level9m` float DEFAULT NULL,
  `Level10m` float DEFAULT NULL,
  `Level1c` float DEFAULT NULL,
  `Level2c` float DEFAULT NULL,
  `Level3c` float DEFAULT NULL,
  `Level4c` float DEFAULT NULL,
  `Level5c` float DEFAULT NULL,
  `Level6c` float DEFAULT NULL,
  `Level7c` float DEFAULT NULL,
  `Level8c` float DEFAULT NULL,
  `Level9c` float DEFAULT NULL,
  `Level10c` float DEFAULT NULL,
  `Level1cm` float DEFAULT NULL,
  `Level2cm` float DEFAULT NULL,
  `Level3cm` float DEFAULT NULL,
  `Level4cm` float DEFAULT NULL,
  `Level5cm` float DEFAULT NULL,
  `Level6cm` float DEFAULT NULL,
  `Level7cm` float DEFAULT NULL,
  `Level8cm` float DEFAULT NULL,
  `Level9cm` float DEFAULT NULL,
  `Level10cm` float DEFAULT NULL,
  `textcreditsentry` int(10) UNSIGNED NOT NULL,
  `bannercreditsentry` int(10) UNSIGNED NOT NULL,
  `textcreditscycle` int(10) UNSIGNED NOT NULL,
  `bannercreditscycle` int(10) UNSIGNED NOT NULL,
  `reentry` int(10) UNSIGNED NOT NULL,
  `reentrynum` int(10) UNSIGNED NOT NULL,
  `entry1` int(10) UNSIGNED NOT NULL,
  `entry1num` int(10) UNSIGNED NOT NULL,
  `ussersmatrixid1` int(10) UNSIGNED NOT NULL,
  `entry2` int(10) UNSIGNED NOT NULL,
  `entry2num` int(10) UNSIGNED NOT NULL,
  `ussersmatrixid2` int(10) UNSIGNED NOT NULL,
  `entry3` int(10) UNSIGNED NOT NULL,
  `entry3num` int(10) UNSIGNED NOT NULL,
  `ussersmatrixid3` int(10) UNSIGNED NOT NULL,
  `entry4` int(10) UNSIGNED NOT NULL,
  `entry4num` int(10) UNSIGNED NOT NULL,
  `ussersmatrixid4` int(10) UNSIGNED NOT NULL,
  `entry5` int(10) UNSIGNED NOT NULL,
  `entry5num` int(10) UNSIGNED NOT NULL,
  `ussersmatrixid5` int(10) UNSIGNED NOT NULL,
  `welcomemail` int(10) UNSIGNED NOT NULL,
  `Subject1` text,
  `Message1` text,
  `eformat1` int(10) UNSIGNED NOT NULL,
  `cyclemail` int(10) UNSIGNED NOT NULL,
  `Subject2` text,
  `Message2` text,
  `eformat2` int(10) UNSIGNED NOT NULL,
  `cyclemailsponsor` int(10) UNSIGNED NOT NULL,
  `Subject3` text,
  `Message3` text,
  `eformat3` int(10) UNSIGNED NOT NULL,
  `bonusdownloads` text,
  `refbonuspaid` int(10) UNSIGNED NOT NULL,
  `refbonus` float DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `ussersmatrices`
--

INSERT INTO `ussersmatrices` (`ID`, `Name`, `fee`, `ussersmatrixtype`, `levels`, `forcedussersmatrix`, `payouttype`, `ussersmatrixbonus`, `matchingbonus`, `Level1`, `Level2`, `Level3`, `Level4`, `Level5`, `Level6`, `Level7`, `Level8`, `Level9`, `Level10`, `Level1m`, `Level2m`, `Level3m`, `Level4m`, `Level5m`, `Level6m`, `Level7m`, `Level8m`, `Level9m`, `Level10m`, `Level1c`, `Level2c`, `Level3c`, `Level4c`, `Level5c`, `Level6c`, `Level7c`, `Level8c`, `Level9c`, `Level10c`, `Level1cm`, `Level2cm`, `Level3cm`, `Level4cm`, `Level5cm`, `Level6cm`, `Level7cm`, `Level8cm`, `Level9cm`, `Level10cm`, `textcreditsentry`, `bannercreditsentry`, `textcreditscycle`, `bannercreditscycle`, `reentry`, `reentrynum`, `entry1`, `entry1num`, `ussersmatrixid1`, `entry2`, `entry2num`, `ussersmatrixid2`, `entry3`, `entry3num`, `ussersmatrixid3`, `entry4`, `entry4num`, `ussersmatrixid4`, `entry5`, `entry5num`, `ussersmatrixid5`, `welcomemail`, `Subject1`, `Message1`, `eformat1`, `cyclemail`, `Subject2`, `Message2`, `eformat2`, `cyclemailsponsor`, `Subject3`, `Message3`, `eformat3`, `bonusdownloads`, `refbonuspaid`, `refbonus`, `Date`) VALUES
(1, 'pervyimillion', 200, 2, 2, 2, 1, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 0, 30, 0, 0, 1, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 1, 0, '', '', 1, 0, '', '', 1, '', 2, 5, '2013-12-16 02:22:17'),
(2, 'pervyimillion LVL2', 0, 2, 2, 2, 1, 300, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 200, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 1, 0, '', '', 1, 0, '', '', 1, '', 2, 0, '2013-12-17 20:36:12');

-- --------------------------------------------------------

--
-- Структура таблицы `ussersmatrix1`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 18:00
--

DROP TABLE IF EXISTS `ussersmatrix1`;
CREATE TABLE `ussersmatrix1` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `Sponsor` varchar(75) DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL,
  `Level1` int(10) UNSIGNED NOT NULL,
  `Level2` int(10) UNSIGNED NOT NULL,
  `Level3` int(10) UNSIGNED NOT NULL,
  `Level4` int(10) UNSIGNED NOT NULL,
  `Level5` int(10) UNSIGNED NOT NULL,
  `Level6` int(10) UNSIGNED NOT NULL,
  `Level7` int(10) UNSIGNED NOT NULL,
  `Level8` int(10) UNSIGNED NOT NULL,
  `Level9` int(10) UNSIGNED NOT NULL,
  `Level10` int(10) UNSIGNED NOT NULL,
  `Leader` int(10) UNSIGNED NOT NULL,
  `Total` float DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `MainID` int(10) UNSIGNED NOT NULL,
  `CDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `ussersmatrix1`
--

INSERT INTO `ussersmatrix1` (`ID`, `Username`, `Sponsor`, `ref_by`, `Level1`, `Level2`, `Level3`, `Level4`, `Level5`, `Level6`, `Level7`, `Level8`, `Level9`, `Level10`, `Leader`, `Total`, `Date`, `MainID`, `CDate`) VALUES
(1, 'admin', '', 0, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, '2021-12-14 11:46:56', 1, '2021-12-14 11:55:18'),
(2, 'natak2', 'admin', 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 1, 10, '2021-12-14 11:48:54', 2, '2021-12-14 12:01:22'),
(3, 'sgumatrixz', 'natak2', 1, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, '2021-12-14 11:50:58', 3, '2021-12-14 11:50:58'),
(4, 'nasssn', 'sgumatrixz', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, '2021-12-14 11:52:11', 4, '2021-12-14 11:52:11'),
(5, 'sfsdafasf', 'nasssn', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, '2021-12-14 11:53:20', 5, '2021-12-14 11:53:20'),
(6, 'cdgsg', 'sfsdafasf', 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, '2021-12-14 11:54:25', 6, '2021-12-14 11:54:25'),
(7, 'dsdgsfb', 'cdgsg', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, '2021-12-14 11:55:18', 7, '2021-12-14 11:55:18'),
(8, 'hxdx', 'dsdgsfb', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, '2021-12-14 11:57:39', 8, '2021-12-14 11:57:39'),
(9, 'hfhxdgd', 'hxdx', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, '2021-12-14 11:58:54', 9, '2021-12-14 11:58:54'),
(10, 'udjrgddfx', 'hfhxdgd', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, '2021-12-14 12:00:10', 10, '2021-12-14 12:00:10'),
(11, 'dgthtgrs', 'udjrgddfx', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, '2021-12-14 12:01:22', 11, '2021-12-14 12:01:22'),
(12, 'rdhxhxe', 'dgthtgrs', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 11, 0, '2021-12-14 12:44:51', 12, '2021-12-14 12:44:51'),
(13, 'natsliy3', 'admin', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2021-12-14 20:56:53', 13, '2021-12-14 20:56:53');

-- --------------------------------------------------------

--
-- Структура таблицы `ussersmatrix2`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `ussersmatrix2`;
CREATE TABLE `ussersmatrix2` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `Sponsor` varchar(75) DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL,
  `Level1` int(10) UNSIGNED NOT NULL,
  `Level2` int(10) UNSIGNED NOT NULL,
  `Level3` int(10) UNSIGNED NOT NULL,
  `Level4` int(10) UNSIGNED NOT NULL,
  `Level5` int(10) UNSIGNED NOT NULL,
  `Level6` int(10) UNSIGNED NOT NULL,
  `Level7` int(10) UNSIGNED NOT NULL,
  `Level8` int(10) UNSIGNED NOT NULL,
  `Level9` int(10) UNSIGNED NOT NULL,
  `Level10` int(10) UNSIGNED NOT NULL,
  `Leader` int(10) UNSIGNED NOT NULL,
  `Total` float DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `MainID` int(10) UNSIGNED NOT NULL,
  `CDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `ussersmatrix2`
--

INSERT INTO `ussersmatrix2` (`ID`, `Username`, `Sponsor`, `ref_by`, `Level1`, `Level2`, `Level3`, `Level4`, `Level5`, `Level6`, `Level7`, `Level8`, `Level9`, `Level10`, `Leader`, `Total`, `Date`, `MainID`, `CDate`) VALUES
(1, 'natsliy', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-14 11:55:18', 1, '2021-12-14 11:55:18'),
(2, 'natak2', 'natsliy', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2021-12-14 12:01:22', 2, '2021-12-14 12:01:22');

-- --------------------------------------------------------

--
-- Структура таблицы `ussersothvar`
--
-- Создание: Дек 14 2021 г., 14:24
-- Последнее обновление: Дек 14 2021 г., 14:24
--

DROP TABLE IF EXISTS `ussersothvar`;
CREATE TABLE `ussersothvar` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(75) DEFAULT NULL,
  `Textad` text,
  `WebsiteURL` text,
  `assigned` int(10) UNSIGNED NOT NULL,
  `remaining` int(10) UNSIGNED NOT NULL,
  `hits` int(10) UNSIGNED NOT NULL,
  `approved` int(10) UNSIGNED NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Textad1` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `allussers`
--
ALTER TABLE `allussers`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `btransactions`
--
ALTER TABLE `btransactions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `freepag`
--
ALTER TABLE `freepag`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `sitenews`
--
ALTER TABLE `sitenews`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `transaactions`
--
ALTER TABLE `transaactions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ussersbanners`
--
ALTER TABLE `ussersbanners`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ussersmatrices`
--
ALTER TABLE `ussersmatrices`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ussersmatrix1`
--
ALTER TABLE `ussersmatrix1`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ussersmatrix2`
--
ALTER TABLE `ussersmatrix2`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ussersothvar`
--
ALTER TABLE `ussersothvar`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `allussers`
--
ALTER TABLE `allussers`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `banners`
--
ALTER TABLE `banners`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `btransactions`
--
ALTER TABLE `btransactions`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `freepag`
--
ALTER TABLE `freepag`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `journal`
--
ALTER TABLE `journal`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sitenews`
--
ALTER TABLE `sitenews`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transaactions`
--
ALTER TABLE `transaactions`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ussersbanners`
--
ALTER TABLE `ussersbanners`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ussersmatrices`
--
ALTER TABLE `ussersmatrices`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `ussersmatrix1`
--
ALTER TABLE `ussersmatrix1`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `ussersmatrix2`
--
ALTER TABLE `ussersmatrix2`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `ussersothvar`
--
ALTER TABLE `ussersothvar`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
