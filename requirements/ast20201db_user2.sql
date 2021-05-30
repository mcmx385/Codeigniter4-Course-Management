-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: ast20201db
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user2`
--

DROP TABLE IF EXISTS `user2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(45) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `pass` varchar(45) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `usertype` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user2`
--

LOCK TABLES `user2` WRITE;
/*!40000 ALTER TABLE `user2` DISABLE KEYS */;
INSERT INTO `user2` VALUES (1,'Liu','Liu','teacher'),(2,'Yan','Yan','teacher'),(3,'Pang','Pang','teacher'),(4,'root','root','student'),(5,'root2','root2','student'),(6,'CHAN Chak Mo','CHAN Chak Mo','student'),(7,'CHAN Cheuk Fung','CHAN Cheuk Fung','student'),(8,'CHAN Mei Ying','CHAN Mei Ying','student'),(9,'CHAN Tsam Lam Kathleen','CHAN Tsam Lam Kathleen','student'),(10,'CHAN Wing Hei','CHAN Wing Hei','student'),(11,'CHAN Yuen Ni','CHAN Yuen Ni','student'),(12,'CHANG Wai Chung','CHANG Wai Chung','student'),(13,'CHAU Yue Hei','CHAU Yue Hei','student'),(14,'CHENG Shenqi','CHENG Shenqi','student'),(15,'CHONG Chun Man','CHONG Chun Man','student'),(16,'CHOU Chun Yu Dominic','CHOU Chun Yu Dominic','student'),(17,'CHU Shun Hei','CHU Shun Hei','student'),(18,'CHUNG Wing Hei','CHUNG Wing Hei','student'),(19,'FAN Tsz Kin','FAN Tsz Kin','student'),(20,'HEUNG Wing Kit Francis','HEUNG Wing Kit Francis','student'),(21,'HUANG Jinhuan','HUANG Jinhuan','student'),(22,'HUANG Yiting','HUANG Yiting','student'),(23,'HUI Wang Hon','HUI Wang Hon','student'),(24,'HUI Yat Nok','HUI Yat Nok','student'),(25,'JIANG Yiyang','JIANG Yiyang','student'),(26,'KU Ming Kit','KU Ming Kit','student'),(27,'KWAN Cheuk Man','KWAN Cheuk Man','student'),(28,'KWONG Ho Yin','KWONG Ho Yin','student'),(29,'LAI Ching Man','LAI Ching Man','student'),(30,'LAM Ho Hei','LAM Ho Hei','student'),(31,'LEE Kwok Hei Conway','LEE Kwok Hei Conway','student'),(32,'LI Po Lung','LI Po Lung','student'),(33,'LI Weizong','LI Weizong','student'),(34,'LI Wo Hing','LI Wo Hing','student'),(35,'LIANG Yee Sum Eason','LIANG Yee Sum Eason','student'),(36,'LIN Zhiwei','LIN Zhiwei','student'),(37,'LIU Kai Chun','LIU Kai Chun','student'),(38,'MANDALIHAN Martha Hillary Sales','MANDALIHAN Martha Hillary Sales','student'),(39,'MUI Chun Yu','MUI Chun Yu','student'),(40,'NG Hong Wing','NG Hong Wing','student'),(41,'PUN Yiu Kwan','PUN Yiu Kwan','student'),(42,'QIAN Weifeng','QIAN Weifeng','student'),(43,'SINGH Pawandeep','SINGH Pawandeep','student'),(44,'SZE Chun','SZE Chun','student'),(45,'TAM Tsz Hei','TAM Tsz Hei','student'),(46,'TANG Wing Yin','TANG Wing Yin','student'),(47,'WANG Yuxuan','WANG Yuxuan','student'),(48,'WONG Chak Hei','WONG Chak Hei','student'),(49,'WONG Ho Ming','WONG Ho Ming','student'),(50,'WONG Kwong Hong','WONG Kwong Hong','student'),(51,'WONG Pak Kong Parco','WONG Pak Kong Parco','student'),(52,'YIP Ming Keung','YIP Ming Keung','student'),(53,'YUNG Kam Kong','YUNG Kam Kong','student');
/*!40000 ALTER TABLE `user2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-19 13:17:07
