-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: csgo
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `GA`
--

DROP TABLE IF EXISTS `GA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GA` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `steamid` varchar(26) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20849 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GA`
--

LOCK TABLES `GA` WRITE;
/*!40000 ALTER TABLE `GA` DISABLE KEYS */;
/*!40000 ALTER TABLE `GA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GAHist`
--

DROP TABLE IF EXISTS `GAHist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GAHist` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `avatar` text CHARACTER SET utf8 NOT NULL,
  `amount` int(5) NOT NULL,
  `time` bigint(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GAHist`
--

LOCK TABLES `GAHist` WRITE;
/*!40000 ALTER TABLE `GAHist` DISABLE KEYS */;
/*!40000 ALTER TABLE `GAHist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `id` varchar(255) NOT NULL,
  `market_hash_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `classid` varchar(255) NOT NULL,
  `bot_id` varchar(64) NOT NULL,
  `in_trade` varchar(1) NOT NULL,
  `deposit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rake`
--

DROP TABLE IF EXISTS `rake`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rake` (
  `coinflip` varchar(255) NOT NULL,
  `jackpot` varchar(255) NOT NULL,
  `roulette` varchar(255) NOT NULL,
  UNIQUE KEY `jackpot` (`jackpot`),
  UNIQUE KEY `roulette` (`roulette`),
  UNIQUE KEY `coinflip_2` (`coinflip`,`jackpot`,`roulette`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rake`
--

LOCK TABLES `rake` WRITE;
/*!40000 ALTER TABLE `rake` DISABLE KEYS */;
/*!40000 ALTER TABLE `rake` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roll_history`
--

DROP TABLE IF EXISTS `roll_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roll_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `roll` int(11) NOT NULL,
  `time` varchar(64) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121637 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roll_history`
--

LOCK TABLES `roll_history` WRITE;
/*!40000 ALTER TABLE `roll_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `roll_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade_history`
--

DROP TABLE IF EXISTS `trade_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trade_history` (
  `offer_id` bigint(20) unsigned NOT NULL,
  `offer_partner` varchar(255) NOT NULL,
  `offer_state` varchar(255) NOT NULL,
  `worth` bigint(20) unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `offer_id` (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade_history`
--

LOCK TABLES `trade_history` WRITE;
/*!40000 ALTER TABLE `trade_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `trade_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `steamid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wallet` int(10) unsigned NOT NULL DEFAULT '10000',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tradeurl` text COLLATE utf8_unicode_ci NOT NULL,
  `inviter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `muted` int(11) NOT NULL,
  `banned` int(11) NOT NULL,
  `transfer_banned` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csgo` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `token_time` bigint(20) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logged_in` int(11) NOT NULL,
  `wager` int(11) NOT NULL,
  `total_bet` bigint(20) unsigned NOT NULL,
  `total_won` bigint(20) unsigned NOT NULL,
  `total_lose` bigint(20) NOT NULL,
  `deposit_sum` bigint(20) NOT NULL,
  `collected` int(10) unsigned NOT NULL,
  `last_free_use` int(11) NOT NULL,
  `last_group_use` int(11) NOT NULL,
  `group_used` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_steamid_unique` (`steamid`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_change`
--

DROP TABLE IF EXISTS `wallet_change`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `change` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49974 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_change`
--

LOCK TABLES `wallet_change` WRITE;
/*!40000 ALTER TABLE `wallet_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_change` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-30  2:48:17
