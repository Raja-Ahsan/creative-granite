-- MySQL dump 10.13  Distrib 8.4.10-10, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: granite
-- ------------------------------------------------------
-- Server version	8.4.10-10

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
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('creative-granite-cache-site.content.payload','a:18:{s:8:\"settings\";a:12:{s:4:\"logo\";s:28:\"/images/site/update-logo.png\";s:14:\"aboutStoneBath\";s:28:\"/images/site/LakeLine-20.jpg\";s:12:\"instagramUrl\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";s:15:\"showroomMapsUrl\";s:273:\"https://www.google.com/maps/place/1998+N+Redwood+Rd,+Salt+Lake+City,+UT+84116,+USA/@40.8115045,-111.9402546,16.96z/data=!4m6!3m5!1s0x8752f6bad3a740e7:0x54da835cc07f3b51!8m2!3d40.8115002!4d-111.9376702!16s%2Fg%2F11c1zjtg8r?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D\";s:12:\"addressLine1\";s:17:\"1998 n redwood rd\";s:12:\"addressLine2\";s:24:\"Salt lake city, ut 84116\";s:5:\"phone\";s:12:\"801.886.0204\";s:5:\"email\";s:24:\"info@creativegranite.com\";s:5:\"hours\";s:26:\"8am – 5pm · Mon – Fri\";s:11:\"foundedYear\";s:4:\"1998\";s:13:\"footerTagline\";s:48:\"Built on craftsmanship. Serving Utah since 1998.\";s:16:\"contactFormIntro\";s:97:\"Tell us about your project — we will follow up with next steps, timing, and a path to estimate.\";}s:12:\"projectTypes\";a:4:{i:0;a:2:{s:5:\"value\";s:16:\"new-construction\";s:5:\"label\";s:16:\"New construction\";}i:1;a:2:{s:5:\"value\";s:18:\"remodel-renovation\";s:5:\"label\";s:20:\"Remodel & renovation\";}i:2;a:2:{s:5:\"value\";s:22:\"multifamily-commercial\";s:5:\"label\";s:24:\"Multifamily & commercial\";}i:3;a:2:{s:5:\"value\";s:5:\"other\";s:5:\"label\";s:5:\"Other\";}}s:10:\"heroSlides\";a:5:{i:0;a:2:{s:3:\"src\";s:58:\"/storage/site/vmd8wqEDPWvXh2W92J1xlCYGbyYTcaB2j75sRxWh.jpg\";s:3:\"alt\";s:16:\"Park City 06 (1)\";}i:1;a:2:{s:3:\"src\";s:58:\"/storage/site/TE953FCmWdMddcxp5cOHGAblwgGYjcJ1ANujsI3s.jpg\";s:3:\"alt\";s:10:\"Norfolk 01\";}i:2;a:2:{s:3:\"src\";s:58:\"/storage/site/9onv38JXN3SQL4CL0ZtiI6JL7rokSqRaj9oJxfvx.jpg\";s:3:\"alt\";s:10:\"Norfolk 11\";}i:3;a:2:{s:3:\"src\";s:59:\"/storage/site/BX7TND4Gdti47fFHSB3muk7JZMdgF9xCQ6Ssv6h0.webp\";s:3:\"alt\";s:9:\"Image (2)\";}i:4;a:2:{s:3:\"src\";s:58:\"/storage/site/FmaKo6ApneFmWjsKfLTCffiP7qdBXDno1NQkqOgy.jpg\";s:3:\"alt\";s:8:\"Img 2103\";}}s:9:\"portfolio\";a:5:{i:0;a:4:{s:3:\"src\";s:58:\"/storage/site/xTF9G3dEHg4l4yLhd3CFWe9TNYQgA5fs9OUAsuRk.jpg\";s:5:\"title\";s:14:\"Carrara Island\";s:3:\"tag\";s:0:\"\";s:8:\"featured\";b:1;}i:1;a:4:{s:3:\"src\";s:58:\"/storage/site/f1rwlM74JFNbhYR2F5DfoJThicdfdwcA4yse6dsE.jpg\";s:5:\"title\";s:14:\"Carrara Island\";s:3:\"tag\";s:0:\"\";s:8:\"featured\";b:1;}i:2;a:4:{s:3:\"src\";s:58:\"/storage/site/FRJVfeJ3WrCJR3UJ8hyz8tHB2X2OXGxvcrPoKN6B.jpg\";s:5:\"title\";s:14:\"Modern Kitchen\";s:3:\"tag\";s:0:\"\";s:8:\"featured\";b:1;}i:3;a:4:{s:3:\"src\";s:58:\"/storage/site/9M3QVnLQTnfSQZX6oc7hLGj5G8PZvyjAAQdPa3S1.jpg\";s:5:\"title\";s:14:\"Modern Kitchen\";s:3:\"tag\";s:0:\"\";s:8:\"featured\";b:1;}i:4;a:4:{s:3:\"src\";s:58:\"/storage/site/SlwkAaqN2B83bobmzWZeVgUFoDgjf2VUO1pqj6zE.jpg\";s:5:\"title\";s:13:\"Architectural\";s:3:\"tag\";s:0:\"\";s:8:\"featured\";b:1;}}s:13:\"galleryAlbums\";a:8:{i:0;a:6:{s:4:\"slug\";s:8:\"kitchens\";s:5:\"title\";s:8:\"Kitchens\";s:4:\"kind\";s:8:\"category\";s:5:\"cover\";s:31:\"/images/work/kitchens-cover.jpg\";s:7:\"gallery\";s:70:\"/storage/gallery/collage/kpDHNxKBvAhuUg8VOhgjfpik3yOewSugjgCGoWgt.webp\";s:6:\"images\";a:12:{i:0;s:70:\"/storage/gallery/collage/kpDHNxKBvAhuUg8VOhgjfpik3yOewSugjgCGoWgt.webp\";i:1;s:69:\"/storage/gallery/collage/qnjbKf39lh5lyI7lrqv1VIXp3qzEwlcaAEHYcOik.jpg\";i:2;s:70:\"/storage/gallery/collage/xi235XP0SkUDhI6QDjKHiXAN3DLea3Cj6EKKbRpv.webp\";i:3;s:70:\"/storage/gallery/collage/UNdwqNlO7vJ70ldV3GGJz2zB69VFvH1zpOhER0j3.webp\";i:4;s:69:\"/storage/gallery/collage/V58SZ9OLJD22i1YRTAyVVQNzCclqrHBMA3o4oLxE.jpg\";i:5;s:70:\"/storage/gallery/collage/JbkY7kPCHtgigl1V85jMf1PUJ9CKKYWm5XZkcRbC.webp\";i:6;s:70:\"/storage/gallery/collage/Gpbr4ZN2n6U3LXQtqlTjo0A5oVtOOrxu3l4ZZBrN.webp\";i:7;s:70:\"/storage/gallery/collage/Tdei44CbwhVOGWQlnZjK8PD4RBEkUSX0useYphCJ.webp\";i:8;s:70:\"/storage/gallery/collage/3KCpxzHE1zjM8aH0ZEzd9U36pPthi3mcMDlgmYvX.webp\";i:9;s:70:\"/storage/gallery/collage/aV4oWQkbIh9zoUyyf4i1aiU2EkQU6m6azSST9mtj.webp\";i:10;s:70:\"/storage/gallery/collage/rl29xc16gOURNJOXGHrqTM8YF8pelztkMRPE6ERW.webp\";i:11;s:70:\"/storage/gallery/collage/CizxdLJDxjaMItpde2DR2wWt12QwtgohTbdMj7iJ.webp\";}}i:1;a:6:{s:4:\"slug\";s:7:\"norfolk\";s:5:\"title\";s:7:\"Norfolk\";s:4:\"kind\";s:7:\"project\";s:5:\"cover\";s:30:\"/images/work/norfolk-cover.jpg\";s:7:\"gallery\";s:69:\"/storage/gallery/collage/02xXhilVvDNPVrA0DaLqntg3jKuqlg7JvvwkARsq.jpg\";s:6:\"images\";a:12:{i:0;s:69:\"/storage/gallery/collage/02xXhilVvDNPVrA0DaLqntg3jKuqlg7JvvwkARsq.jpg\";i:1;s:69:\"/storage/gallery/collage/ddzt1XA9NIv7ouzNt8Mm0Y6COnyVWxKy9y56zYIa.jpg\";i:2;s:69:\"/storage/gallery/collage/LGIhXqqo39VTFmGgGO308fjhBR7ZVuZaluQGYWhM.jpg\";i:3;s:69:\"/storage/gallery/collage/yYaXPMEXGq5MPdrwBt45IV1HvQiOpJaKuI95xb9v.jpg\";i:4;s:69:\"/storage/gallery/collage/AhW6k79jC8GvaIUc0RU2W4eNQ6pEdT9ILGF47IxQ.jpg\";i:5;s:69:\"/storage/gallery/collage/qxbQS48AZs4dfrOpBYEdXNF8fgWb2MLZDQMf01Yg.jpg\";i:6;s:69:\"/storage/gallery/collage/p4BvLkzHUcQJGuU4rrUkiU58uqidjzzYnjqmKn7z.jpg\";i:7;s:69:\"/storage/gallery/collage/dF8tpEjzrtEQuOHQLoejLROBaqyiOW9Knpj49ke3.jpg\";i:8;s:69:\"/storage/gallery/collage/hAsnbh3vlotBcutiOhvY81OomuRGoUsjsoVca1Jp.jpg\";i:9;s:69:\"/storage/gallery/collage/DSGWGmvdClmTtTwAYk3iUFW8vHSxLAk8mlM3cjim.jpg\";i:10;s:69:\"/storage/gallery/collage/ka3Sj1xxBNWd7SO57fX5G0NuAjGnMP38UWlkkmKF.jpg\";i:11;s:69:\"/storage/gallery/collage/Q5oT5myj8TOc5VgDRwWCIEejyXjDj7kBR2jG1M1E.jpg\";}}i:2;a:6:{s:4:\"slug\";s:9:\"bathrooms\";s:5:\"title\";s:9:\"Bathrooms\";s:4:\"kind\";s:8:\"category\";s:5:\"cover\";s:32:\"/images/work/bathrooms-cover.jpg\";s:7:\"gallery\";s:70:\"/storage/gallery/collage/TosyvcXAH7dEYfcnJAtFOti8T5iiOQSbK7wpJvcM.webp\";s:6:\"images\";a:12:{i:0;s:70:\"/storage/gallery/collage/TosyvcXAH7dEYfcnJAtFOti8T5iiOQSbK7wpJvcM.webp\";i:1;s:70:\"/storage/gallery/collage/CJN9f218uljTOJHnhIRjqvVzjU7oxga8NOjMu6q9.webp\";i:2;s:70:\"/storage/gallery/collage/o5qVRlIMvSqP7SlJrzuPRWMRXvFjWKQVaH17f3pw.webp\";i:3;s:70:\"/storage/gallery/collage/29AkPxvn7SvjthNDP70y85QOmUmPcNHIDslyn1VG.webp\";i:4;s:70:\"/storage/gallery/collage/15HcXI9ZhJOssdJ6sC9vhBDmFfbImBtVOp2AMX4y.webp\";i:5;s:70:\"/storage/gallery/collage/JYLrnEWGxy8NdTBpqiopUr6l6OJfUSOvflWl4377.webp\";i:6;s:70:\"/storage/gallery/collage/dPKQFL28MXxOnJIE95TT5AeVwjXVXOOCdnfx7AbJ.webp\";i:7;s:70:\"/storage/gallery/collage/tszRS8fv1SgyKcKWfEUR2nllVWdvOk93V1ZTT0ph.webp\";i:8;s:70:\"/storage/gallery/collage/GOWiDT3VVpgu8PtDwyTQgp29Qy3dtzWpCxV9FyLp.webp\";i:9;s:70:\"/storage/gallery/collage/EYvKubeHhDbiWXXLe1MnKlEIcFs2YPRUzHHhqhad.webp\";i:10;s:70:\"/storage/gallery/collage/6vGOLy4A3yTsCQ8eonZVyD1mrHSWaR5vZpR3Br9P.webp\";i:11;s:70:\"/storage/gallery/collage/jmjcyprGInknS4sBYUaKRaREcgurJ755XL4bWb01.webp\";}}i:3;a:6:{s:4:\"slug\";s:5:\"sabal\";s:5:\"title\";s:5:\"Sabal\";s:4:\"kind\";s:7:\"project\";s:5:\"cover\";s:28:\"/images/work/sabal-cover.png\";s:7:\"gallery\";s:69:\"/storage/gallery/collage/eDRoQNY5DQt56Mw4lT3IgRIUy7vdFmJrefvjCItT.jpg\";s:6:\"images\";a:12:{i:0;s:69:\"/storage/gallery/collage/eDRoQNY5DQt56Mw4lT3IgRIUy7vdFmJrefvjCItT.jpg\";i:1;s:69:\"/storage/gallery/collage/YL7jkQBUGsR3KtRhM3PM7T8TajL3bNRF88Zb00aO.jpg\";i:2;s:69:\"/storage/gallery/collage/n8wFaTRNd2ECuwaKrxN2VonQFccN682zzdv7A9y6.jpg\";i:3;s:69:\"/storage/gallery/collage/HIVCKlE6gq47L69KLs84SRDKQFBckEelCKvf89it.jpg\";i:4;s:69:\"/storage/gallery/collage/qbv8UUBux5L4lTyTktCBhLd5MSwXNIHKtS8D3jxa.jpg\";i:5;s:69:\"/storage/gallery/collage/3pQhH46wm0kglE9DRZEVj6M8RBm6uRY694X64nEm.jpg\";i:6;s:69:\"/storage/gallery/collage/QSV0SPQMMXR33MrOICsWfWEQfXmt8rz4INvgpUUj.jpg\";i:7;s:69:\"/storage/gallery/collage/pA3FOC45AvDKkV8vwyyh7LjdXHT7XCLKwvTsyGHZ.jpg\";i:8;s:69:\"/storage/gallery/collage/bkaz1y65gjCx6uXGCXSUZ6kM156ddZ2cKqJMk2bI.jpg\";i:9;s:69:\"/storage/gallery/collage/cujDZDc09ioCYvVVI1sJHhp0VTvKjUARH5bVxT7W.jpg\";i:10;s:69:\"/storage/gallery/collage/aGhAuEWlcF59rYqbbJ98pkh6S42DaAbGsYBi4o3N.jpg\";i:11;s:69:\"/storage/gallery/collage/746KhjYSTSfWkW1oFPTgoaRa92SPnSYgnmk3T7dv.jpg\";}}i:4;a:6:{s:4:\"slug\";s:10:\"fireplaces\";s:5:\"title\";s:10:\"Fireplaces\";s:4:\"kind\";s:8:\"category\";s:5:\"cover\";s:33:\"/images/work/fireplaces-cover.jpg\";s:7:\"gallery\";s:70:\"/storage/gallery/collage/WzRo3Ocp7lqAkx8RUPs85ntwgeVP4ILprGsgjT2K.webp\";s:6:\"images\";a:12:{i:0;s:70:\"/storage/gallery/collage/WzRo3Ocp7lqAkx8RUPs85ntwgeVP4ILprGsgjT2K.webp\";i:1;s:70:\"/storage/gallery/collage/tXiH4GKelbLoXySFCqprkrUCad4dgorntvV9uGso.webp\";i:2;s:70:\"/storage/gallery/collage/4KdZvf9YFuNKabsfeuHYwp6GNKuDnJvzOlatbLZP.webp\";i:3;s:70:\"/storage/gallery/collage/j0iPGC8VLN7zGG26jfj89gnBXolL1Ox2Noo8x8CB.webp\";i:4;s:70:\"/storage/gallery/collage/dy8ogweqan4qdem6RDVQVTvAJueNOtIdltgoRGIs.webp\";i:5;s:70:\"/storage/gallery/collage/MLdhodZ7hPVIKfVLMiJzjlOAc2VwClRSfxNfo48E.webp\";i:6;s:70:\"/storage/gallery/collage/VUiSbtFzjjtAxbE1r5GVPVhACPvxroYhBvWi3u4j.webp\";i:7;s:70:\"/storage/gallery/collage/GKnYWg3ZCZLtJbA04hMI6RCacGXAXjGbKLVdDsd6.webp\";i:8;s:69:\"/storage/gallery/collage/Giah93HavqKTZfRyk9AwMBi8xqCpYtPBNbaeuPP4.jpg\";i:9;s:69:\"/storage/gallery/collage/c8ruwwyCx09cFOBixau4kX7Ui1NoG0Qm7eRabwRS.jpg\";i:10;s:69:\"/storage/gallery/collage/Pm0Ke3jCUhv7HhFLG7dPLGFV8oTPjJ9xF1UszudI.jpg\";i:11;s:69:\"/storage/gallery/collage/GjPW7OKDyO02MjeCDA1cavzfw5TiaWxcQTnsCmIY.jpg\";}}i:5;a:6:{s:4:\"slug\";s:9:\"lancaster\";s:5:\"title\";s:9:\"Lancaster\";s:4:\"kind\";s:7:\"project\";s:5:\"cover\";s:32:\"/images/work/lancaster-cover.jpg\";s:7:\"gallery\";s:69:\"/storage/gallery/collage/LgBmSKDPbHPS8sjYWptJdINjD4gXKoQvi9897gA9.jpg\";s:6:\"images\";a:12:{i:0;s:69:\"/storage/gallery/collage/LgBmSKDPbHPS8sjYWptJdINjD4gXKoQvi9897gA9.jpg\";i:1;s:69:\"/storage/gallery/collage/kgKAGM3ceV5qcUZgkEVrRaGGUunHdjkKTOZFJyzz.jpg\";i:2;s:69:\"/storage/gallery/collage/l5cDSQJ3VMgdupyCsE6i1aATkAqx9bCrLe2xQllf.jpg\";i:3;s:69:\"/storage/gallery/collage/HV7fNXZKTvUGwr9rU7BiyIn7tLsfnOxDqHXtVjxc.jpg\";i:4;s:69:\"/storage/gallery/collage/DIXXfmKEhcTBo13xqXMopd07Liwhbl6GBpOeXnrD.jpg\";i:5;s:69:\"/storage/gallery/collage/xvS6DdLIxjMKa42w6N8atdhLMs4zLEVreIN8FTe4.jpg\";i:6;s:69:\"/storage/gallery/collage/PDX4K0uToBeNfgcvIJmwJn4JuL3gfqebt6doNDNx.jpg\";i:7;s:69:\"/storage/gallery/collage/15oE2Cz4OaRupC5cQgJQPTRHHlrpd7UiugHraWkw.jpg\";i:8;s:69:\"/storage/gallery/collage/DXTL3BbkLNyV3K6mgoVlNLk1EGBXyCTJXH8q9uZo.jpg\";i:9;s:69:\"/storage/gallery/collage/aBb1EZOlch4Z2bXN3EYf5BIcRUkxz7XUgp6TMiVn.jpg\";i:10;s:69:\"/storage/gallery/collage/mcGMNJMwgBi5GsTfH1hWhTvp6y2tmq9Yfo7XWaJq.jpg\";i:11;s:69:\"/storage/gallery/collage/jTtdVRZW73FtbkHqSBuWZEdeP0UkvjL2MLo8RZ9S.jpg\";}}i:6;a:6:{s:4:\"slug\";s:11:\"multifamily\";s:5:\"title\";s:11:\"Multifamily\";s:4:\"kind\";s:8:\"category\";s:5:\"cover\";s:34:\"/images/work/multifamily-cover.jpg\";s:7:\"gallery\";s:69:\"/storage/gallery/collage/v4j592nbAnIietPTAB3gsJpJ90MQFlLMlPvSWVKV.jpg\";s:6:\"images\";a:12:{i:0;s:69:\"/storage/gallery/collage/v4j592nbAnIietPTAB3gsJpJ90MQFlLMlPvSWVKV.jpg\";i:1;s:69:\"/storage/gallery/collage/riiizuAWc6Qww1VSys1fnmiFC8GilatJ5ORLsjAA.jpg\";i:2;s:69:\"/storage/gallery/collage/msZWNedKT7Bcs1jLEUMn8V0uuvmwwHMjNFS3s2BJ.jpg\";i:3;s:69:\"/storage/gallery/collage/Q9MnveGsTMMQoX3AA0DmPkTyxxTZMbZpIGQTHnGo.jpg\";i:4;s:69:\"/storage/gallery/collage/DjztZ3vAXWfqkKIGcTW5P3TfVTbiakNoalBSihQW.jpg\";i:5;s:69:\"/storage/gallery/collage/kAUoJMACKrAnqLn5C0mCyjS1GSAeXnBquwSNsRH7.jpg\";i:6;s:69:\"/storage/gallery/collage/dh9CiFk4cOzshXxoyIcWlpGVlIyqjEC91gnhNDLZ.jpg\";i:7;s:69:\"/storage/gallery/collage/32LRZc0cqyp9P9KnDg8h6jY00GHL5cTQiJYTHoxY.jpg\";i:8;s:69:\"/storage/gallery/collage/8A5iltcEgJvFUx3y9SxOlDdr4Ti071fYQvpbZm5a.jpg\";i:9;s:69:\"/storage/gallery/collage/adzTPBkaejwqAROhYcFOE9Di3aETkbXOjkxuNyrD.jpg\";i:10;s:69:\"/storage/gallery/collage/Uir42vheLZMhnhS7CU4psgUmNZexOvddS9nVNCes.jpg\";i:11;s:69:\"/storage/gallery/collage/9cAhsttXacTDBGCwsv29IR4Fybj5TlwFmeKBkDdJ.jpg\";}}i:7;a:6:{s:4:\"slug\";s:16:\"2026-parade-home\";s:5:\"title\";s:16:\"2026 Parade Home\";s:4:\"kind\";s:7:\"project\";s:5:\"cover\";s:34:\"/images/work/parade-home-cover.jpg\";s:7:\"gallery\";s:69:\"/storage/gallery/collage/FRpzA05SnqgH5Q7eutkXyBBBlpHzc69qQgMRViHy.jpg\";s:6:\"images\";a:12:{i:0;s:69:\"/storage/gallery/collage/FRpzA05SnqgH5Q7eutkXyBBBlpHzc69qQgMRViHy.jpg\";i:1;s:69:\"/storage/gallery/collage/jTL59BMiEezaTGfeHa1gpVFPGps9hQhztyQDNcpR.jpg\";i:2;s:69:\"/storage/gallery/collage/MFvDCAxRXjl7mvWlTkPsukhL1pKb68Wbqk7couHq.jpg\";i:3;s:69:\"/storage/gallery/collage/Xy0rnYQA0q5SMJPXFvEjC4u65T2nkBIl8TPL33MK.jpg\";i:4;s:69:\"/storage/gallery/collage/kZDCZmWtqyUDwyUaMeHDhGByzmjBBxaHD7omG4PZ.jpg\";i:5;s:69:\"/storage/gallery/collage/b0SoGHFk9LBEJT9sDNgxuPfVLa1XdqT7r0AW0gKn.jpg\";i:6;s:69:\"/storage/gallery/collage/gexbKW09ppVTkaAK6UnSTO5dLiZ5OYGlV1RaWDiN.jpg\";i:7;s:69:\"/storage/gallery/collage/a18cYCvg70pEoQkRJTdiixMj7aSHXQr3nzGyfuNs.jpg\";i:8;s:69:\"/storage/gallery/collage/2VbHeP79xJyhZ3jz62GJW00OWyFiX01ByVZsLBeX.jpg\";i:9;s:69:\"/storage/gallery/collage/i5RhexybwWMHhf4vv2HTKsLdVmnk0aOH1FSzljEM.jpg\";i:10;s:69:\"/storage/gallery/collage/XsPEgFMclpANZosjMpFJmpAcbInw2wtI4Q2LeMiP.jpg\";i:11;s:69:\"/storage/gallery/collage/Tn8HGZRV74p5G39LVKyQpMJhBjJubdhEo4OFhkNt.jpg\";}}}s:14:\"instagramPosts\";a:12:{i:0;a:3:{s:3:\"src\";s:63:\"/storage/instagram/anBlfELNfINmuhXSTzW3oNAIHVDgFVNpEcT9UEeZ.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_3969\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:1;a:3:{s:3:\"src\";s:63:\"/storage/instagram/9OAlDwrLfMF26VN6rOto0XkIgG4tzXjVX1aP5uE6.png\";s:3:\"alt\";s:51:\"Creative Granite stone fabrication — DSC_3986 (1)\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:2;a:3:{s:3:\"src\";s:63:\"/storage/instagram/DKwzqhIEereEgleOHtNXGOkMSmPJd7zTwZwHEjId.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_4008\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:3;a:3:{s:3:\"src\";s:63:\"/storage/instagram/ZZX06vBxVYoye2HluDxojkossgMQwPXml4869aJF.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_4011\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:4;a:3:{s:3:\"src\";s:63:\"/storage/instagram/zIyaZ187u2ZriITnMt7FpvzCIWLwep2mi3AGxGT4.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_4068\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:5;a:3:{s:3:\"src\";s:63:\"/storage/instagram/KS9m6i5JNyQggk7kZMJJlBVJtqiGuRRF8M3vRpui.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_4165\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:6;a:3:{s:3:\"src\";s:63:\"/storage/instagram/zldxaAcJHRQUQyUdn8bbX9prx6orghG7WFRqIH9D.jpg\";s:3:\"alt\";s:51:\"Creative Granite stone fabrication — DSC_4181 (1)\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:7;a:3:{s:3:\"src\";s:63:\"/storage/instagram/AiwFpjHpPd6MmP6T4nuuStxu4aB5tnkRfd7jBBP1.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — DSC_4192\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:8;a:3:{s:3:\"src\";s:63:\"/storage/instagram/gHhwyfJigvobBMRz3NMaff9pObbnWsFUy0CfioXf.png\";s:3:\"alt\";s:51:\"Creative Granite stone fabrication — DSC_4204 (1)\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:9;a:3:{s:3:\"src\";s:63:\"/storage/instagram/WiPwf1Hnt8dRWtllv4nbQ6MRSywxDMi97UuZsoRh.jpg\";s:3:\"alt\";s:54:\"Creative Granite stone fabrication — Journeys End-12\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:10;a:3:{s:3:\"src\";s:63:\"/storage/instagram/tHUHGDfx8lXZOd4wpWnwfJ8pN62Dlotn5iq7WMDq.jpg\";s:3:\"alt\";s:50:\"Creative Granite stone fabrication — LakeLine-20\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:11;a:3:{s:3:\"src\";s:63:\"/storage/instagram/Yl7CxHvBzD5M3uhlWEHlRamMFjyEItvUyYHW3WzG.jpg\";s:3:\"alt\";s:47:\"Creative Granite stone fabrication — Sabal-24\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}}s:9:\"materials\";a:5:{i:0;a:21:{s:4:\"name\";s:7:\"Granite\";s:4:\"slug\";s:7:\"granite\";s:4:\"desc\";s:115:\"A durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.\";s:5:\"image\";s:23:\"/materials/granite.webp\";s:7:\"tagline\";s:37:\"Proven performance. Naturally unique.\";s:5:\"intro\";s:188:\"Granite has remained a trusted surface material for good reason. This natural stone offers excellent durability while providing tremendous variety in color, pattern, texture, and movement.\";s:9:\"whyChoose\";a:6:{i:0;s:35:\"Strong and durable for everyday use\";i:1;s:24:\"Naturally heat resistant\";i:2;s:33:\"Wide range of colors and patterns\";i:3;s:40:\"Every slab has its own natural variation\";i:4;s:73:\"Suitable for kitchens, bathrooms, fireplaces, and many other applications\";i:5;s:55:\"Relatively straightforward maintenance with proper care\";}s:16:\"whyChooseHeading\";N;s:10:\"whatToKnow\";s:237:\"Like other natural stones, granite is porous to varying degrees and may require periodic sealing. Individual varieties can differ in composition and appearance, so seeing and selecting the actual slab is an important part of the process.\";s:7:\"bestFor\";s:110:\"Clients wanting a durable natural surface with extensive design possibilities and relatively easy maintenance.\";s:12:\"careGuideUrl\";s:39:\"/downloads/natural-stone-care-guide.pdf\";s:14:\"careGuideLabel\";s:35:\"Natural Stone Care + Cleaning Guide\";s:10:\"ctaEyebrow\";s:19:\"Need help choosing?\";s:10:\"ctaHeading\";s:50:\"Not sure which material is right for your project?\";s:7:\"ctaBody\";s:332:\"The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.\";s:15:\"ctaPrimaryLabel\";s:15:\"Get an Estimate\";s:17:\"ctaSecondaryLabel\";s:10:\"Contact Us\";s:15:\"ctaSecondaryUrl\";s:8:\"/contact\";s:6:\"images\";a:0:{}s:9:\"sortOrder\";i:1;s:8:\"featured\";b:1;}i:1;a:21:{s:4:\"name\";s:6:\"Quartz\";s:4:\"slug\";s:6:\"quartz\";s:4:\"desc\";s:111:\"An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.\";s:5:\"image\";s:22:\"/materials/quartz.webp\";s:7:\"tagline\";s:36:\"Consistent design with everyday ease\";s:5:\"intro\";s:255:\"Quartz is an engineered surface designed to provide durability, consistency, and low-maintenance performance. Because its appearance is manufactured rather than naturally occurring, quartz offers more predictability in color and pattern from slab to slab.\";s:9:\"whyChoose\";a:6:{i:0;s:44:\"Nonporous and resistant to everyday staining\";i:1;s:24:\"Does not require sealing\";i:2;s:26:\"Easy to clean and maintain\";i:3;s:34:\"Broad range of colors and patterns\";i:4;s:45:\"More consistent appearance than natural stone\";i:5;s:72:\"Available in designs ranging from subtle and minimal to dramatic veining\";}s:16:\"whyChooseHeading\";N;s:10:\"whatToKnow\";s:269:\"Unlike natural stone, quartz contains resins and should be protected from excessive heat. Trivets or heat protection should be used beneath hot cookware. Because quartz is engineered, it also won\'t have the same natural variation found in marble, granite, or quartzite.\";s:7:\"bestFor\";s:83:\"Clients who value low maintenance, consistency, and a wide range of design options.\";s:12:\"careGuideUrl\";s:32:\"/downloads/quartz-care-guide.pdf\";s:14:\"careGuideLabel\";s:28:\"Quartz Care + Cleaning Guide\";s:10:\"ctaEyebrow\";s:19:\"Need help choosing?\";s:10:\"ctaHeading\";s:50:\"Not sure which material is right for your project?\";s:7:\"ctaBody\";s:332:\"The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.\";s:15:\"ctaPrimaryLabel\";s:15:\"Get an Estimate\";s:17:\"ctaSecondaryLabel\";s:10:\"Contact Us\";s:15:\"ctaSecondaryUrl\";s:8:\"/contact\";s:6:\"images\";a:0:{}s:9:\"sortOrder\";i:2;s:8:\"featured\";b:1;}i:2;a:21:{s:4:\"name\";s:6:\"Marble\";s:4:\"slug\";s:6:\"marble\";s:4:\"desc\";s:103:\"A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.\";s:5:\"image\";s:22:\"/materials/marble.webp\";s:7:\"tagline\";s:40:\"Natural beauty with centuries of history\";s:5:\"intro\";s:233:\"Marble is a natural stone celebrated for its distinctive veining, depth, and timeless character. No two slabs are exactly alike, making it a beautiful choice for spaces where the material itself is meant to become part of the design.\";s:9:\"whyChoose\";a:5:{i:0;s:43:\"One-of-a-kind natural veining and variation\";i:1;s:74:\"Available in subtle, classic patterns as well as dramatic statement stones\";i:2;s:24:\"Naturally heat resistant\";i:3;s:39:\"Develops character and patina over time\";i:4;s:92:\"Beautiful for countertops, vanities, fireplaces, walls, and other architectural applications\";}s:16:\"whyChooseHeading\";N;s:10:\"whatToKnow\";s:292:\"Marble is naturally porous and can be more susceptible to staining, scratching, and etching from acidic substances than some other surfaces. Sealing and proper care help protect the stone, but clients choosing marble should be comfortable with the natural evolution of the material over time.\";s:7:\"bestFor\";s:133:\"Clients who prioritize natural character, movement, and timeless design and are comfortable with a surface that may develop a patina.\";s:12:\"careGuideUrl\";s:39:\"/downloads/natural-stone-care-guide.pdf\";s:14:\"careGuideLabel\";s:35:\"Natural Stone Care + Cleaning Guide\";s:10:\"ctaEyebrow\";s:19:\"Need help choosing?\";s:10:\"ctaHeading\";s:50:\"Not sure which material is right for your project?\";s:7:\"ctaBody\";s:332:\"The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.\";s:15:\"ctaPrimaryLabel\";s:15:\"Get an Estimate\";s:17:\"ctaSecondaryLabel\";s:10:\"Contact Us\";s:15:\"ctaSecondaryUrl\";s:8:\"/contact\";s:6:\"images\";a:0:{}s:9:\"sortOrder\";i:3;s:8:\"featured\";b:0;}i:3;a:21:{s:4:\"name\";s:9:\"Quartzite\";s:4:\"slug\";s:9:\"quartzite\";s:4:\"desc\";s:107:\"A natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces.\";s:5:\"image\";s:25:\"/materials/quartzite.webp\";s:7:\"tagline\";s:38:\"Natural stone with beauty and strength\";s:5:\"intro\";s:262:\"Quartzite is a natural stone known for combining striking movement with impressive durability. Its veining and coloration can create the appearance of marble while offering performance characteristics that make many quartzites well suited for hardworking spaces.\";s:9:\"whyChoose\";a:5:{i:0;s:59:\"Naturally occurring and completely unique from slab to slab\";i:1;s:52:\"Often features dramatic veining, movement, and depth\";i:2;s:46:\"Generally highly durable and scratch resistant\";i:3;s:24:\"Naturally heat resistant\";i:4;s:91:\"Works beautifully across kitchens, bathrooms, fireplaces, walls, and statement applications\";}s:16:\"whyChooseHeading\";N;s:10:\"whatToKnow\";s:209:\"Because quartzite is a natural stone, characteristics including porosity, hardness, and maintenance needs can vary between specific materials. Proper sealing and care may be recommended depending on the stone.\";s:7:\"bestFor\";s:102:\"Clients looking for the individuality of natural stone with an emphasis on durability and performance.\";s:12:\"careGuideUrl\";s:39:\"/downloads/natural-stone-care-guide.pdf\";s:14:\"careGuideLabel\";s:35:\"Natural Stone Care + Cleaning Guide\";s:10:\"ctaEyebrow\";s:19:\"Need help choosing?\";s:10:\"ctaHeading\";s:50:\"Not sure which material is right for your project?\";s:7:\"ctaBody\";s:332:\"The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.\";s:15:\"ctaPrimaryLabel\";s:15:\"Get an Estimate\";s:17:\"ctaSecondaryLabel\";s:10:\"Contact Us\";s:15:\"ctaSecondaryUrl\";s:8:\"/contact\";s:6:\"images\";a:0:{}s:9:\"sortOrder\";i:4;s:8:\"featured\";b:0;}i:4;a:21:{s:4:\"name\";s:20:\"Additional Materials\";s:4:\"slug\";s:20:\"additional-materials\";s:4:\"desc\";s:120:\"Porcelain and other specialty surfaces available by request for projects that need something beyond the core collection.\";s:5:\"image\";s:23:\"/materials/granite.webp\";s:7:\"tagline\";s:26:\"Beyond the Core Collection\";s:5:\"intro\";s:245:\"Creative Granite + Design also works with porcelain and can special order additional surface materials based on the needs of the project. If a client is looking for a specific material or application, our team can help explore available options.\";s:9:\"whyChoose\";a:4:{i:0;s:60:\"Porcelain surfaces for modern, high-performance applications\";i:1;s:53:\"Special-order materials based on project requirements\";i:2;s:54:\"Guidance from our team on suitability and availability\";i:3;s:60:\"Support for unique design directions and custom applications\";}s:16:\"whyChooseHeading\";N;s:10:\"whatToKnow\";s:170:\"Availability, lead times, and performance characteristics can vary by material. Our team can help review options and determine what makes sense for your specific project.\";s:7:\"bestFor\";s:96:\"Clients exploring porcelain, specialty surfaces, or materials outside the core stone collection.\";s:12:\"careGuideUrl\";N;s:14:\"careGuideLabel\";N;s:10:\"ctaEyebrow\";s:19:\"Need help choosing?\";s:10:\"ctaHeading\";s:50:\"Not sure which material is right for your project?\";s:7:\"ctaBody\";s:332:\"The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.\";s:15:\"ctaPrimaryLabel\";s:15:\"Get an Estimate\";s:17:\"ctaSecondaryLabel\";s:10:\"Contact Us\";s:15:\"ctaSecondaryUrl\";s:8:\"/contact\";s:6:\"images\";a:0:{}s:9:\"sortOrder\";i:5;s:8:\"featured\";b:0;}}s:17:\"productCategories\";a:0:{}s:8:\"products\";a:25:{i:0;a:18:{s:4:\"name\";s:11:\"ESI-S380-16\";s:4:\"slug\";s:11:\"esi-s380-16\";s:5:\"model\";s:11:\"ESI-S380-16\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Large single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"16\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:29:\"31-1/2\" x 18-1/4\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:132:\"Custom fit sink grid (ESI-S380-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)\";s:7:\"excerpt\";s:17:\"Large single bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/UPmE1wRTu3m9YfdAf2deqRowVSVLw32ZiHhNASsm.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/UPmE1wRTu3m9YfdAf2deqRowVSVLw32ZiHhNASsm.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:1;a:18:{s:4:\"name\";s:11:\"ESI-S360-16\";s:4:\"slug\";s:11:\"esi-s360-16\";s:5:\"model\";s:11:\"ESI-S360-16\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"60/40 double bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"16\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:34:\"31-3/4\" x 20-5/8\" O.D. x 9\" / 7\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:133:\"Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)\";s:7:\"excerpt\";s:17:\"60/40 double bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/IPlatQDFAweCddRphfGgujkXp4fpPtVjX6NDcaJD.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/IPlatQDFAweCddRphfGgujkXp4fpPtVjX6NDcaJD.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:2;a:18:{s:4:\"name\";s:12:\"ESI-S360R-16\";s:4:\"slug\";s:12:\"esi-s360r-16\";s:5:\"model\";s:12:\"ESI-S360R-16\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"40/60 double bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"16\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:34:\"31-3/4\" x 20-5/8\" O.D. x 7\" / 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:133:\"Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)\";s:7:\"excerpt\";s:17:\"40/60 double bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/Mtz3C7gvmIBJHcVpKOfJHuNYyfh5Yq5XzFC1xkyV.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/Mtz3C7gvmIBJHcVpKOfJHuNYyfh5Yq5XzFC1xkyV.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:3;a:18:{s:4:\"name\";s:11:\"ESI-S330-18\";s:4:\"slug\";s:11:\"esi-s330-18\";s:5:\"model\";s:11:\"ESI-S330-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Small single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:25:\"16-1/2\" x 18\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:67:\"Custom fit sink grid; silicone cutting board; strainer; drain cover\";s:7:\"excerpt\";s:17:\"Small single bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/M7CFK0rnKJWmPLpyQ0uPSkBrYJKL0GyeqHe2yjwH.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/M7CFK0rnKJWmPLpyQ0uPSkBrYJKL0GyeqHe2yjwH.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:4;a:18:{s:4:\"name\";s:11:\"ESI-S320-18\";s:4:\"slug\";s:11:\"esi-s320-18\";s:5:\"model\";s:11:\"ESI-S320-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Small single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:21:\"16\" x 16\" O.D. x 8\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:67:\"Custom fit sink grid; silicone cutting board; strainer; drain cover\";s:7:\"excerpt\";s:17:\"Small single bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/nS5cuL3evBxXs5GA4o8VKlrZRvUUmLvxSNA4xidK.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/nS5cuL3evBxXs5GA4o8VKlrZRvUUmLvxSNA4xidK.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:5;a:18:{s:4:\"name\";s:11:\"ESI-S310-18\";s:4:\"slug\";s:11:\"esi-s310-18\";s:5:\"model\";s:11:\"ESI-S310-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Small single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:25:\"12-5/8\" x 15\" O.D. x 7\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:67:\"Custom fit sink grid; silicone cutting board; strainer; drain cover\";s:7:\"excerpt\";s:17:\"Small single bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/D3zwJQwzuttH9tNMjun4Z9sl1vj4WW3qXABNTRtH.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/D3zwJQwzuttH9tNMjun4Z9sl1vj4WW3qXABNTRtH.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:6;a:18:{s:4:\"name\";s:11:\"ESI-S225-18\";s:4:\"slug\";s:11:\"esi-s225-18\";s:5:\"model\";s:11:\"ESI-S225-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:27:\"50/50 double bowl, handmade\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:26:\"31\" x 18\" O.D. x 9\" / 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:27:\"50/50 double bowl, handmade\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/wjyhnGGV1PDTiL4fIx6tRyJjb1U6CNUJFVOsb3W5.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/wjyhnGGV1PDTiL4fIx6tRyJjb1U6CNUJFVOsb3W5.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:7;a:18:{s:4:\"name\";s:11:\"ESI-S275-18\";s:4:\"slug\";s:11:\"esi-s275-18\";s:5:\"model\";s:11:\"ESI-S275-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:27:\"Large single bowl, handmade\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:31:\"31-13/16\" x 18-1/8\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:27:\"Large single bowl, handmade\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/5o1YKQ441JepOhXf65SNRzPBk99WOKyClrbf2Ckz.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/5o1YKQ441JepOhXf65SNRzPBk99WOKyClrbf2Ckz.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:8;a:18:{s:4:\"name\";s:11:\"ESI-S270-18\";s:4:\"slug\";s:11:\"esi-s270-18\";s:5:\"model\";s:11:\"ESI-S270-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:27:\"40/60 double bowl, handmade\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:36:\"31-1/4\" x 20-13/16\" O.D. x 7\" / 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:27:\"40/60 double bowl, handmade\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/KvmK8RtkePVt1o0afLPgfuKNNePOsoET9XgW8vBY.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/KvmK8RtkePVt1o0afLPgfuKNNePOsoET9XgW8vBY.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:9;a:18:{s:4:\"name\";s:11:\"ESI-S265-18\";s:4:\"slug\";s:11:\"esi-s265-18\";s:5:\"model\";s:11:\"ESI-S265-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:27:\"60/40 double bowl, handmade\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:36:\"31-1/4\" x 20-13/16\" O.D. x 9\" / 7\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:27:\"60/40 double bowl, handmade\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/FgKbp6e8OVEqzZsb5grxBp4PcmL7e9AOQWSFxrAq.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/FgKbp6e8OVEqzZsb5grxBp4PcmL7e9AOQWSFxrAq.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:10;a:18:{s:4:\"name\";s:11:\"ESI-S210-18\";s:4:\"slug\";s:11:\"esi-s210-18\";s:5:\"model\";s:11:\"ESI-S210-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:18:\"Medium single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:21:\"23\" x 18\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:18:\"Medium single bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/o2SgJi9ex5Ih0ln4qhjdTe203TDJWnt5SEZPYQ3o.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/o2SgJi9ex5Ih0ln4qhjdTe203TDJWnt5SEZPYQ3o.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:11;a:18:{s:4:\"name\";s:11:\"ESI-S200-18\";s:4:\"slug\";s:11:\"esi-s200-18\";s:5:\"model\";s:11:\"ESI-S200-18\";s:8:\"material\";s:15:\"Stainless Steel\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:27:\"Small single bowl, handmade\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";s:2:\"18\";s:12:\"construction\";s:10:\"Type 304SS\";s:10:\"dimensions\";s:29:\"17-1/8\" x 15-1/4\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:15:\"Stainless Steel\";s:19:\"optionalAccessories\";s:30:\"Not shown on photographed page\";s:7:\"excerpt\";s:27:\"Small single bowl, handmade\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/t6i8t7BEMICU0okzVOJMtUZMxRgRJXoqBZ7AZmwj.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/t6i8t7BEMICU0okzVOJMtUZMxRgRJXoqBZ7AZmwj.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:12;a:18:{s:4:\"name\";s:8:\"ESI-VC12\";s:4:\"slug\";s:8:\"esi-vc12\";s:5:\"model\";s:8:\"ESI-VC12\";s:8:\"material\";s:9:\"Porcelain\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Small oval vanity\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:9:\"Porcelain\";s:10:\"dimensions\";s:21:\"15\" x 12\" I.D. x 6\" D\";s:12:\"colorsFinish\";s:13:\"White; Bisque\";s:19:\"optionalAccessories\";s:9:\"Not shown\";s:7:\"excerpt\";s:17:\"Small oval vanity\";s:4:\"body\";N;s:5:\"image\";s:25:\"/images/products/VC12.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:25:\"/images/products/VC12.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:13;a:18:{s:4:\"name\";s:8:\"ESI-VC10\";s:4:\"slug\";s:8:\"esi-vc10\";s:5:\"model\";s:8:\"ESI-VC10\";s:8:\"material\";s:9:\"Porcelain\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:17:\"Large oval vanity\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:9:\"Porcelain\";s:10:\"dimensions\";s:29:\"17-1/4\" x 14\" I.D. x 6-1/4\" D\";s:12:\"colorsFinish\";s:13:\"White; Bisque\";s:19:\"optionalAccessories\";s:9:\"Not shown\";s:7:\"excerpt\";s:17:\"Large oval vanity\";s:4:\"body\";N;s:5:\"image\";s:25:\"/images/products/VC10.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:25:\"/images/products/VC10.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:14;a:18:{s:4:\"name\";s:9:\"ESI-VCR50\";s:4:\"slug\";s:9:\"esi-vcr50\";s:5:\"model\";s:9:\"ESI-VCR50\";s:8:\"material\";s:9:\"Porcelain\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:30:\"Small rectangle (eased) vanity\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:9:\"Porcelain\";s:10:\"dimensions\";s:21:\"16\" x 11\" I.D. x 6\" D\";s:12:\"colorsFinish\";s:13:\"White; Bisque\";s:19:\"optionalAccessories\";s:9:\"Not shown\";s:7:\"excerpt\";s:30:\"Small rectangle (eased) vanity\";s:4:\"body\";N;s:5:\"image\";s:25:\"/images/products/VC50.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:25:\"/images/products/VC50.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:15;a:18:{s:4:\"name\";s:9:\"ESI-VCR60\";s:4:\"slug\";s:9:\"esi-vcr60\";s:5:\"model\";s:9:\"ESI-VCR60\";s:8:\"material\";s:9:\"Porcelain\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:30:\"Large rectangle (eased) vanity\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:9:\"Porcelain\";s:10:\"dimensions\";s:21:\"18\" x 13\" I.D. x 6\" D\";s:12:\"colorsFinish\";s:13:\"White; Bisque\";s:19:\"optionalAccessories\";s:9:\"Not shown\";s:7:\"excerpt\";s:30:\"Large rectangle (eased) vanity\";s:4:\"body\";N;s:5:\"image\";s:25:\"/images/products/VC60.png\";s:6:\"images\";a:1:{i:0;a:3:{s:3:\"src\";s:25:\"/images/products/VC60.png\";s:3:\"alt\";s:8:\"Standard\";s:5:\"label\";s:8:\"Standard\";}}s:13:\"relatedImages\";a:0:{}}i:16;a:18:{s:4:\"name\";s:11:\"ESI-FCMOD33\";s:4:\"slug\";s:11:\"esi-fcmod33\";s:5:\"model\";s:11:\"ESI-FCMOD33\";s:8:\"material\";s:8:\"Fireclay\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:33:\"33-inch modern smooth single bowl\";s:5:\"mount\";s:11:\"Apron-front\";s:5:\"gauge\";N;s:12:\"construction\";s:8:\"Fireclay\";s:10:\"dimensions\";s:22:\"33\" x 19\" O.D. x 10\" D\";s:12:\"colorsFinish\";s:21:\"White; Matte Charcoal\";s:19:\"optionalAccessories\";s:34:\"Custom sink grid (ESI-FCMOD33-GRD)\";s:7:\"excerpt\";s:33:\"33-inch modern smooth single bowl\";s:4:\"body\";N;s:5:\"image\";s:52:\"/images/products/FC-MOD-33-WHITE13520010120.PT00.png\";s:6:\"images\";a:3:{i:0;a:3:{s:3:\"src\";s:52:\"/images/products/FC-MOD-33-WHITE13520010120.PT00.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:56:\"/images/products/FC-MOD-33-MATTEGRAY13520200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}i:2;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/KBS9jIrwZ1Cv5cjjaDOfuHNihbF3xvotscTMRm0s.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}}s:13:\"relatedImages\";a:2:{i:0;a:3:{s:3:\"src\";s:56:\"/images/products/FC-MOD-33-MATTEGRAY13520200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/KBS9jIrwZ1Cv5cjjaDOfuHNihbF3xvotscTMRm0s.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}}}i:17;a:18:{s:4:\"name\";s:12:\"ESI-FCCL332D\";s:4:\"slug\";s:12:\"esi-fccl332d\";s:5:\"model\";s:12:\"ESI-FCCL332D\";s:8:\"material\";s:8:\"Fireclay\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:34:\"33-inch classic smooth double bowl\";s:5:\"mount\";s:11:\"Apron-front\";s:5:\"gauge\";N;s:12:\"construction\";s:8:\"Fireclay\";s:10:\"dimensions\";s:28:\"33\" x 18\" O.D. x 10\" / 10\" D\";s:12:\"colorsFinish\";s:21:\"White; Matte Charcoal\";s:19:\"optionalAccessories\";s:35:\"Custom sink grid (ESI-FCCL332D-GRD)\";s:7:\"excerpt\";s:34:\"33-inch classic smooth double bowl\";s:4:\"body\";N;s:5:\"image\";s:53:\"/images/products/FC-CL-332-DBL-WHITE1139-001-0120.png\";s:6:\"images\";a:2:{i:0;a:3:{s:3:\"src\";s:53:\"/images/products/FC-CL-332-DBL-WHITE1139-001-0120.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/gbyScX9ScOjOToNNHfXAJc30Cl8Xg2eYJjrhTixA.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}s:13:\"relatedImages\";a:1:{i:0;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/gbyScX9ScOjOToNNHfXAJc30Cl8Xg2eYJjrhTixA.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}}i:18;a:18:{s:4:\"name\";s:11:\"ESI-FCMOD36\";s:4:\"slug\";s:11:\"esi-fcmod36\";s:5:\"model\";s:11:\"ESI-FCMOD36\";s:8:\"material\";s:8:\"Fireclay\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:33:\"36-inch modern smooth single bowl\";s:5:\"mount\";s:11:\"Apron-front\";s:5:\"gauge\";N;s:12:\"construction\";s:8:\"Fireclay\";s:10:\"dimensions\";s:22:\"36\" x 19\" O.D. x 10\" D\";s:12:\"colorsFinish\";s:21:\"White; Matte Charcoal\";s:19:\"optionalAccessories\";s:34:\"Custom sink grid (ESI-FCMOD36-GRD)\";s:7:\"excerpt\";s:33:\"36-inch modern smooth single bowl\";s:4:\"body\";N;s:5:\"image\";s:41:\"/images/products/FC-MOD-36-WHITE.PT00.png\";s:6:\"images\";a:2:{i:0;a:3:{s:3:\"src\";s:41:\"/images/products/FC-MOD-36-WHITE.PT00.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:56:\"/images/products/FC-MOD-36-MATTEGRAY13540200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}s:13:\"relatedImages\";a:1:{i:0;a:3:{s:3:\"src\";s:56:\"/images/products/FC-MOD-36-MATTEGRAY13540200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}}i:19;a:18:{s:4:\"name\";s:13:\"ESI-FCMOD362D\";s:4:\"slug\";s:13:\"esi-fcmod362d\";s:5:\"model\";s:13:\"ESI-FCMOD362D\";s:8:\"material\";s:8:\"Fireclay\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:33:\"36-inch modern smooth double bowl\";s:5:\"mount\";s:11:\"Apron-front\";s:5:\"gauge\";N;s:12:\"construction\";s:8:\"Fireclay\";s:10:\"dimensions\";s:28:\"36\" x 19\" O.D. x 10\" / 10\" D\";s:12:\"colorsFinish\";s:21:\"White; Matte Charcoal\";s:19:\"optionalAccessories\";s:36:\"Custom sink grid (ESI-FCMOD362D-GRD)\";s:7:\"excerpt\";s:33:\"36-inch modern smooth double bowl\";s:4:\"body\";N;s:5:\"image\";s:57:\"/images/products/FC-MOD-362-DBL-WHITE13500010120.PT00.png\";s:6:\"images\";a:2:{i:0;a:3:{s:3:\"src\";s:57:\"/images/products/FC-MOD-362-DBL-WHITE13500010120.PT00.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:61:\"/images/products/FC-MOD-362-DBL-MATTEGRAY13500200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}s:13:\"relatedImages\";a:1:{i:0;a:3:{s:3:\"src\";s:61:\"/images/products/FC-MOD-362-DBL-MATTEGRAY13500200120.PT00.png\";s:3:\"alt\";s:14:\"Matte Charcoal\";s:5:\"label\";s:14:\"Matte Charcoal\";}}}i:20;a:18:{s:4:\"name\";s:10:\"ESI-QS1000\";s:4:\"slug\";s:10:\"esi-qs1000\";s:5:\"model\";s:10:\"ESI-QS1000\";s:8:\"material\";s:16:\"Quartz Composite\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:25:\"32-inch large single bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:16:\"Quartz composite\";s:10:\"dimensions\";s:21:\"32\" x 19\" O.D. x 9\" D\";s:12:\"colorsFinish\";s:36:\"White; Black; Mocha; Concrete; Beige\";s:19:\"optionalAccessories\";s:72:\"Custom fit sink grid; matching strainer basket; matching disposal flange\";s:7:\"excerpt\";s:25:\"32-inch large single bowl\";s:4:\"body\";N;s:5:\"image\";s:31:\"/images/products/1000 White.png\";s:6:\"images\";a:5:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/1000 White.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Black.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:2;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:3;a:3:{s:3:\"src\";s:34:\"/images/products/1000 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:4;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}}s:13:\"relatedImages\";a:4:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Black.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:1;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:2;a:3:{s:3:\"src\";s:34:\"/images/products/1000 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:3;a:3:{s:3:\"src\";s:31:\"/images/products/1000 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}}}i:21;a:18:{s:4:\"name\";s:10:\"ESI-QS5050\";s:4:\"slug\";s:10:\"esi-qs5050\";s:5:\"model\";s:10:\"ESI-QS5050\";s:8:\"material\";s:16:\"Quartz Composite\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:31:\"32-inch 50/50 double equal bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:16:\"Quartz composite\";s:10:\"dimensions\";s:26:\"32\" x 19\" O.D. x 9\" / 9\" D\";s:12:\"colorsFinish\";s:36:\"White; Black; Mocha; Concrete; Beige\";s:19:\"optionalAccessories\";s:73:\"Custom fit sink grids; matching strainer basket; matching disposal flange\";s:7:\"excerpt\";s:31:\"32-inch 50/50 double equal bowl\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/CtxYuACm6IkWTe7RD5hAzbtzEwEtDc8kZXMXodML.png\";s:6:\"images\";a:5:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/CtxYuACm6IkWTe7RD5hAzbtzEwEtDc8kZXMXodML.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/nGKwJKUI2IXpfFnrUqgPXampRsghyaWNxIqMhJvt.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:2;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/AWBkAZPZaXA3dqLJp2q2MwVODu6DGSZTQs18eebE.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:3;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/vusUBfNDVjEdVLilDLQGc8GLPzxitUFCJWQocjnV.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:4;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/tGbnmtYqlg9ruLu7nIWXYYjd8DYBQaNJspRYjn03.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}}s:13:\"relatedImages\";a:4:{i:0;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/nGKwJKUI2IXpfFnrUqgPXampRsghyaWNxIqMhJvt.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/AWBkAZPZaXA3dqLJp2q2MwVODu6DGSZTQs18eebE.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:2;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/vusUBfNDVjEdVLilDLQGc8GLPzxitUFCJWQocjnV.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:3;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/tGbnmtYqlg9ruLu7nIWXYYjd8DYBQaNJspRYjn03.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}}}i:22;a:18:{s:4:\"name\";s:10:\"ESI-QS6040\";s:4:\"slug\";s:10:\"esi-qs6040\";s:5:\"model\";s:10:\"ESI-QS6040\";s:8:\"material\";s:16:\"Quartz Composite\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:30:\"32-inch 60/40 large/small bowl\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:16:\"Quartz composite\";s:10:\"dimensions\";s:30:\"32\" x 19\" O.D. x 9\" / 7-1/2\" D\";s:12:\"colorsFinish\";s:36:\"White; Black; Mocha; Concrete; Beige\";s:19:\"optionalAccessories\";s:73:\"Custom fit sink grids; matching strainer basket; matching disposal flange\";s:7:\"excerpt\";s:30:\"32-inch 60/40 large/small bowl\";s:4:\"body\";N;s:5:\"image\";s:31:\"/images/products/6040 Black.png\";s:6:\"images\";a:5:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/6040 Black.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:1;a:3:{s:3:\"src\";s:31:\"/images/products/6040 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:2;a:3:{s:3:\"src\";s:34:\"/images/products/6040 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:3;a:3:{s:3:\"src\";s:31:\"/images/products/6040 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:4;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/Dp2GCucjnFQYDF7xCgDdW1vja0UxexZH8W4jKx4F.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}}s:13:\"relatedImages\";a:4:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/6040 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:1;a:3:{s:3:\"src\";s:34:\"/images/products/6040 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:2;a:3:{s:3:\"src\";s:31:\"/images/products/6040 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:3;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/Dp2GCucjnFQYDF7xCgDdW1vja0UxexZH8W4jKx4F.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}}}i:23;a:18:{s:4:\"name\";s:10:\"ESI-QS1618\";s:4:\"slug\";s:10:\"esi-qs1618\";s:5:\"model\";s:10:\"ESI-QS1618\";s:8:\"material\";s:16:\"Quartz Composite\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:40:\"16-1/2-inch small single bowl / bar sink\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:16:\"Quartz composite\";s:10:\"dimensions\";s:25:\"16-1/2\" x 18\" O.D. x 8\" D\";s:12:\"colorsFinish\";s:36:\"White; Black; Mocha; Concrete; Beige\";s:19:\"optionalAccessories\";s:72:\"Custom fit sink grid; matching strainer basket; matching disposal flange\";s:7:\"excerpt\";s:40:\"16-1/2-inch small single bowl / bar sink\";s:4:\"body\";N;s:5:\"image\";s:62:\"/storage/products/JcsvidqQqnY0nWwNt9cjFX41BmLukytLrMAmorqv.png\";s:6:\"images\";a:5:{i:0;a:3:{s:3:\"src\";s:62:\"/storage/products/JcsvidqQqnY0nWwNt9cjFX41BmLukytLrMAmorqv.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/5MMo4glZyJSKnBmGg1xBTxmWALGhQOyZb4BjjUmh.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:2;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/F3aha3IhBZuNrDMUQrInwTKM1RrltENTMmC6RKVY.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:3;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/yBTDT4Gnh3jptmrHQkeve9kgpUTOoDSMBQCpt7TP.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:4;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/u4vgLhmLNiFN7OQvKLxX0I0eQrYQj3N0JC6bH23Z.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}}s:13:\"relatedImages\";a:4:{i:0;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/5MMo4glZyJSKnBmGg1xBTxmWALGhQOyZb4BjjUmh.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}i:1;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/F3aha3IhBZuNrDMUQrInwTKM1RrltENTMmC6RKVY.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:2;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/yBTDT4Gnh3jptmrHQkeve9kgpUTOoDSMBQCpt7TP.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:3;a:3:{s:3:\"src\";s:71:\"/storage/products/variants/u4vgLhmLNiFN7OQvKLxX0I0eQrYQj3N0JC6bH23Z.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}}}i:24;a:18:{s:4:\"name\";s:10:\"ESI-QS2318\";s:4:\"slug\";s:10:\"esi-qs2318\";s:5:\"model\";s:10:\"ESI-QS2318\";s:8:\"material\";s:16:\"Quartz Composite\";s:10:\"categoryId\";N;s:12:\"categorySlug\";N;s:15:\"bowlDescription\";s:42:\"23-inch medium single bowl kitchen/utility\";s:5:\"mount\";s:10:\"Undermount\";s:5:\"gauge\";N;s:12:\"construction\";s:16:\"Quartz composite\";s:10:\"dimensions\";s:25:\"23\" x 18\" O.D. x 8-1/2\" D\";s:12:\"colorsFinish\";s:36:\"White; Black; Mocha; Concrete; Beige\";s:19:\"optionalAccessories\";s:72:\"Custom fit sink grid; matching strainer basket; matching disposal flange\";s:7:\"excerpt\";s:42:\"23-inch medium single bowl kitchen/utility\";s:4:\"body\";N;s:5:\"image\";s:31:\"/images/products/2318 White.png\";s:6:\"images\";a:5:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/2318 White.png\";s:3:\"alt\";s:5:\"White\";s:5:\"label\";s:5:\"White\";}i:1;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Black.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:2;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:3;a:3:{s:3:\"src\";s:34:\"/images/products/2318 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:4;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}}s:13:\"relatedImages\";a:4:{i:0;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Black.png\";s:3:\"alt\";s:5:\"Black\";s:5:\"label\";s:5:\"Black\";}i:1;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Mocha.png\";s:3:\"alt\";s:5:\"Mocha\";s:5:\"label\";s:5:\"Mocha\";}i:2;a:3:{s:3:\"src\";s:34:\"/images/products/2318 Concrete.png\";s:3:\"alt\";s:8:\"Concrete\";s:5:\"label\";s:8:\"Concrete\";}i:3;a:3:{s:3:\"src\";s:31:\"/images/products/2318 Beige.png\";s:3:\"alt\";s:5:\"Beige\";s:5:\"label\";s:5:\"Beige\";}}}}s:8:\"services\";a:3:{i:0;a:5:{s:5:\"title\";s:30:\"New Construction & Residential\";s:4:\"slug\";s:16:\"new-construction\";s:7:\"excerpt\";s:177:\"Stone fabrication for new builds, working closely with builders, designers, and project teams to ensure accuracy, efficiency, and consistency from planning through installation.\";s:4:\"body\";s:184:\"<p>Stone fabrication for new builds, working closely with builders, designers, and project teams to ensure accuracy, efficiency, and consistency from planning through installation.</p>\";s:9:\"mainImage\";N;}i:1;a:5:{s:5:\"title\";s:20:\"Remodel & Renovation\";s:4:\"slug\";s:18:\"remodel-renovation\";s:7:\"excerpt\";s:128:\"Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.\";s:4:\"body\";s:128:\"Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.\";s:9:\"mainImage\";N;}i:2;a:5:{s:5:\"title\";s:24:\"Multifamily & Commercial\";s:4:\"slug\";s:22:\"multifamily-commercial\";s:7:\"excerpt\";s:189:\"Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient xecution, consistent quality, and dependable delivery.\";s:4:\"body\";s:189:\"Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient xecution, consistent quality, and dependable delivery.\";s:9:\"mainImage\";N;}}s:12:\"servicesPage\";a:7:{s:7:\"eyebrow\";s:8:\"Services\";s:7:\"heading\";s:49:\"Stone Fabrication for Every Stage of Your Project\";s:4:\"body\";s:141:\"From custom homes and remodels to multifamily and commercial spaces, we fabricate, install, and support premium stone surfaces built to last.\";s:9:\"heroImage\";s:68:\"/storage/services-page/DDssHKzQdNGijsu6kQkA1IpTJ8fVood6YNvoq6Vt.webp\";s:8:\"sections\";a:3:{i:0;a:5:{s:6:\"number\";s:2:\"01\";s:5:\"title\";s:30:\"New Construction & Residential\";s:4:\"body\";s:149:\"Partnering with builders, designers, and homeowners to fabricate and install custom stone surfaces with precision from planning through installation.\";s:4:\"hero\";s:42:\"/images/services/new-construction-hero.jpg\";s:10:\"supporting\";a:3:{i:0;s:39:\"/images/services/new-construction-1.jpg\";i:1;s:39:\"/images/services/new-construction-2.jpg\";i:2;s:39:\"/images/services/new-construction-3.jpg\";}}i:1;a:5:{s:6:\"number\";s:2:\"02\";s:5:\"title\";s:20:\"Remodel & Renovation\";s:4:\"body\";s:116:\"Transform kitchens, bathrooms, fireplaces, and living spaces with expertly fabricated stone tailored to your vision.\";s:4:\"hero\";s:33:\"/images/services/remodel-hero.png\";s:10:\"supporting\";a:3:{i:0;s:30:\"/images/services/remodel-1.jpg\";i:1;s:30:\"/images/services/remodel-2.jpg\";i:2;s:30:\"/images/services/remodel-3.jpg\";}}i:2;a:5:{s:6:\"number\";s:2:\"03\";s:5:\"title\";s:24:\"Multifamily & Commercial\";s:4:\"body\";s:143:\"Reliable stone fabrication and installation for multifamily developments, hospitality, retail, healthcare, office, and commercial environments.\";s:4:\"hero\";s:36:\"/images/services/commercial-hero.jpg\";s:10:\"supporting\";a:3:{i:0;s:33:\"/images/services/commercial-1.jpg\";i:1;s:33:\"/images/services/commercial-2.jpg\";i:2;s:33:\"/images/services/commercial-3.jpg\";}}}s:7:\"repairs\";a:11:{s:6:\"number\";s:2:\"04\";s:7:\"eyebrow\";s:18:\"Repairs & Warranty\";s:7:\"heading\";s:31:\"Stand Behind Every Installation\";s:4:\"body\";s:180:\"Our commitment doesn\'t end after installation. We provide warranty support for qualifying workmanship and offer repair services to help keep your stone surfaces looking their best.\";s:5:\"image\";s:41:\"/images/services/repairs-hero-voyager.png\";s:13:\"warrantyTitle\";s:8:\"Warranty\";s:14:\"warrantyPoints\";a:3:{i:0;s:29:\"One-year workmanship warranty\";i:1;s:67:\"Warranty support for qualifying fabrication and installation issues\";i:2;s:22:\"Dedicated service team\";}s:11:\"warrantyCta\";s:25:\"Request a Warranty Repair\";s:12:\"repairsTitle\";s:7:\"Repairs\";s:13:\"repairsPoints\";a:2:{i:0;s:36:\"Repair services available by request\";i:1;s:38:\"Contact us for an evaluation and quote\";}s:10:\"repairsCta\";s:25:\"Request a Repair Estimate\";}s:3:\"cta\";a:3:{s:7:\"heading\";s:18:\"Start Your Project\";s:4:\"body\";s:165:\"Whether you\'re building a custom home, remodeling an existing space, or managing a multifamily or commercial project, our team is ready to bring your vision to life.\";s:6:\"button\";s:15:\"Get an Estimate\";}}s:12:\"processSteps\";a:6:{i:0;a:3:{s:1:\"n\";s:2:\"01\";s:1:\"t\";s:30:\"Plans / Measurements + Details\";s:1:\"d\";s:146:\"Send plans, measurements, and scope details (material preference, edge style, sink type, backsplash, etc.) so we can provide an accurate estimate.\";}i:1;a:3:{s:1:\"n\";s:2:\"02\";s:1:\"t\";s:8:\"Estimate\";s:1:\"d\";s:151:\"We provide a detailed bid and finalize all project details, including material, edge profile, sink cutouts, overhangs, and layout, prior to templating.\";}i:2;a:3:{s:1:\"n\";s:2:\"03\";s:1:\"t\";s:16:\"On-site Template\";s:1:\"d\";s:53:\"We template your space to ensure precise fabrication.\";}i:3;a:3:{s:1:\"n\";s:2:\"04\";s:1:\"t\";s:11:\"Fabrication\";s:1:\"d\";s:52:\"Your stone is cut, shaped, and finished in our shop.\";}i:4;a:3:{s:1:\"n\";s:2:\"05\";s:1:\"t\";s:12:\"Installation\";s:1:\"d\";s:51:\"Our install team completes final placement on site.\";}i:5;a:3:{s:1:\"n\";s:2:\"06\";s:1:\"t\";s:15:\"Quality Control\";s:1:\"d\";s:83:\"Final inspection to ensure everything meets our standards before project close-out.\";}}s:12:\"testimonials\";a:31:{i:0;a:3:{s:1:\"q\";s:604:\"Working with Erik and Creative Granite Design has been an excellent experience on my personal home as well as other jobs that I have contracted them on. The attention to detail is phenomenal. My wife had picked out a few slabs of Taj Mahal and Erik went out of his way to find her better looking slabs at a fraction of the price. The installation was superb and the cuts are clean and precise. Alignment is better than expected and they really showcased their talent by placing the character pieces of the stone in the areas that it would look best. I will only work with Creative Granite moving forward.\";s:1:\"a\";s:13:\"Chris Stuber.\";s:1:\"r\";s:18:\"General contractor\";}i:1;a:3:{s:1:\"q\";s:725:\"I am a local real estate agent and when my clients are starting a remodel and need countertops, backsplash or a stone surround for a fireplace, Erik at Creative Granite & Design is my only call I need to make! When I first worked with Erik it was for my personal remodel (kitchen and bathroom counter tops). Erik was a standout with his communication and willingness to help me find the best price on the coveted Taj Mahal Quartzite that I wanted in my kitchen. Finding someone who goes above and beyond is more difficult these days, but when you find a gem, you stay with them. I am confident in referring my clients to Erik and Creative Granite & Design as I know they will take care of my client like they took care of me.\";s:1:\"a\";s:9:\"Ali North\";s:1:\"r\";s:17:\"Interior designer\";}i:2;a:3:{s:1:\"q\";s:344:\"A couple of years ago we had Creative Granite install kitchen counter tops. They were amazing to work with and the quality workmanship was excellent too. Yes, there were delays from the supplier side and some from their other jobs not going as planned which affected the timing of ours. But I consider that all part of the process. Recommended!\";s:1:\"a\";s:9:\"Ron Kilby\";s:1:\"r\";s:9:\"Developer\";}i:3;a:2:{s:1:\"q\";s:199:\"The staff at creative granite are wonderful to work with on large or small projects. Tiffany is the best and I\'ve recommended her for years to all projects. Great at multi -family or custom homes.   \";s:1:\"a\";s:13:\"Chris Affleck\";}i:4;a:2:{s:1:\"q\";s:211:\"Tiffany Magalei is a “Dream” to work with, she is always serviceable and looking for the best way to help you! Definitely a great experience doing a 100+ Multifamily project with her, ready for the next one!\";s:1:\"a\";s:15:\"rolando gallart\";}i:5;a:2:{s:1:\"q\";s:467:\"If I could give Creative Granite 10 stars I would. I love this company and the people that work for them so much. From the top down, they are fantastic people. I am a designer and work with them professionally and have also had them put countertops in my own home. They are always so professional and courteous. Installations have always gone so smoothly and the quality of their work is top notch. They truly care about their customers and the quality of their work!\";s:1:\"a\";s:13:\"Kristen Smith\";}i:6;a:2:{s:1:\"q\";s:262:\"Would recommend any client to work with Eric and his team here at Creative Granite! They are professional, constantly innovating to provide the best service and craftsmanship and pricing that makes sense for the value they provide. You cannot go wrong with them!\";s:1:\"a\";s:11:\"Vidya Walia\";}i:7;a:2:{s:1:\"q\";s:205:\"Tomas came to fix our counters through our warranty on our new build with Ivory. He fixed the caulking and a crack on our counter very beautifully. Tomas did a great job and is a great person to work with!\";s:1:\"a\";s:13:\"Ashley Clingo\";}i:8;a:2:{s:1:\"q\";s:357:\"Creative Granite has done two of my personal homes over the years. Both of them were remodels. Both times I was very impressed with the end product and the efficiency at which they did the work. I’ve appreciated the professionalism and persistence on getting the end product right. They are aggressive on price and still deliver a good product in the end.\";s:1:\"a\";s:11:\"Isaac McKay\";}i:9;a:2:{s:1:\"q\";s:826:\"Working with Ricardo at Creative Granite was such a pleasure. He always returned calls and responded to text messages in record time. It felt like I was his only customer as he always took time to thoroughly explore and answer my questions and concerns. We had a situation with the tile setters that caused an issue with our granite counter top. One call to Ricardo was all it took.............he sent Tony out right away to assess and resolve the problem. Tony, by the way, is amazing! I swear he is the master problem solver to whom I will be forever grateful. I received very good value for my dollar and the most excellent customer service. I will have no hesitation calling in the future should service be required and I will definitely go to Creative Granite and Design for all future needs! Thank you Ricardo and Tony!!\";s:1:\"a\";s:13:\"Valerie Bills\";}i:10;a:2:{s:1:\"q\";s:317:\"Ricardo is the BEST. I love the ease of being able to text pics to the receptionist, Ricardo and his office Manager is AMAZING! The guy who came to estimate was very professional and friendly (Alfonzo?) And the installers were great too. I LOVE my new Counter tops! THANKYOU AGAIN. I would recommend them to everyone!\";s:1:\"a\";s:7:\"Jan Ice\";}i:11;a:2:{s:1:\"q\";s:609:\"I couldn\'t recommend Ricardo and his team at Creative Granite any higher. I own a construction business and Creative Granite has been doing my countertops exclusively for 15 years.\nAfter several hundred projects you\'re gonna get a few hiccups here and there but no other fabricator works harder and goes the extra mile than Creative Granite to get it right in the end and make sure the result meets the expectation. After a few years and frustrating experiences with other fabricators I stopped even trying. Creative Granite is one of my most valued trade partners. Thank you for everything Ricardo and staff!\";s:1:\"a\";s:15:\"Bryant Anderson\";}i:12;a:2:{s:1:\"q\";s:389:\"I recently worked with Tiffany over at Creative Granite and Design. Honestly my experience was awesome. All my questions were answered, no sales pressure, and felt really comfortable and educated before making my decision. I would highly suggest giving her a call if you are in the market for new countertops. If i have any more renovations in the future i will be working with them again!\";s:1:\"a\";s:10:\"Matt Rigby\";}i:13;a:2:{s:1:\"q\";s:252:\"Ricardo and his team at Creative Granite are the best. They showed up on time and their work was flawless. Not to mention the installers were friendly and professional. I will definitely use Creative Granite again and I highly recommend their services!\";s:1:\"a\";s:4:\"Doug\";}i:14;a:2:{s:1:\"q\";s:320:\"Recently purchased kitchen counters through Creative Granite. Our sales person was Mike Merino and he was incredibly communicative. I got about 4-5 bids (Accent, Bedrock and 2 others) and Creative had all of their prices beat by a good margin. I love how they turned out and intsall crew was very clean and professional.\";s:1:\"a\";s:13:\"Lindsey Watne\";}i:15;a:2:{s:1:\"q\";s:355:\"Excellent service, craftsmanship, and prices. I got the same thing for significantly less money than a quote from another popular stone company. There were so many types of counter tops to choose from. We found exactly the stone slab we wanted. Everyone, from sales rep to the person who measured and the installers were top notch. We couldn\'t be happier.\";s:1:\"a\";s:16:\"Christy Williams\";}i:16;a:2:{s:1:\"q\";s:295:\"Creative Granite is wonderful to work with!! We have enjoyed working with them on multiple occasions throughout our house remodel and every time has been such a great experience! Not to mention our granite countertops are beautiful! We couldn\'t be happier. Thanks again to Ricardo and his staff!\";s:1:\"a\";s:11:\"Sheree Funk\";}i:17;a:2:{s:1:\"q\";s:315:\"Creative Granite & Design installed a countertop for a desk that I designed and did an incredible job! I would definitely recommend them to friends and family! They took their time and got it exactly how I wanted it and I couldn\'t have asked for a better experience. I will definitely use them again in the future. \";s:1:\"a\";s:13:\"Brooke Crofts\";}i:18;a:2:{s:1:\"q\";s:163:\"Tiffany and the crew were a pleasure to work with. The countertops look fabulous. Price was fair and service exceptional. We will definitely work with them again! \";s:1:\"a\";s:16:\"Sean Rentmeister\";}i:19;a:2:{s:1:\"q\";s:147:\"I love Creative Granite! They have fair pricing. Their staff is so friendly , and they do their absolute best to make sure you are a happy customer\";s:1:\"a\";s:22:\"\nnatasha “Natasha”\";}i:20;a:2:{s:1:\"q\";s:193:\"This company has been nothing short of incredible! They have been very friendly and even more helpful with the installation/replacement of our countertops! I would Highly recommend these guys!!\";s:1:\"a\";s:9:\"Shay Pitt\";}i:21;a:2:{s:1:\"q\";s:178:\"TAbsolutely 100% recommend Ricardo and his team. They are efficient, clean, professional and do a great job. Very very grateful for the communication and help. Thank you again!!!\";s:1:\"a\";s:15:\"Brittani Wilson\";}i:22;a:2:{s:1:\"q\";s:176:\"Jeff & Tyler helped us immensely on material selection as well as saved us money by helping us find remnants that went with our color scheme. My wife & I couldn’t be happier.\";s:1:\"a\";s:11:\"Justin Lake\";}i:23;a:2:{s:1:\"q\";s:91:\"They did a great job, excellent price, high quality material and the installers were great!\";s:1:\"a\";s:13:\"Kevin Adamson\";}i:24;a:2:{s:1:\"q\";s:162:\"Amy was great to work with the countertops look very nice done very quickly and clean cost was not bad at all either would recommend and or do business with again\";s:1:\"a\";s:9:\"Jr. knoll\";}i:25;a:2:{s:1:\"q\";s:125:\"Ricardo does an amazing job and stands behind his work. Their prices are great and their work is amazing. Highly recommended.\";s:1:\"a\";s:13:\"Daniel Willey\";}i:26;a:2:{s:1:\"q\";s:86:\"Great price and very friendly! Had it installed a few days ago and it looks beautiful!\";s:1:\"a\";s:19:\"TheAllKnowingMast3r\";}i:27;a:2:{s:1:\"q\";s:97:\"Ricardo runs a great company. Always responsive to any questions, and very knowledgable & honest!\";s:1:\"a\";s:14:\"James Harrison\";}i:28;a:2:{s:1:\"q\";s:80:\"Their installation team was so friendly. And the countertops turned out amazing.\";s:1:\"a\";s:10:\"Nick Bluth\";}i:29;a:2:{s:1:\"q\";s:102:\"Amy is absolutely amazing to work with!!!!! So responsive with me and understood what i was going for.\";s:1:\"a\";s:19:\"Ashley Kae Anderson\";}i:30;a:2:{s:1:\"q\";s:84:\"No questions. By far one of the best company.. best prices.. great customer service.\";s:1:\"a\";s:9:\"Eric Heer\";}}s:7:\"navLeft\";a:3:{i:0;a:2:{i:0;s:4:\"Work\";i:1;s:8:\"/gallery\";}i:1;a:2:{i:0;s:8:\"Products\";i:1;s:9:\"/products\";}i:2;a:2:{i:0;s:8:\"Services\";i:1;s:9:\"/services\";}}s:8:\"navRight\";a:2:{i:0;a:2:{i:0;s:7:\"Process\";i:1;s:8:\"/process\";}i:1;a:2:{i:0;s:15:\"Get an Estimate\";i:1;s:9:\"#estimate\";}}s:14:\"footerNavLinks\";a:5:{i:0;a:2:{i:0;s:4:\"Work\";i:1;s:8:\"/gallery\";}i:1;a:2:{i:0;s:8:\"Products\";i:1;s:9:\"/products\";}i:2;a:2:{i:0;s:8:\"Services\";i:1;s:9:\"/services\";}i:3;a:2:{i:0;s:7:\"Process\";i:1;s:8:\"/process\";}i:4;a:2:{i:0;s:10:\"Connect us\";i:1;s:8:\"/contact\";}}s:17:\"footerSocialLinks\";a:3:{i:0;a:2:{s:5:\"label\";s:9:\"Instagram\";s:3:\"url\";s:51:\"https://www.instagram.com/creativegraniteanddesign/\";}i:1;a:2:{s:5:\"label\";s:8:\"Facebook\";s:3:\"url\";s:47:\"https://www.facebook.com/CreativeGraniteDesign/\";}i:2;a:2:{s:5:\"label\";s:8:\"LinkedIn\";s:3:\"url\";s:58:\"https://www.linkedin.com/company/creative-granite-&-design\";}}s:8:\"sections\";a:13:{s:10:\"hero-intro\";a:6:{s:7:\"eyebrow\";s:38:\"Welcome to creative granite and design\";s:7:\"heading\";s:41:\"Crafting Custom Stone for Inspired Spaces\";s:10:\"subheading\";s:66:\"Serving homeowners, builders, and multifamily projects across Utah\";s:4:\"body\";s:166:\"Premium granite, quartz, marble and quartzite. Hand fabricated in Utah for builders, designers and homeowners who care about the details no one is supposed to notice.\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:10:\"who-we-are\";a:6:{s:7:\"eyebrow\";s:10:\"Who we are\";s:7:\"heading\";s:28:\"Built on craftsmanship since\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:320:\"Creative Granite + Design is a Utah-based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high-quality installation across residential and multifamily projects.\";s:13:\"highlightText\";s:4:\"1998\";s:5:\"image\";s:28:\"/images/site/LakeLine-20.jpg\";}s:9:\"materials\";a:6:{s:7:\"eyebrow\";s:9:\"Materials\";s:7:\"heading\";s:28:\"The slab decides everything.\";s:10:\"subheading\";s:179:\"Explore our most requested natural and engineered surfaces. Each offers its own balance of character, durability, and performance. Additional materials are available upon request.\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:8:\"products\";a:6:{s:7:\"eyebrow\";s:8:\"Products\";s:7:\"heading\";s:23:\"CGD ESI Sink Collection\";s:10:\"subheading\";s:114:\"Explore stainless steel, porcelain, fireclay, and quartz composite sinks with full specifications for every model.\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:4:\"work\";a:6:{s:7:\"eyebrow\";s:8:\"Our work\";s:7:\"heading\";s:52:\"Fabricated with precision. installed with intention.\";s:10:\"subheading\";s:135:\"A selection of completed spaces, material details, and in between moments each reflecting our approach to stone, design, and execution.\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:7:\"gallery\";a:6:{s:7:\"eyebrow\";s:8:\"Our Work\";s:7:\"heading\";s:21:\"Explore Our Portfolio\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:171:\"Discover a curated collection of kitchens, bathrooms, fireplaces, commercial spaces, and custom stone applications that showcase our craftsmanship and attention to detail.\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:16:\"gallery-featured\";a:6:{s:7:\"eyebrow\";s:17:\"Featured Projects\";s:7:\"heading\";s:24:\"A Collection of Our Work\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:9:\"instagram\";a:6:{s:7:\"eyebrow\";s:9:\"Instagram\";s:7:\"heading\";s:15:\"Follow our work\";s:10:\"subheading\";s:114:\"Behind the scenes, slab selections, and finished installs see what we are working on in the shop and in the field.\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:8:\"services\";a:6:{s:7:\"eyebrow\";s:8:\"Services\";s:7:\"heading\";s:39:\"Built for builders. Tailored for homes.\";s:10:\"subheading\";s:114:\"From new construction to remodels and multifamily projects — precision fabrication and installation across Utah.\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:7:\"process\";a:7:{s:7:\"eyebrow\";s:7:\"Process\";s:7:\"heading\";s:16:\"Project timeline\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:61:\"/storage/process/9fAxsFQe2ATYXkaFFbD7OC78I6nlvxwjnhFC3ZjM.jpg\";s:14:\"secondaryImage\";s:61:\"/storage/process/UI6sOz7f67G1K40R9HZGAvJziv3sRIe4yt1aUr2u.jpg\";}s:8:\"remnants\";a:6:{s:7:\"eyebrow\";s:8:\"Remnants\";s:7:\"heading\";s:29:\"Great stone at a great value.\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:142:\"Smaller pieces of stone, ideal for vanities, laundry rooms, and smaller projects. First come, first served — join our list for early access.\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:39:\"/portfolio/Creative-Quartz-scaled-1.jpg\";}s:11:\"testimonial\";a:6:{s:7:\"eyebrow\";s:0:\"\";s:7:\"heading\";s:19:\"Trusted across Utah\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:0:\"\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}s:3:\"cta\";a:6:{s:7:\"eyebrow\";s:20:\"Final Call to Action\";s:7:\"heading\";s:18:\"Start your project\";s:10:\"subheading\";s:0:\"\";s:4:\"body\";s:150:\"Whether you\'re building a custom home, planning a remodel, or managing a multifamily or commercial project, our team is here to help bring it to life.\";s:13:\"highlightText\";s:0:\"\";s:5:\"image\";s:0:\"\";}}}',1788370214);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_module_permissions`
--

DROP TABLE IF EXISTS `cms_module_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_module_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int NOT NULL,
  `is_add` tinyint(1) NOT NULL DEFAULT '1',
  `is_view` tinyint(1) NOT NULL DEFAULT '1',
  `is_update` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_module_permissions`
--

LOCK TABLES `cms_module_permissions` WRITE;
/*!40000 ALTER TABLE `cms_module_permissions` DISABLE KEYS */;
INSERT INTO `cms_module_permissions` VALUES (1,'admin',1,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(2,'admin',18,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(3,'admin',19,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(4,'admin',26,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(5,'admin',20,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(6,'admin',25,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(7,'admin',21,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(8,'admin',22,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(9,'admin',7,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(10,'admin',6,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(11,'admin',9,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(12,'admin',27,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(13,'admin',10,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(14,'admin',28,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(15,'admin',29,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(16,'admin',11,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(17,'admin',12,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(18,'admin',8,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(19,'admin',13,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(20,'admin',17,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(21,'admin',23,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(22,'admin',24,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(23,'admin',3,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(24,'admin',2,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(25,'admin',4,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(26,'admin',14,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(27,'admin',15,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(28,'admin',16,1,1,1,1,'active','2026-09-01 12:29:36','2026-09-01 12:29:36'),(29,'user',1,0,1,0,0,'active','2026-09-01 12:29:36','2026-09-01 12:29:36');
/*!40000 ALTER TABLE `cms_module_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_modules`
--

DROP TABLE IF EXISTS `cms_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_modules`
--

LOCK TABLES `cms_modules` WRITE;
/*!40000 ALTER TABLE `cms_modules` DISABLE KEYS */;
INSERT INTO `cms_modules` VALUES (1,0,'Dashboard','admin.dashboard','fa-regular fa-house',1,'active','2026-07-23 15:42:29','2026-07-23 15:42:29'),(2,21,'Contact Enquiries','contact-inquiries.index','fa-solid fa-inbox',2,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(3,21,'Contact Page','contact-page.edit','fa-solid fa-address-card',1,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(4,21,'Estimate Requests','estimate-requests.index','fa-solid fa-file-invoice',3,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(6,18,'Who We Are','who-we-are.edit','fa-solid fa-people-group',2,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(7,18,'Hero Banner','hero-slides.index','fa-solid fa-panorama',1,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(8,18,'Instagram Feed','instagram-posts.index','fa-brands fa-instagram',6,'active','2026-07-23 15:42:29','2026-09-01 12:29:27'),(9,18,'Materials','materials.index','fa-solid fa-gem',3,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(10,26,'All Products','products.index','fa-solid fa-list',1,'active','2026-07-23 15:42:29','2026-09-01 12:29:27'),(11,25,'Process Steps','process-steps.index','fa-solid fa-list-check',1,'active','2026-07-23 15:42:29','2026-08-17 17:57:05'),(12,18,'Our Work Collage','portfolio-items.index','fa-solid fa-camera',5,'active','2026-07-23 15:42:29','2026-09-01 12:29:27'),(13,18,'Homepage Services','services.index','fa-solid fa-list',7,'active','2026-07-23 15:42:29','2026-09-01 12:29:27'),(14,22,'Site Settings','site-settings.edit','fa-solid fa-sliders',1,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(15,22,'Email Settings','email-settings.edit','fa-solid fa-envelope',2,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(16,22,'Email Templates','email-templates.index','fa-solid fa-envelope-open-text',3,'active','2026-07-23 15:42:29','2026-07-29 16:30:46'),(17,19,'Gallery Albums','gallery-albums.index','fa-solid fa-table-cells-large',1,'active','2026-07-28 14:31:34','2026-07-29 16:30:46'),(18,0,'Home Page','home-module','fa-solid fa-house-chimney',2,'active','2026-07-29 16:30:46','2026-07-29 16:30:46'),(19,0,'Gallery Page','gallery-module','fa-solid fa-images',3,'active','2026-07-29 16:30:46','2026-07-29 16:30:46'),(20,0,'Services Page','services-module','fa-solid fa-briefcase',5,'active','2026-07-29 16:30:46','2026-08-26 17:33:51'),(21,0,'Contact & Leads','contact-module','fa-solid fa-address-book',7,'active','2026-07-29 16:30:46','2026-08-26 17:33:51'),(22,0,'Settings','settings-module','fa-solid fa-gear',8,'active','2026-07-29 16:30:46','2026-08-26 17:33:51'),(23,20,'Page Settings','services-page.edit','fa-solid fa-sliders',1,'active','2026-07-29 19:19:44','2026-07-29 19:19:44'),(24,20,'Page Sections','service-page-sections.index','fa-solid fa-layer-group',2,'active','2026-07-29 19:19:44','2026-07-29 19:19:44'),(25,0,'Process Page','process-module','fa-solid fa-list-ol',6,'active','2026-08-17 17:57:05','2026-08-26 17:33:51'),(26,0,'Products','products-module','fa-solid fa-box',4,'active','2026-09-01 12:29:27','2026-09-01 12:29:27'),(27,18,'Materials Section','materials-page.edit','fa-solid fa-sliders',4,'active','2026-09-01 12:29:27','2026-09-01 12:29:27'),(28,26,'Page Settings','products-page.edit','fa-solid fa-sliders',2,'active','2026-09-01 12:29:27','2026-09-01 12:29:27'),(29,26,'Categories','product-categories.index','fa-solid fa-tags',3,'active','2026-09-01 12:29:28','2026-09-01 12:29:28');
/*!40000 ALTER TABLE `cms_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_inquiries`
--

DROP TABLE IF EXISTS `contact_inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_inquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_inquiries`
--

LOCK TABLES `contact_inquiries` WRITE;
/*!40000 ALTER TABLE `contact_inquiries` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Follow Up','follow-up','Following up — {{customer_name}}','<p>Hi {{customer_name}},</p>\n<p>Thank you for reaching out to Creative Granite. We wanted to follow up on your recent inquiry about {{project_type}}.</p>\n<p>{{message}}</p>\n<p>If you have any questions or would like to schedule a visit to our showroom, reply to this email or call us at {{phone}}.</p>\n<p>Best regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>','Follow up after a customer inquiry or showroom visit.',1,1,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(2,'Quote Ready','quote-ready','Your estimate is ready — Creative Granite','<p>Hi {{customer_name}},</p>\n<p>Your estimate for {{project_type}} is ready.</p>\n<p>{{message}}</p>\n<p>We are happy to walk you through the details or answer any questions.</p>\n<p>Best regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>','Notify a customer that their quote or estimate is ready.',2,1,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(3,'Thank You','thank-you','Thank you, {{customer_name}}','<p>Hi {{customer_name}},</p>\n<p>Thank you for choosing Creative Granite. We appreciate the opportunity to work with you on {{project_type}}.</p>\n<p>{{message}}</p>\n<p>Warm regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>','Send a thank-you note after a project or consultation.',3,1,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(4,'Appointment Confirmation','appointment-confirmation','Appointment confirmed — {{appointment_date}}','<p>Hi {{customer_name}},</p>\n<p>This confirms your appointment with Creative Granite on <strong>{{appointment_date}}</strong>.</p>\n<p>{{message}}</p>\n<p>Our showroom is located at {{address}}. If you need to reschedule, reply to this email or call {{phone}}.</p>\n<p>See you soon,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>','Confirm a showroom visit or consultation appointment.',4,1,1,'2026-07-23 15:42:29','2026-07-23 15:42:29');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate_requests`
--

DROP TABLE IF EXISTS `estimate_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estimate_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate_requests`
--

LOCK TABLES `estimate_requests` WRITE;
/*!40000 ALTER TABLE `estimate_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimate_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_album_images`
--

DROP TABLE IF EXISTS `gallery_album_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_album_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gallery_album_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_album_images_gallery_album_id_sort_order_index` (`gallery_album_id`,`sort_order`),
  CONSTRAINT `gallery_album_images_gallery_album_id_foreign` FOREIGN KEY (`gallery_album_id`) REFERENCES `gallery_albums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_album_images`
--

LOCK TABLES `gallery_album_images` WRITE;
/*!40000 ALTER TABLE `gallery_album_images` DISABLE KEYS */;
INSERT INTO `gallery_album_images` VALUES (13,1,'/storage/gallery/collage/kpDHNxKBvAhuUg8VOhgjfpik3yOewSugjgCGoWgt.webp','Kitchens',1,'2026-07-29 15:48:55','2026-07-29 15:48:55'),(14,1,'/storage/gallery/collage/qnjbKf39lh5lyI7lrqv1VIXp3qzEwlcaAEHYcOik.jpg','Kitchens',2,'2026-07-29 15:51:15','2026-07-29 15:51:15'),(15,1,'/storage/gallery/collage/xi235XP0SkUDhI6QDjKHiXAN3DLea3Cj6EKKbRpv.webp','Kitchens',3,'2026-07-29 15:51:39','2026-07-29 15:51:39'),(16,1,'/storage/gallery/collage/UNdwqNlO7vJ70ldV3GGJz2zB69VFvH1zpOhER0j3.webp','Kitchens',4,'2026-07-29 15:51:39','2026-07-29 15:51:39'),(17,1,'/storage/gallery/collage/V58SZ9OLJD22i1YRTAyVVQNzCclqrHBMA3o4oLxE.jpg','Kitchens',5,'2026-07-29 15:52:42','2026-07-29 15:52:42'),(18,1,'/storage/gallery/collage/JbkY7kPCHtgigl1V85jMf1PUJ9CKKYWm5XZkcRbC.webp','Kitchens',6,'2026-07-29 15:52:42','2026-07-29 15:52:42'),(19,1,'/storage/gallery/collage/Gpbr4ZN2n6U3LXQtqlTjo0A5oVtOOrxu3l4ZZBrN.webp','Kitchens',7,'2026-07-29 15:52:42','2026-07-29 15:52:42'),(20,1,'/storage/gallery/collage/Tdei44CbwhVOGWQlnZjK8PD4RBEkUSX0useYphCJ.webp','Kitchens',8,'2026-07-29 15:52:42','2026-07-29 15:52:42'),(21,1,'/storage/gallery/collage/3KCpxzHE1zjM8aH0ZEzd9U36pPthi3mcMDlgmYvX.webp','Kitchens',9,'2026-07-29 15:53:21','2026-07-29 15:53:21'),(22,1,'/storage/gallery/collage/aV4oWQkbIh9zoUyyf4i1aiU2EkQU6m6azSST9mtj.webp','Kitchens',10,'2026-07-29 15:53:21','2026-07-29 15:53:21'),(23,1,'/storage/gallery/collage/rl29xc16gOURNJOXGHrqTM8YF8pelztkMRPE6ERW.webp','Kitchens',11,'2026-07-29 15:53:21','2026-07-29 15:53:21'),(24,1,'/storage/gallery/collage/CizxdLJDxjaMItpde2DR2wWt12QwtgohTbdMj7iJ.webp','Kitchens',12,'2026-07-29 15:53:21','2026-07-29 15:53:21'),(30,2,'/storage/gallery/collage/TosyvcXAH7dEYfcnJAtFOti8T5iiOQSbK7wpJvcM.webp','Bathrooms',1,'2026-07-29 16:15:21','2026-07-29 16:15:21'),(32,2,'/storage/gallery/collage/CJN9f218uljTOJHnhIRjqvVzjU7oxga8NOjMu6q9.webp','Bathrooms',3,'2026-07-29 16:15:57','2026-07-29 16:15:57'),(33,2,'/storage/gallery/collage/o5qVRlIMvSqP7SlJrzuPRWMRXvFjWKQVaH17f3pw.webp','Bathrooms',4,'2026-07-29 16:15:57','2026-07-29 16:15:57'),(34,2,'/storage/gallery/collage/29AkPxvn7SvjthNDP70y85QOmUmPcNHIDslyn1VG.webp','Bathrooms',5,'2026-07-29 16:16:37','2026-07-29 16:16:37'),(39,2,'/storage/gallery/collage/15HcXI9ZhJOssdJ6sC9vhBDmFfbImBtVOp2AMX4y.webp','Bathrooms',6,'2026-07-29 16:18:37','2026-07-29 16:18:37'),(40,2,'/storage/gallery/collage/JYLrnEWGxy8NdTBpqiopUr6l6OJfUSOvflWl4377.webp','Bathrooms',7,'2026-07-29 16:18:37','2026-07-29 16:18:37'),(41,2,'/storage/gallery/collage/dPKQFL28MXxOnJIE95TT5AeVwjXVXOOCdnfx7AbJ.webp','Bathrooms',8,'2026-07-29 16:18:55','2026-07-29 16:18:55'),(42,2,'/storage/gallery/collage/tszRS8fv1SgyKcKWfEUR2nllVWdvOk93V1ZTT0ph.webp','Bathrooms',9,'2026-07-29 16:18:55','2026-07-29 16:18:55'),(43,2,'/storage/gallery/collage/GOWiDT3VVpgu8PtDwyTQgp29Qy3dtzWpCxV9FyLp.webp','Bathrooms',10,'2026-07-29 16:19:14','2026-07-29 16:19:14'),(44,2,'/storage/gallery/collage/EYvKubeHhDbiWXXLe1MnKlEIcFs2YPRUzHHhqhad.webp','Bathrooms',11,'2026-07-29 16:19:14','2026-07-29 16:19:14'),(45,2,'/storage/gallery/collage/6vGOLy4A3yTsCQ8eonZVyD1mrHSWaR5vZpR3Br9P.webp','Bathrooms',12,'2026-07-29 16:19:47','2026-07-29 16:19:47'),(46,2,'/storage/gallery/collage/jmjcyprGInknS4sBYUaKRaREcgurJ755XL4bWb01.webp','Bathrooms',13,'2026-07-29 16:19:47','2026-07-29 16:19:47'),(47,3,'/storage/gallery/collage/WzRo3Ocp7lqAkx8RUPs85ntwgeVP4ILprGsgjT2K.webp','Fireplaces',1,'2026-07-29 16:27:58','2026-07-29 16:27:58'),(48,3,'/storage/gallery/collage/tXiH4GKelbLoXySFCqprkrUCad4dgorntvV9uGso.webp','Fireplaces',2,'2026-07-29 16:28:18','2026-07-29 16:28:18'),(49,3,'/storage/gallery/collage/4KdZvf9YFuNKabsfeuHYwp6GNKuDnJvzOlatbLZP.webp','Fireplaces',3,'2026-07-29 16:28:18','2026-07-29 16:28:18'),(50,3,'/storage/gallery/collage/j0iPGC8VLN7zGG26jfj89gnBXolL1Ox2Noo8x8CB.webp','Fireplaces',4,'2026-07-29 16:29:09','2026-07-29 16:29:09'),(51,3,'/storage/gallery/collage/dy8ogweqan4qdem6RDVQVTvAJueNOtIdltgoRGIs.webp','Fireplaces',5,'2026-07-29 16:29:09','2026-07-29 16:29:09'),(52,3,'/storage/gallery/collage/MLdhodZ7hPVIKfVLMiJzjlOAc2VwClRSfxNfo48E.webp','Fireplaces',6,'2026-07-29 16:37:21','2026-07-29 16:37:21'),(53,3,'/storage/gallery/collage/VUiSbtFzjjtAxbE1r5GVPVhACPvxroYhBvWi3u4j.webp','Fireplaces',7,'2026-07-29 16:37:21','2026-07-29 16:37:21'),(54,3,'/storage/gallery/collage/GKnYWg3ZCZLtJbA04hMI6RCacGXAXjGbKLVdDsd6.webp','Fireplaces',8,'2026-07-29 16:37:21','2026-07-29 16:37:21'),(55,3,'/storage/gallery/collage/Giah93HavqKTZfRyk9AwMBi8xqCpYtPBNbaeuPP4.jpg','Fireplaces',9,'2026-07-29 16:42:51','2026-07-29 16:42:51'),(56,3,'/storage/gallery/collage/c8ruwwyCx09cFOBixau4kX7Ui1NoG0Qm7eRabwRS.jpg','Fireplaces',10,'2026-07-29 16:47:46','2026-07-29 16:47:46'),(57,3,'/storage/gallery/collage/Pm0Ke3jCUhv7HhFLG7dPLGFV8oTPjJ9xF1UszudI.jpg','Fireplaces',11,'2026-07-29 16:47:46','2026-07-29 16:47:46'),(58,3,'/storage/gallery/collage/GjPW7OKDyO02MjeCDA1cavzfw5TiaWxcQTnsCmIY.jpg','Fireplaces',12,'2026-07-29 16:48:41','2026-07-29 16:48:41'),(59,4,'/storage/gallery/collage/v4j592nbAnIietPTAB3gsJpJ90MQFlLMlPvSWVKV.jpg','Multifamily',1,'2026-07-29 17:01:28','2026-07-29 17:01:28'),(60,4,'/storage/gallery/collage/riiizuAWc6Qww1VSys1fnmiFC8GilatJ5ORLsjAA.jpg','Multifamily',2,'2026-07-29 17:01:49','2026-07-29 17:01:49'),(62,4,'/storage/gallery/collage/msZWNedKT7Bcs1jLEUMn8V0uuvmwwHMjNFS3s2BJ.jpg','Multifamily',3,'2026-07-29 17:03:10','2026-07-29 17:03:10'),(63,4,'/storage/gallery/collage/Q9MnveGsTMMQoX3AA0DmPkTyxxTZMbZpIGQTHnGo.jpg','Multifamily',4,'2026-07-29 17:03:28','2026-07-29 17:03:28'),(64,4,'/storage/gallery/collage/DjztZ3vAXWfqkKIGcTW5P3TfVTbiakNoalBSihQW.jpg','Multifamily',5,'2026-07-29 17:03:50','2026-07-29 17:03:50'),(65,4,'/storage/gallery/collage/kAUoJMACKrAnqLn5C0mCyjS1GSAeXnBquwSNsRH7.jpg','Multifamily',6,'2026-07-29 17:06:17','2026-07-29 17:06:17'),(66,4,'/storage/gallery/collage/dh9CiFk4cOzshXxoyIcWlpGVlIyqjEC91gnhNDLZ.jpg','Multifamily',7,'2026-07-29 17:06:32','2026-07-29 17:06:32'),(67,4,'/storage/gallery/collage/32LRZc0cqyp9P9KnDg8h6jY00GHL5cTQiJYTHoxY.jpg','Multifamily',8,'2026-07-29 17:06:49','2026-07-29 17:06:49'),(68,4,'/storage/gallery/collage/8A5iltcEgJvFUx3y9SxOlDdr4Ti071fYQvpbZm5a.jpg','Multifamily',9,'2026-07-29 17:07:11','2026-07-29 17:07:11'),(69,4,'/storage/gallery/collage/adzTPBkaejwqAROhYcFOE9Di3aETkbXOjkxuNyrD.jpg','Multifamily',10,'2026-07-29 17:08:31','2026-07-29 17:08:31'),(70,4,'/storage/gallery/collage/Uir42vheLZMhnhS7CU4psgUmNZexOvddS9nVNCes.jpg','Multifamily',11,'2026-07-29 17:09:02','2026-07-29 17:09:02'),(71,4,'/storage/gallery/collage/9cAhsttXacTDBGCwsv29IR4Fybj5TlwFmeKBkDdJ.jpg','Multifamily',12,'2026-07-29 17:09:44','2026-07-29 17:09:44'),(72,5,'/storage/gallery/collage/02xXhilVvDNPVrA0DaLqntg3jKuqlg7JvvwkARsq.jpg','Norfolk',1,'2026-07-29 17:28:49','2026-07-29 17:28:49'),(73,5,'/storage/gallery/collage/ddzt1XA9NIv7ouzNt8Mm0Y6COnyVWxKy9y56zYIa.jpg','Norfolk',2,'2026-07-29 17:29:18','2026-07-29 17:29:18'),(74,5,'/storage/gallery/collage/LGIhXqqo39VTFmGgGO308fjhBR7ZVuZaluQGYWhM.jpg','Norfolk',3,'2026-07-29 17:30:07','2026-07-29 17:30:07'),(75,5,'/storage/gallery/collage/yYaXPMEXGq5MPdrwBt45IV1HvQiOpJaKuI95xb9v.jpg','Norfolk',4,'2026-07-29 17:30:48','2026-07-29 17:30:48'),(76,5,'/storage/gallery/collage/AhW6k79jC8GvaIUc0RU2W4eNQ6pEdT9ILGF47IxQ.jpg','Norfolk',5,'2026-07-29 17:31:09','2026-07-29 17:31:09'),(77,5,'/storage/gallery/collage/qxbQS48AZs4dfrOpBYEdXNF8fgWb2MLZDQMf01Yg.jpg','Norfolk',6,'2026-07-29 17:31:27','2026-07-29 17:31:27'),(78,5,'/storage/gallery/collage/p4BvLkzHUcQJGuU4rrUkiU58uqidjzzYnjqmKn7z.jpg','Norfolk',7,'2026-07-29 17:31:45','2026-07-29 17:31:45'),(79,5,'/storage/gallery/collage/dF8tpEjzrtEQuOHQLoejLROBaqyiOW9Knpj49ke3.jpg','Norfolk',8,'2026-07-29 17:32:00','2026-07-29 17:32:00'),(80,5,'/storage/gallery/collage/hAsnbh3vlotBcutiOhvY81OomuRGoUsjsoVca1Jp.jpg','Norfolk',9,'2026-07-29 17:32:32','2026-07-29 17:32:32'),(81,5,'/storage/gallery/collage/DSGWGmvdClmTtTwAYk3iUFW8vHSxLAk8mlM3cjim.jpg','Norfolk',10,'2026-07-29 17:32:51','2026-07-29 17:32:51'),(82,5,'/storage/gallery/collage/ka3Sj1xxBNWd7SO57fX5G0NuAjGnMP38UWlkkmKF.jpg','Norfolk',11,'2026-07-29 17:33:11','2026-07-29 17:33:11'),(83,5,'/storage/gallery/collage/Q5oT5myj8TOc5VgDRwWCIEejyXjDj7kBR2jG1M1E.jpg','Norfolk',12,'2026-07-29 17:33:24','2026-07-29 17:33:24'),(84,6,'/storage/gallery/collage/eDRoQNY5DQt56Mw4lT3IgRIUy7vdFmJrefvjCItT.jpg','Sabal',1,'2026-07-29 17:38:18','2026-07-29 17:38:18'),(85,6,'/storage/gallery/collage/YL7jkQBUGsR3KtRhM3PM7T8TajL3bNRF88Zb00aO.jpg','Sabal',2,'2026-07-29 17:38:40','2026-07-29 17:38:40'),(86,6,'/storage/gallery/collage/n8wFaTRNd2ECuwaKrxN2VonQFccN682zzdv7A9y6.jpg','Sabal',3,'2026-07-29 17:38:53','2026-07-29 17:38:53'),(87,6,'/storage/gallery/collage/HIVCKlE6gq47L69KLs84SRDKQFBckEelCKvf89it.jpg','Sabal',4,'2026-07-29 17:39:10','2026-07-29 17:39:10'),(88,6,'/storage/gallery/collage/qbv8UUBux5L4lTyTktCBhLd5MSwXNIHKtS8D3jxa.jpg','Sabal',5,'2026-07-29 17:39:27','2026-07-29 17:39:27'),(89,6,'/storage/gallery/collage/3pQhH46wm0kglE9DRZEVj6M8RBm6uRY694X64nEm.jpg','Sabal',6,'2026-07-29 17:39:55','2026-07-29 17:39:55'),(90,6,'/storage/gallery/collage/QSV0SPQMMXR33MrOICsWfWEQfXmt8rz4INvgpUUj.jpg','Sabal',7,'2026-07-29 17:40:14','2026-07-29 17:40:14'),(91,6,'/storage/gallery/collage/pA3FOC45AvDKkV8vwyyh7LjdXHT7XCLKwvTsyGHZ.jpg','Sabal',8,'2026-07-29 17:40:29','2026-07-29 17:40:29'),(92,6,'/storage/gallery/collage/bkaz1y65gjCx6uXGCXSUZ6kM156ddZ2cKqJMk2bI.jpg','Sabal',9,'2026-07-29 17:40:42','2026-07-29 17:40:42'),(93,6,'/storage/gallery/collage/cujDZDc09ioCYvVVI1sJHhp0VTvKjUARH5bVxT7W.jpg','Sabal',10,'2026-07-29 17:40:57','2026-07-29 17:40:57'),(94,6,'/storage/gallery/collage/aGhAuEWlcF59rYqbbJ98pkh6S42DaAbGsYBi4o3N.jpg','Sabal',11,'2026-07-29 17:41:15','2026-07-29 17:41:15'),(95,6,'/storage/gallery/collage/746KhjYSTSfWkW1oFPTgoaRa92SPnSYgnmk3T7dv.jpg','Sabal',12,'2026-07-29 17:41:26','2026-07-29 17:41:26'),(96,7,'/storage/gallery/collage/LgBmSKDPbHPS8sjYWptJdINjD4gXKoQvi9897gA9.jpg','Lancaster',1,'2026-07-29 17:47:21','2026-07-29 17:47:21'),(97,7,'/storage/gallery/collage/kgKAGM3ceV5qcUZgkEVrRaGGUunHdjkKTOZFJyzz.jpg','Lancaster',2,'2026-07-29 17:47:35','2026-07-29 17:47:35'),(98,7,'/storage/gallery/collage/l5cDSQJ3VMgdupyCsE6i1aATkAqx9bCrLe2xQllf.jpg','Lancaster',3,'2026-07-29 17:47:57','2026-07-29 17:47:57'),(99,7,'/storage/gallery/collage/HV7fNXZKTvUGwr9rU7BiyIn7tLsfnOxDqHXtVjxc.jpg','Lancaster',4,'2026-07-29 17:48:10','2026-07-29 17:48:10'),(100,7,'/storage/gallery/collage/DIXXfmKEhcTBo13xqXMopd07Liwhbl6GBpOeXnrD.jpg','Lancaster',5,'2026-07-29 17:48:25','2026-07-29 17:48:25'),(101,7,'/storage/gallery/collage/xvS6DdLIxjMKa42w6N8atdhLMs4zLEVreIN8FTe4.jpg','Lancaster',6,'2026-07-29 17:48:42','2026-07-29 17:48:42'),(102,7,'/storage/gallery/collage/PDX4K0uToBeNfgcvIJmwJn4JuL3gfqebt6doNDNx.jpg','Lancaster',7,'2026-07-29 17:48:53','2026-07-29 17:48:53'),(103,7,'/storage/gallery/collage/15oE2Cz4OaRupC5cQgJQPTRHHlrpd7UiugHraWkw.jpg','Lancaster',8,'2026-07-29 17:49:08','2026-07-29 17:49:08'),(104,7,'/storage/gallery/collage/DXTL3BbkLNyV3K6mgoVlNLk1EGBXyCTJXH8q9uZo.jpg','Lancaster',9,'2026-07-29 17:49:27','2026-07-29 17:49:27'),(105,7,'/storage/gallery/collage/aBb1EZOlch4Z2bXN3EYf5BIcRUkxz7XUgp6TMiVn.jpg','Lancaster',10,'2026-07-29 17:49:39','2026-07-29 17:49:39'),(106,7,'/storage/gallery/collage/mcGMNJMwgBi5GsTfH1hWhTvp6y2tmq9Yfo7XWaJq.jpg','Lancaster',11,'2026-07-29 17:50:00','2026-07-29 17:50:00'),(107,7,'/storage/gallery/collage/jTtdVRZW73FtbkHqSBuWZEdeP0UkvjL2MLo8RZ9S.jpg','Lancaster',12,'2026-07-29 17:50:22','2026-07-29 17:50:22'),(108,8,'/storage/gallery/collage/FRpzA05SnqgH5Q7eutkXyBBBlpHzc69qQgMRViHy.jpg','2026 Parade Home',1,'2026-07-29 18:00:25','2026-07-29 18:00:25'),(109,8,'/storage/gallery/collage/jTL59BMiEezaTGfeHa1gpVFPGps9hQhztyQDNcpR.jpg','2026 Parade Home',2,'2026-07-29 18:02:13','2026-07-29 18:02:13'),(110,8,'/storage/gallery/collage/MFvDCAxRXjl7mvWlTkPsukhL1pKb68Wbqk7couHq.jpg','2026 Parade Home',3,'2026-07-29 18:02:32','2026-07-29 18:02:32'),(111,8,'/storage/gallery/collage/Xy0rnYQA0q5SMJPXFvEjC4u65T2nkBIl8TPL33MK.jpg','2026 Parade Home',4,'2026-07-29 18:03:06','2026-07-29 18:03:06'),(112,8,'/storage/gallery/collage/kZDCZmWtqyUDwyUaMeHDhGByzmjBBxaHD7omG4PZ.jpg','2026 Parade Home',5,'2026-07-29 18:03:26','2026-07-29 18:03:26'),(113,8,'/storage/gallery/collage/b0SoGHFk9LBEJT9sDNgxuPfVLa1XdqT7r0AW0gKn.jpg','2026 Parade Home',6,'2026-07-29 18:04:02','2026-07-29 18:04:02'),(114,8,'/storage/gallery/collage/gexbKW09ppVTkaAK6UnSTO5dLiZ5OYGlV1RaWDiN.jpg','2026 Parade Home',7,'2026-07-29 18:04:28','2026-07-29 18:04:28'),(115,8,'/storage/gallery/collage/a18cYCvg70pEoQkRJTdiixMj7aSHXQr3nzGyfuNs.jpg','2026 Parade Home',8,'2026-07-29 18:05:08','2026-07-29 18:05:08'),(116,8,'/storage/gallery/collage/2VbHeP79xJyhZ3jz62GJW00OWyFiX01ByVZsLBeX.jpg','2026 Parade Home',9,'2026-07-29 18:05:24','2026-07-29 18:05:24'),(117,8,'/storage/gallery/collage/i5RhexybwWMHhf4vv2HTKsLdVmnk0aOH1FSzljEM.jpg','2026 Parade Home',10,'2026-07-29 18:05:54','2026-07-29 18:05:54'),(118,8,'/storage/gallery/collage/XsPEgFMclpANZosjMpFJmpAcbInw2wtI4Q2LeMiP.jpg','2026 Parade Home',11,'2026-07-29 18:06:10','2026-07-29 18:06:10'),(119,8,'/storage/gallery/collage/Tn8HGZRV74p5G39LVKyQpMJhBjJubdhEo4OFhkNt.jpg','2026 Parade Home',12,'2026-07-29 18:06:53','2026-07-29 18:06:53');
/*!40000 ALTER TABLE `gallery_album_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_albums`
--

DROP TABLE IF EXISTS `gallery_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category',
  `cover_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gallery_albums_slug_unique` (`slug`),
  KEY `gallery_albums_kind_is_active_sort_order_index` (`kind`,`is_active`,`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_albums`
--

LOCK TABLES `gallery_albums` WRITE;
/*!40000 ALTER TABLE `gallery_albums` DISABLE KEYS */;
INSERT INTO `gallery_albums` VALUES (1,'Kitchens','kitchens','category','/images/work/kitchens-cover.jpg','/storage/gallery/collage/kpDHNxKBvAhuUg8VOhgjfpik3yOewSugjgCGoWgt.webp',1,1,'2026-07-28 14:31:53','2026-07-29 15:48:55'),(2,'Bathrooms','bathrooms','category','/images/work/bathrooms-cover.jpg','/storage/gallery/collage/TosyvcXAH7dEYfcnJAtFOti8T5iiOQSbK7wpJvcM.webp',2,1,'2026-07-28 14:31:53','2026-07-29 16:15:21'),(3,'Fireplaces','fireplaces','category','/images/work/fireplaces-cover.jpg','/storage/gallery/collage/WzRo3Ocp7lqAkx8RUPs85ntwgeVP4ILprGsgjT2K.webp',3,1,'2026-07-28 14:31:53','2026-07-29 16:27:58'),(4,'Multifamily','multifamily','category','/images/work/multifamily-cover.jpg','/storage/gallery/collage/v4j592nbAnIietPTAB3gsJpJ90MQFlLMlPvSWVKV.jpg',4,1,'2026-07-28 14:31:53','2026-07-29 17:01:28'),(5,'Norfolk','norfolk','project','/images/work/norfolk-cover.jpg','/storage/gallery/collage/02xXhilVvDNPVrA0DaLqntg3jKuqlg7JvvwkARsq.jpg',1,1,'2026-07-28 14:31:53','2026-07-29 17:28:49'),(6,'Sabal','sabal','project','/images/work/sabal-cover.png','/storage/gallery/collage/eDRoQNY5DQt56Mw4lT3IgRIUy7vdFmJrefvjCItT.jpg',2,1,'2026-07-28 14:31:53','2026-07-29 17:38:18'),(7,'Lancaster','lancaster','project','/images/work/lancaster-cover.jpg','/storage/gallery/collage/LgBmSKDPbHPS8sjYWptJdINjD4gXKoQvi9897gA9.jpg',3,1,'2026-07-28 14:31:53','2026-07-29 17:47:21'),(8,'2026 Parade Home','2026-parade-home','project','/images/work/parade-home-cover.jpg','/storage/gallery/collage/FRpzA05SnqgH5Q7eutkXyBBBlpHzc69qQgMRViHy.jpg',4,1,'2026-07-28 14:31:53','2026-07-29 18:00:25');
/*!40000 ALTER TABLE `gallery_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_slides`
--

DROP TABLE IF EXISTS `hero_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero_slides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_slides`
--

LOCK TABLES `hero_slides` WRITE;
/*!40000 ALTER TABLE `hero_slides` DISABLE KEYS */;
INSERT INTO `hero_slides` VALUES (1,'/storage/site/vmd8wqEDPWvXh2W92J1xlCYGbyYTcaB2j75sRxWh.jpg','Park City 06 (1)',1,1,'2026-07-23 15:42:29','2026-07-23 15:58:58'),(2,'/storage/site/TE953FCmWdMddcxp5cOHGAblwgGYjcJ1ANujsI3s.jpg','Norfolk 01',2,1,'2026-07-23 15:42:29','2026-07-23 16:00:30'),(3,'/storage/site/9onv38JXN3SQL4CL0ZtiI6JL7rokSqRaj9oJxfvx.jpg','Norfolk 11',3,1,'2026-07-23 15:42:29','2026-07-23 16:01:06'),(4,'/storage/site/BX7TND4Gdti47fFHSB3muk7JZMdgF9xCQ6Ssv6h0.webp','Image (2)',4,1,'2026-07-23 16:01:42','2026-07-29 18:07:13'),(5,'/storage/site/FmaKo6ApneFmWjsKfLTCffiP7qdBXDno1NQkqOgy.jpg','Img 2103',5,1,'2026-07-23 16:03:08','2026-07-23 16:03:08');
/*!40000 ALTER TABLE `hero_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instagram_posts`
--

DROP TABLE IF EXISTS `instagram_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instagram_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instagram_posts`
--

LOCK TABLES `instagram_posts` WRITE;
/*!40000 ALTER TABLE `instagram_posts` DISABLE KEYS */;
INSERT INTO `instagram_posts` VALUES (1,'DSC_3969','/storage/instagram/anBlfELNfINmuhXSTzW3oNAIHVDgFVNpEcT9UEeZ.jpg','Creative Granite stone fabrication — DSC_3969','https://www.instagram.com/creativegraniteanddesign/',1,1,1,'2026-07-23 15:42:29','2026-07-23 16:41:15'),(2,'DSC_3986 (1)','/storage/instagram/9OAlDwrLfMF26VN6rOto0XkIgG4tzXjVX1aP5uE6.png','Creative Granite stone fabrication — DSC_3986 (1)','https://www.instagram.com/creativegraniteanddesign/',2,1,1,'2026-07-23 15:42:29','2026-07-23 17:14:49'),(3,'DSC_4008','/storage/instagram/DKwzqhIEereEgleOHtNXGOkMSmPJd7zTwZwHEjId.jpg','Creative Granite stone fabrication — DSC_4008','https://www.instagram.com/creativegraniteanddesign/',3,1,1,'2026-07-23 15:42:29','2026-07-23 16:51:19'),(4,'DSC_4011','/storage/instagram/ZZX06vBxVYoye2HluDxojkossgMQwPXml4869aJF.jpg','Creative Granite stone fabrication — DSC_4011','https://www.instagram.com/creativegraniteanddesign/',4,1,1,'2026-07-23 15:42:29','2026-07-23 16:52:48'),(5,'DSC_4068','/storage/instagram/zIyaZ187u2ZriITnMt7FpvzCIWLwep2mi3AGxGT4.jpg','Creative Granite stone fabrication — DSC_4068','https://www.instagram.com/creativegraniteanddesign/',5,1,1,'2026-07-23 15:42:29','2026-07-23 16:54:06'),(6,'DSC_4165','/storage/instagram/KS9m6i5JNyQggk7kZMJJlBVJtqiGuRRF8M3vRpui.jpg','Creative Granite stone fabrication — DSC_4165','https://www.instagram.com/creativegraniteanddesign/',6,1,1,'2026-07-23 15:42:29','2026-07-23 16:54:28'),(7,'DSC_4181 (1)','/storage/instagram/zldxaAcJHRQUQyUdn8bbX9prx6orghG7WFRqIH9D.jpg','Creative Granite stone fabrication — DSC_4181 (1)','https://www.instagram.com/creativegraniteanddesign/',7,1,1,'2026-07-23 15:42:29','2026-07-23 16:55:01'),(8,'DSC_4192','/storage/instagram/AiwFpjHpPd6MmP6T4nuuStxu4aB5tnkRfd7jBBP1.jpg','Creative Granite stone fabrication — DSC_4192','https://www.instagram.com/creativegraniteanddesign/',8,1,1,'2026-07-23 15:42:29','2026-07-23 16:56:00'),(9,'DSC_4204 (1)','/storage/instagram/gHhwyfJigvobBMRz3NMaff9pObbnWsFUy0CfioXf.png','Creative Granite stone fabrication — DSC_4204 (1)','https://www.instagram.com/creativegraniteanddesign/',9,1,1,'2026-07-23 15:42:29','2026-07-23 16:57:35'),(10,'Journeys End-12','/storage/instagram/WiPwf1Hnt8dRWtllv4nbQ6MRSywxDMi97UuZsoRh.jpg','Creative Granite stone fabrication — Journeys End-12','https://www.instagram.com/creativegraniteanddesign/',10,1,1,'2026-07-23 15:42:29','2026-07-23 17:09:41'),(11,'LakeLine-20','/storage/instagram/tHUHGDfx8lXZOd4wpWnwfJ8pN62Dlotn5iq7WMDq.jpg','Creative Granite stone fabrication — LakeLine-20','https://www.instagram.com/creativegraniteanddesign/',11,1,1,'2026-07-23 15:42:29','2026-07-23 17:01:35'),(12,'Sabal-24','/storage/instagram/Yl7CxHvBzD5M3uhlWEHlRamMFjyEItvUyYHW3WzG.jpg','Creative Granite stone fabrication — Sabal-24','https://www.instagram.com/creativegraniteanddesign/',12,1,1,'2026-07-23 15:42:29','2026-07-23 16:58:17');
/*!40000 ALTER TABLE `instagram_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_images`
--

DROP TABLE IF EXISTS `material_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `material_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_images_material_id_foreign` (`material_id`),
  CONSTRAINT `material_images_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_images`
--

LOCK TABLES `material_images` WRITE;
/*!40000 ALTER TABLE `material_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `why_choose` json DEFAULT NULL,
  `why_choose_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_to_know` text COLLATE utf8mb4_unicode_ci,
  `best_for` text COLLATE utf8mb4_unicode_ci,
  `care_guide_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `care_guide_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_eyebrow` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_body` text COLLATE utf8mb4_unicode_ci,
  `cta_primary_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_secondary_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_secondary_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `materials_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,'Granite','granite','A durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.','Proven performance. Naturally unique.','Granite has remained a trusted surface material for good reason. This natural stone offers excellent durability while providing tremendous variety in color, pattern, texture, and movement.','[\"Strong and durable for everyday use\", \"Naturally heat resistant\", \"Wide range of colors and patterns\", \"Every slab has its own natural variation\", \"Suitable for kitchens, bathrooms, fireplaces, and many other applications\", \"Relatively straightforward maintenance with proper care\"]',NULL,'Like other natural stones, granite is porous to varying degrees and may require periodic sealing. Individual varieties can differ in composition and appearance, so seeing and selecting the actual slab is an important part of the process.','Clients wanting a durable natural surface with extensive design possibilities and relatively easy maintenance.','/downloads/natural-stone-care-guide.pdf','Natural Stone Care + Cleaning Guide','Granite Countertops Utah | Custom Granite Surfaces','Explore granite countertops in Utah. Durable natural stone with extensive color and pattern options for kitchens, baths, fireplaces, and more.','Need help choosing?','Not sure which material is right for your project?','The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.','Get an Estimate','Contact Us','/contact','/materials/granite.webp',1,1,1,'2026-07-23 15:42:29','2026-09-01 12:29:05'),(2,'Quartz','quartz','An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.','Consistent design with everyday ease','Quartz is an engineered surface designed to provide durability, consistency, and low-maintenance performance. Because its appearance is manufactured rather than naturally occurring, quartz offers more predictability in color and pattern from slab to slab.','[\"Nonporous and resistant to everyday staining\", \"Does not require sealing\", \"Easy to clean and maintain\", \"Broad range of colors and patterns\", \"More consistent appearance than natural stone\", \"Available in designs ranging from subtle and minimal to dramatic veining\"]',NULL,'Unlike natural stone, quartz contains resins and should be protected from excessive heat. Trivets or heat protection should be used beneath hot cookware. Because quartz is engineered, it also won\'t have the same natural variation found in marble, granite, or quartzite.','Clients who value low maintenance, consistency, and a wide range of design options.','/downloads/quartz-care-guide.pdf','Quartz Care + Cleaning Guide','Quartz Countertops Utah | Engineered Quartz Surfaces','Learn about quartz countertops in Utah — low-maintenance engineered surfaces with consistent color, easy care, and a wide range of design options.','Need help choosing?','Not sure which material is right for your project?','The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.','Get an Estimate','Contact Us','/contact','/materials/quartz.webp',2,1,1,'2026-07-23 15:42:29','2026-09-01 12:29:05'),(3,'Marble','marble','A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.','Natural beauty with centuries of history','Marble is a natural stone celebrated for its distinctive veining, depth, and timeless character. No two slabs are exactly alike, making it a beautiful choice for spaces where the material itself is meant to become part of the design.','[\"One-of-a-kind natural veining and variation\", \"Available in subtle, classic patterns as well as dramatic statement stones\", \"Naturally heat resistant\", \"Develops character and patina over time\", \"Beautiful for countertops, vanities, fireplaces, walls, and other architectural applications\"]',NULL,'Marble is naturally porous and can be more susceptible to staining, scratching, and etching from acidic substances than some other surfaces. Sealing and proper care help protect the stone, but clients choosing marble should be comfortable with the natural evolution of the material over time.','Clients who prioritize natural character, movement, and timeless design and are comfortable with a surface that may develop a patina.','/downloads/natural-stone-care-guide.pdf','Natural Stone Care + Cleaning Guide','Marble Countertops Utah | Natural Marble Surfaces','Explore marble countertops and architectural surfaces in Utah. Learn about natural veining, care, and whether marble is right for your kitchen, bath, or feature space.','Need help choosing?','Not sure which material is right for your project?','The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.','Get an Estimate','Contact Us','/contact','/materials/marble.webp',3,0,1,'2026-07-23 15:42:29','2026-09-01 12:29:05'),(4,'Quartzite','quartzite','A natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces.','Natural stone with beauty and strength','Quartzite is a natural stone known for combining striking movement with impressive durability. Its veining and coloration can create the appearance of marble while offering performance characteristics that make many quartzites well suited for hardworking spaces.','[\"Naturally occurring and completely unique from slab to slab\", \"Often features dramatic veining, movement, and depth\", \"Generally highly durable and scratch resistant\", \"Naturally heat resistant\", \"Works beautifully across kitchens, bathrooms, fireplaces, walls, and statement applications\"]',NULL,'Because quartzite is a natural stone, characteristics including porosity, hardness, and maintenance needs can vary between specific materials. Proper sealing and care may be recommended depending on the stone.','Clients looking for the individuality of natural stone with an emphasis on durability and performance.','/downloads/natural-stone-care-guide.pdf','Natural Stone Care + Cleaning Guide','Quartzite Countertops Utah | Durable Natural Stone','Discover quartzite countertops in Utah — natural stone with marble-like beauty and strong everyday performance for kitchens, baths, and feature applications.','Need help choosing?','Not sure which material is right for your project?','The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.','Get an Estimate','Contact Us','/contact','/materials/quartzite.webp',4,0,1,'2026-07-23 15:42:29','2026-09-01 12:29:05'),(5,'Additional Materials','additional-materials','Porcelain and other specialty surfaces available by request for projects that need something beyond the core collection.','Beyond the Core Collection','Creative Granite + Design also works with porcelain and can special order additional surface materials based on the needs of the project. If a client is looking for a specific material or application, our team can help explore available options.','[\"Porcelain surfaces for modern, high-performance applications\", \"Special-order materials based on project requirements\", \"Guidance from our team on suitability and availability\", \"Support for unique design directions and custom applications\"]',NULL,'Availability, lead times, and performance characteristics can vary by material. Our team can help review options and determine what makes sense for your specific project.','Clients exploring porcelain, specialty surfaces, or materials outside the core stone collection.',NULL,NULL,'Additional Surface Materials | Creative Granite Utah','Explore porcelain and specialty surface materials available through Creative Granite + Design in Utah. Custom options for unique projects.','Need help choosing?','Not sure which material is right for your project?','The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.','Get an Estimate','Contact Us','/contact','/materials/granite.webp',5,0,1,'2026-09-01 12:29:05','2026-09-01 12:29:05');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_28_230800_create_cms_modules_table',1),(5,'2026_04_28_230924_create_cms_module_permissions_table',1),(6,'2026_06_26_100000_create_site_settings_table',1),(7,'2026_06_26_100100_create_content_sections_table',1),(8,'2026_06_26_100200_create_materials_table',1),(9,'2026_06_26_100300_create_hero_slides_table',1),(10,'2026_06_26_100400_create_services_table',1),(11,'2026_06_26_100500_create_process_steps_table',1),(12,'2026_06_26_100600_create_testimonials_table',1),(13,'2026_06_26_100700_create_navigation_items_table',1),(14,'2026_06_26_100800_create_portfolio_items_table',1),(15,'2026_06_26_100900_create_instagram_posts_table',1),(16,'2026_06_26_120000_simplify_portfolio_items_table',1),(17,'2026_06_26_130000_drop_removed_admin_content_tables',1),(18,'2026_07_06_120000_create_email_templates_table',1),(19,'2026_07_07_000000_create_products_table',1),(20,'2026_07_07_010000_create_contact_inquiries_table',1),(21,'2026_07_07_010000_create_product_images_table',1),(22,'2026_07_07_020000_create_process_steps_table',1),(23,'2026_07_07_030000_create_project_types_table',1),(24,'2026_07_07_040000_create_estimate_requests_table',1),(25,'2026_07_15_040000_add_featured_and_sort_to_portfolio_items_table',1),(26,'2026_07_15_223000_add_is_featured_to_materials_table',1),(27,'2026_07_24_004000_create_instagram_posts_table',1),(28,'2026_07_28_230000_create_gallery_albums_table',2),(29,'2026_07_28_235000_create_gallery_album_images_table',3),(30,'2026_07_30_050000_create_service_page_sections_tables',4),(31,'2026_08_27_000000_add_spec_fields_to_products_table',5),(32,'2026_09_01_000000_create_product_categories_table',6),(33,'2026_09_01_100000_add_detail_fields_to_materials_table',6),(34,'2026_09_01_100001_create_material_images_table',6),(35,'2026_09_01_110000_add_admin_content_fields_to_materials_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_items`
--

DROP TABLE IF EXISTS `portfolio_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_items_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_items`
--

LOCK TABLES `portfolio_items` WRITE;
/*!40000 ALTER TABLE `portfolio_items` DISABLE KEYS */;
INSERT INTO `portfolio_items` VALUES (1,'Carrara Island','carrara-island','/storage/site/xTF9G3dEHg4l4yLhd3CFWe9TNYQgA5fs9OUAsuRk.jpg',1,1,1,'2026-07-23 15:42:29','2026-07-23 16:26:19'),(2,'Modern Kitchen','modern-kitchen','/storage/site/FRJVfeJ3WrCJR3UJ8hyz8tHB2X2OXGxvcrPoKN6B.jpg',3,1,1,'2026-07-23 15:42:29','2026-07-28 15:37:21'),(5,'Architectural','architectural','/storage/site/SlwkAaqN2B83bobmzWZeVgUFoDgjf2VUO1pqj6zE.jpg',5,1,1,'2026-07-23 15:42:29','2026-07-23 16:29:51'),(10,'Carrara Island','carrara-island-2','/storage/site/f1rwlM74JFNbhYR2F5DfoJThicdfdwcA4yse6dsE.jpg',2,1,1,'2026-07-28 14:31:53','2026-07-28 15:37:09'),(11,'Modern Kitchen','modern-kitchen-1','/storage/site/9M3QVnLQTnfSQZX6oc7hLGj5G8PZvyjAAQdPa3S1.jpg',4,1,1,'2026-07-28 14:31:53','2026-07-28 15:37:33');
/*!40000 ALTER TABLE `portfolio_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_steps`
--

DROP TABLE IF EXISTS `process_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `process_steps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `step_number` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `process_steps_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_steps`
--

LOCK TABLES `process_steps` WRITE;
/*!40000 ALTER TABLE `process_steps` DISABLE KEYS */;
INSERT INTO `process_steps` VALUES (1,'01','Plans / Measurements + Details','initial-consultation','Send plans, measurements, and scope details (material preference, edge style, sink type, backsplash, etc.) so we can provide an accurate estimate.',1,1,'2026-07-23 15:42:29','2026-08-17 18:02:48'),(2,'02','Estimate','estimate-material-selection','We provide a detailed bid and finalize all project details, including material, edge profile, sink cutouts, overhangs, and layout, prior to templating.',2,1,'2026-07-23 15:42:29','2026-08-17 18:03:12'),(3,'03','On-site Template','template-measurement','We template your space to ensure precise fabrication.',3,1,'2026-07-23 15:42:29','2026-08-17 18:03:30'),(4,'04','Fabrication','fabrication-install','Your stone is cut, shaped, and finished in our shop.',4,1,'2026-07-23 15:42:29','2026-08-17 18:05:11'),(5,'05','Installation','installation','Our install team completes final placement on site.',5,1,'2026-08-17 18:05:36','2026-08-17 18:05:36'),(6,'06','Quality Control','quality-control','Final inspection to ensure everything meets our standards before project close-out.',6,1,'2026-08-17 18:05:56','2026-08-17 18:05:56');
/*!40000 ALTER TABLE `process_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,17,'/images/products/VC12.png','Standard',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(2,18,'/images/products/VC10.png','Standard',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(3,19,'/images/products/VC50.png','Standard',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(4,20,'/images/products/VC60.png','Standard',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(5,21,'/images/products/FC-MOD-33-WHITE13520010120.PT00.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(6,21,'/images/products/FC-MOD-33-MATTEGRAY13520200120.PT00.png','Matte Charcoal',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(7,22,'/images/products/FC-CL-332-DBL-WHITE1139-001-0120.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(9,23,'/images/products/FC-MOD-36-WHITE.PT00.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(10,23,'/images/products/FC-MOD-36-MATTEGRAY13540200120.PT00.png','Matte Charcoal',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(11,24,'/images/products/FC-MOD-362-DBL-WHITE13500010120.PT00.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(12,24,'/images/products/FC-MOD-362-DBL-MATTEGRAY13500200120.PT00.png','Matte Charcoal',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(13,25,'/images/products/1000 White.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(14,25,'/images/products/1000 Black.png','Black',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(15,25,'/images/products/1000 Mocha.png','Mocha',3,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(16,25,'/images/products/1000 Concrete.png','Concrete',4,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(17,25,'/images/products/1000 Beige.png','Beige',5,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(23,27,'/images/products/6040 Black.png','Black',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(24,27,'/images/products/6040 Mocha.png','Mocha',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(25,27,'/images/products/6040 Concrete.png','Concrete',3,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(26,27,'/images/products/6040 Beige.png','Beige',4,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(28,29,'/images/products/2318 White.png','White',1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(29,29,'/images/products/2318 Black.png','Black',2,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(30,29,'/images/products/2318 Mocha.png','Mocha',3,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(31,29,'/images/products/2318 Concrete.png','Concrete',4,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(32,29,'/images/products/2318 Beige.png','Beige',5,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(33,5,'/storage/products/UPmE1wRTu3m9YfdAf2deqRowVSVLw32ZiHhNASsm.png','Standard',1,'2026-08-31 14:36:20','2026-08-31 14:36:20'),(37,11,'/storage/products/wjyhnGGV1PDTiL4fIx6tRyJjb1U6CNUJFVOsb3W5.png','Standard',1,'2026-08-31 14:54:32','2026-08-31 14:54:32'),(38,12,'/storage/products/5o1YKQ441JepOhXf65SNRzPBk99WOKyClrbf2Ckz.png','Standard',1,'2026-08-31 15:04:27','2026-08-31 15:04:27'),(40,14,'/storage/products/FgKbp6e8OVEqzZsb5grxBp4PcmL7e9AOQWSFxrAq.png','Standard',1,'2026-08-31 15:05:58','2026-08-31 15:05:58'),(41,15,'/storage/products/o2SgJi9ex5Ih0ln4qhjdTe203TDJWnt5SEZPYQ3o.png','Standard',1,'2026-08-31 15:06:29','2026-08-31 15:06:29'),(42,16,'/storage/products/t6i8t7BEMICU0okzVOJMtUZMxRgRJXoqBZ7AZmwj.png','Standard',1,'2026-08-31 15:07:01','2026-08-31 15:07:01'),(49,6,'/storage/products/IPlatQDFAweCddRphfGgujkXp4fpPtVjX6NDcaJD.png','Standard',1,'2026-08-31 15:46:19','2026-08-31 15:46:19'),(53,13,'/storage/products/KvmK8RtkePVt1o0afLPgfuKNNePOsoET9XgW8vBY.png','Standard',1,'2026-08-31 16:07:24','2026-08-31 16:07:24'),(55,8,'/storage/products/M7CFK0rnKJWmPLpyQ0uPSkBrYJKL0GyeqHe2yjwH.png','Standard',1,'2026-08-31 16:14:20','2026-08-31 16:14:20'),(56,9,'/storage/products/nS5cuL3evBxXs5GA4o8VKlrZRvUUmLvxSNA4xidK.png','Standard',1,'2026-08-31 16:14:51','2026-08-31 16:14:51'),(57,10,'/storage/products/D3zwJQwzuttH9tNMjun4Z9sl1vj4WW3qXABNTRtH.png','Standard',1,'2026-08-31 16:15:21','2026-08-31 16:15:21'),(59,26,'/storage/products/CtxYuACm6IkWTe7RD5hAzbtzEwEtDc8kZXMXodML.png','White',1,'2026-08-31 16:39:03','2026-08-31 16:40:29'),(60,26,'/storage/products/variants/nGKwJKUI2IXpfFnrUqgPXampRsghyaWNxIqMhJvt.png','Concrete',2,'2026-08-31 16:39:48','2026-08-31 16:39:48'),(61,26,'/storage/products/variants/AWBkAZPZaXA3dqLJp2q2MwVODu6DGSZTQs18eebE.png','Beige',3,'2026-08-31 16:40:29','2026-08-31 16:40:29'),(62,26,'/storage/products/variants/vusUBfNDVjEdVLilDLQGc8GLPzxitUFCJWQocjnV.png','Black',4,'2026-08-31 16:41:02','2026-08-31 16:41:02'),(63,26,'/storage/products/variants/tGbnmtYqlg9ruLu7nIWXYYjd8DYBQaNJspRYjn03.png','Mocha',5,'2026-08-31 16:41:30','2026-08-31 16:41:30'),(64,27,'/storage/products/variants/Dp2GCucjnFQYDF7xCgDdW1vja0UxexZH8W4jKx4F.png','White',5,'2026-08-31 16:43:39','2026-08-31 16:43:39'),(65,28,'/storage/products/JcsvidqQqnY0nWwNt9cjFX41BmLukytLrMAmorqv.png','White',1,'2026-08-31 17:08:51','2026-08-31 17:10:41'),(66,28,'/storage/products/variants/5MMo4glZyJSKnBmGg1xBTxmWALGhQOyZb4BjjUmh.png','Beige',2,'2026-08-31 17:09:54','2026-08-31 17:09:54'),(67,28,'/storage/products/variants/F3aha3IhBZuNrDMUQrInwTKM1RrltENTMmC6RKVY.png','Mocha',3,'2026-08-31 17:10:41','2026-08-31 17:10:41'),(68,28,'/storage/products/variants/yBTDT4Gnh3jptmrHQkeve9kgpUTOoDSMBQCpt7TP.png','Concrete',4,'2026-08-31 17:11:11','2026-08-31 17:11:11'),(69,28,'/storage/products/variants/u4vgLhmLNiFN7OQvKLxX0I0eQrYQj3N0JC6bH23Z.png','Black',5,'2026-08-31 17:11:38','2026-08-31 17:11:38'),(70,21,'/storage/products/variants/KBS9jIrwZ1Cv5cjjaDOfuHNihbF3xvotscTMRm0s.png','White',3,'2026-08-31 17:14:51','2026-08-31 17:14:51'),(71,22,'/storage/products/variants/gbyScX9ScOjOToNNHfXAJc30Cl8Xg2eYJjrhTixA.png','Matte Charcoal',2,'2026-08-31 17:23:20','2026-08-31 17:23:20'),(73,7,'/storage/products/Mtz3C7gvmIBJHcVpKOfJHuNYyfh5Yq5XzFC1xkyV.png','Standard',1,'2026-08-31 17:27:55','2026-08-31 17:27:55');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category_id` bigint unsigned DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bowl_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gauge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `construction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dimensions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors_finish` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optional_accessories` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (5,'ESI-S380-16','esi-s380-16','ESI-S380-16',NULL,'Stainless Steel','Large single bowl','Undermount','16','Type 304SS','31-1/2\" x 18-1/4\" O.D. x 9\" D','Stainless Steel','Custom fit sink grid (ESI-S380-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)',NULL,'Large single bowl','/storage/products/UPmE1wRTu3m9YfdAf2deqRowVSVLw32ZiHhNASsm.png',1,1,'2026-08-26 17:33:29','2026-08-31 14:36:20'),(6,'ESI-S360-16','esi-s360-16','ESI-S360-16',NULL,'Stainless Steel','60/40 double bowl','Undermount','16','Type 304SS','31-3/4\" x 20-5/8\" O.D. x 9\" / 7\" D','Stainless Steel','Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)',NULL,'60/40 double bowl','/storage/products/IPlatQDFAweCddRphfGgujkXp4fpPtVjX6NDcaJD.png',2,1,'2026-08-26 17:33:29','2026-08-31 15:46:19'),(7,'ESI-S360R-16','esi-s360r-16','ESI-S360R-16',NULL,'Stainless Steel','40/60 double bowl','Undermount','16','Type 304SS','31-3/4\" x 20-5/8\" O.D. x 7\" / 9\" D','Stainless Steel','Custom fit sink grids (ESI-S360-GRD); silicone cutting board (ESI-DSCBOARD); strainer (ESI-SSS-USB1-EXT); drain cover (ESI-SSS-UDDC1)',NULL,'40/60 double bowl','/storage/products/Mtz3C7gvmIBJHcVpKOfJHuNYyfh5Yq5XzFC1xkyV.png',3,1,'2026-08-26 17:33:29','2026-08-31 17:27:55'),(8,'ESI-S330-18','esi-s330-18','ESI-S330-18',NULL,'Stainless Steel','Small single bowl','Undermount','18','Type 304SS','16-1/2\" x 18\" O.D. x 9\" D','Stainless Steel','Custom fit sink grid; silicone cutting board; strainer; drain cover',NULL,'Small single bowl','/storage/products/M7CFK0rnKJWmPLpyQ0uPSkBrYJKL0GyeqHe2yjwH.png',4,1,'2026-08-26 17:33:29','2026-08-31 16:14:20'),(9,'ESI-S320-18','esi-s320-18','ESI-S320-18',NULL,'Stainless Steel','Small single bowl','Undermount','18','Type 304SS','16\" x 16\" O.D. x 8\" D','Stainless Steel','Custom fit sink grid; silicone cutting board; strainer; drain cover',NULL,'Small single bowl','/storage/products/nS5cuL3evBxXs5GA4o8VKlrZRvUUmLvxSNA4xidK.png',5,1,'2026-08-26 17:33:29','2026-08-31 16:14:51'),(10,'ESI-S310-18','esi-s310-18','ESI-S310-18',NULL,'Stainless Steel','Small single bowl','Undermount','18','Type 304SS','12-5/8\" x 15\" O.D. x 7\" D','Stainless Steel','Custom fit sink grid; silicone cutting board; strainer; drain cover',NULL,'Small single bowl','/storage/products/D3zwJQwzuttH9tNMjun4Z9sl1vj4WW3qXABNTRtH.png',6,1,'2026-08-26 17:33:29','2026-08-31 16:15:21'),(11,'ESI-S225-18','esi-s225-18','ESI-S225-18',NULL,'Stainless Steel','50/50 double bowl, handmade','Undermount','18','Type 304SS','31\" x 18\" O.D. x 9\" / 9\" D','Stainless Steel','Not shown on photographed page',NULL,'50/50 double bowl, handmade','/storage/products/wjyhnGGV1PDTiL4fIx6tRyJjb1U6CNUJFVOsb3W5.png',7,1,'2026-08-26 17:33:29','2026-08-31 14:54:32'),(12,'ESI-S275-18','esi-s275-18','ESI-S275-18',NULL,'Stainless Steel','Large single bowl, handmade','Undermount','18','Type 304SS','31-13/16\" x 18-1/8\" O.D. x 9\" D','Stainless Steel','Not shown on photographed page',NULL,'Large single bowl, handmade','/storage/products/5o1YKQ441JepOhXf65SNRzPBk99WOKyClrbf2Ckz.png',8,1,'2026-08-26 17:33:29','2026-08-31 15:04:27'),(13,'ESI-S270-18','esi-s270-18','ESI-S270-18',NULL,'Stainless Steel','40/60 double bowl, handmade','Undermount','18','Type 304SS','31-1/4\" x 20-13/16\" O.D. x 7\" / 9\" D','Stainless Steel','Not shown on photographed page',NULL,'40/60 double bowl, handmade','/storage/products/KvmK8RtkePVt1o0afLPgfuKNNePOsoET9XgW8vBY.png',9,1,'2026-08-26 17:33:29','2026-08-31 16:07:24'),(14,'ESI-S265-18','esi-s265-18','ESI-S265-18',NULL,'Stainless Steel','60/40 double bowl, handmade','Undermount','18','Type 304SS','31-1/4\" x 20-13/16\" O.D. x 9\" / 7\" D','Stainless Steel','Not shown on photographed page',NULL,'60/40 double bowl, handmade','/storage/products/FgKbp6e8OVEqzZsb5grxBp4PcmL7e9AOQWSFxrAq.png',10,1,'2026-08-26 17:33:29','2026-08-31 15:05:58'),(15,'ESI-S210-18','esi-s210-18','ESI-S210-18',NULL,'Stainless Steel','Medium single bowl','Undermount','18','Type 304SS','23\" x 18\" O.D. x 9\" D','Stainless Steel','Not shown on photographed page',NULL,'Medium single bowl','/storage/products/o2SgJi9ex5Ih0ln4qhjdTe203TDJWnt5SEZPYQ3o.png',11,1,'2026-08-26 17:33:29','2026-08-31 15:06:29'),(16,'ESI-S200-18','esi-s200-18','ESI-S200-18',NULL,'Stainless Steel','Small single bowl, handmade','Undermount','18','Type 304SS','17-1/8\" x 15-1/4\" O.D. x 9\" D','Stainless Steel','Not shown on photographed page',NULL,'Small single bowl, handmade','/storage/products/t6i8t7BEMICU0okzVOJMtUZMxRgRJXoqBZ7AZmwj.png',12,1,'2026-08-26 17:33:29','2026-08-31 15:07:01'),(17,'ESI-VC12','esi-vc12','ESI-VC12',NULL,'Porcelain','Small oval vanity','Undermount',NULL,'Porcelain','15\" x 12\" I.D. x 6\" D','White; Bisque','Not shown',NULL,'Small oval vanity','/images/products/VC12.png',13,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(18,'ESI-VC10','esi-vc10','ESI-VC10',NULL,'Porcelain','Large oval vanity','Undermount',NULL,'Porcelain','17-1/4\" x 14\" I.D. x 6-1/4\" D','White; Bisque','Not shown',NULL,'Large oval vanity','/images/products/VC10.png',14,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(19,'ESI-VCR50','esi-vcr50','ESI-VCR50',NULL,'Porcelain','Small rectangle (eased) vanity','Undermount',NULL,'Porcelain','16\" x 11\" I.D. x 6\" D','White; Bisque','Not shown',NULL,'Small rectangle (eased) vanity','/images/products/VC50.png',15,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(20,'ESI-VCR60','esi-vcr60','ESI-VCR60',NULL,'Porcelain','Large rectangle (eased) vanity','Undermount',NULL,'Porcelain','18\" x 13\" I.D. x 6\" D','White; Bisque','Not shown',NULL,'Large rectangle (eased) vanity','/images/products/VC60.png',16,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(21,'ESI-FCMOD33','esi-fcmod33','ESI-FCMOD33',NULL,'Fireclay','33-inch modern smooth single bowl','Apron-front',NULL,'Fireclay','33\" x 19\" O.D. x 10\" D','White; Matte Charcoal','Custom sink grid (ESI-FCMOD33-GRD)',NULL,'33-inch modern smooth single bowl','/images/products/FC-MOD-33-WHITE13520010120.PT00.png',17,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(22,'ESI-FCCL332D','esi-fccl332d','ESI-FCCL332D',NULL,'Fireclay','33-inch classic smooth double bowl','Apron-front',NULL,'Fireclay','33\" x 18\" O.D. x 10\" / 10\" D','White; Matte Charcoal','Custom sink grid (ESI-FCCL332D-GRD)',NULL,'33-inch classic smooth double bowl','/images/products/FC-CL-332-DBL-WHITE1139-001-0120.png',18,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(23,'ESI-FCMOD36','esi-fcmod36','ESI-FCMOD36',NULL,'Fireclay','36-inch modern smooth single bowl','Apron-front',NULL,'Fireclay','36\" x 19\" O.D. x 10\" D','White; Matte Charcoal','Custom sink grid (ESI-FCMOD36-GRD)',NULL,'36-inch modern smooth single bowl','/images/products/FC-MOD-36-WHITE.PT00.png',19,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(24,'ESI-FCMOD362D','esi-fcmod362d','ESI-FCMOD362D',NULL,'Fireclay','36-inch modern smooth double bowl','Apron-front',NULL,'Fireclay','36\" x 19\" O.D. x 10\" / 10\" D','White; Matte Charcoal','Custom sink grid (ESI-FCMOD362D-GRD)',NULL,'36-inch modern smooth double bowl','/images/products/FC-MOD-362-DBL-WHITE13500010120.PT00.png',20,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(25,'ESI-QS1000','esi-qs1000','ESI-QS1000',NULL,'Quartz Composite','32-inch large single bowl','Undermount',NULL,'Quartz composite','32\" x 19\" O.D. x 9\" D','White; Black; Mocha; Concrete; Beige','Custom fit sink grid; matching strainer basket; matching disposal flange',NULL,'32-inch large single bowl','/images/products/1000 White.png',21,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(26,'ESI-QS5050','esi-qs5050','ESI-QS5050',NULL,'Quartz Composite','32-inch 50/50 double equal bowl','Undermount',NULL,'Quartz composite','32\" x 19\" O.D. x 9\" / 9\" D','White; Black; Mocha; Concrete; Beige','Custom fit sink grids; matching strainer basket; matching disposal flange',NULL,'32-inch 50/50 double equal bowl','/storage/products/CtxYuACm6IkWTe7RD5hAzbtzEwEtDc8kZXMXodML.png',22,1,'2026-08-26 17:33:29','2026-08-31 16:39:03'),(27,'ESI-QS6040','esi-qs6040','ESI-QS6040',NULL,'Quartz Composite','32-inch 60/40 large/small bowl','Undermount',NULL,'Quartz composite','32\" x 19\" O.D. x 9\" / 7-1/2\" D','White; Black; Mocha; Concrete; Beige','Custom fit sink grids; matching strainer basket; matching disposal flange',NULL,'32-inch 60/40 large/small bowl','/images/products/6040 Black.png',23,1,'2026-08-26 17:33:29','2026-08-26 17:33:29'),(28,'ESI-QS1618','esi-qs1618','ESI-QS1618',NULL,'Quartz Composite','16-1/2-inch small single bowl / bar sink','Undermount',NULL,'Quartz composite','16-1/2\" x 18\" O.D. x 8\" D','White; Black; Mocha; Concrete; Beige','Custom fit sink grid; matching strainer basket; matching disposal flange',NULL,'16-1/2-inch small single bowl / bar sink','/storage/products/JcsvidqQqnY0nWwNt9cjFX41BmLukytLrMAmorqv.png',24,1,'2026-08-26 17:33:29','2026-08-31 17:08:51'),(29,'ESI-QS2318','esi-qs2318','ESI-QS2318',NULL,'Quartz Composite','23-inch medium single bowl kitchen/utility','Undermount',NULL,'Quartz composite','23\" x 18\" O.D. x 8-1/2\" D','White; Black; Mocha; Concrete; Beige','Custom fit sink grid; matching strainer basket; matching disposal flange',NULL,'23-inch medium single bowl kitchen/utility','/images/products/2318 White.png',25,1,'2026-08-26 17:33:29','2026-08-26 17:33:29');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_types`
--

DROP TABLE IF EXISTS `project_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_types`
--

LOCK TABLES `project_types` WRITE;
/*!40000 ALTER TABLE `project_types` DISABLE KEYS */;
INSERT INTO `project_types` VALUES (1,'New construction','new-construction',1,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(2,'Remodel & renovation','remodel-renovation',2,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(3,'Multifamily & commercial','multifamily-commercial',3,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(4,'Other','other',4,1,'2026-07-23 15:42:29','2026-07-23 15:42:29');
/*!40000 ALTER TABLE `project_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_page_section_images`
--

DROP TABLE IF EXISTS `service_page_section_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_page_section_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_page_section_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sps_images_section_sort_idx` (`service_page_section_id`,`sort_order`),
  CONSTRAINT `service_page_section_images_service_page_section_id_foreign` FOREIGN KEY (`service_page_section_id`) REFERENCES `service_page_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_page_section_images`
--

LOCK TABLES `service_page_section_images` WRITE;
/*!40000 ALTER TABLE `service_page_section_images` DISABLE KEYS */;
INSERT INTO `service_page_section_images` VALUES (1,1,'/images/services/new-construction-1.jpg',1,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(2,1,'/images/services/new-construction-2.jpg',2,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(3,1,'/images/services/new-construction-3.jpg',3,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(4,2,'/images/services/remodel-1.jpg',1,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(5,2,'/images/services/remodel-2.jpg',2,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(6,2,'/images/services/remodel-3.jpg',3,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(7,3,'/images/services/commercial-1.jpg',1,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(8,3,'/images/services/commercial-2.jpg',2,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(9,3,'/images/services/commercial-3.jpg',3,'2026-07-29 19:20:03','2026-07-29 19:20:03');
/*!40000 ALTER TABLE `service_page_section_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_page_sections`
--

DROP TABLE IF EXISTS `service_page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_page_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number_label` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `hero_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_page_sections`
--

LOCK TABLES `service_page_sections` WRITE;
/*!40000 ALTER TABLE `service_page_sections` DISABLE KEYS */;
INSERT INTO `service_page_sections` VALUES (1,'01','New Construction & Residential','Partnering with builders, designers, and homeowners to fabricate and install custom stone surfaces with precision from planning through installation.','/images/services/new-construction-hero.jpg',1,1,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(2,'02','Remodel & Renovation','Transform kitchens, bathrooms, fireplaces, and living spaces with expertly fabricated stone tailored to your vision.','/images/services/remodel-hero.png',2,1,'2026-07-29 19:20:03','2026-07-29 19:20:03'),(3,'03','Multifamily & Commercial','Reliable stone fabrication and installation for multifamily developments, hospitality, retail, healthcare, office, and commercial environments.','/images/services/commercial-hero.jpg',3,1,'2026-07-29 19:20:03','2026-07-29 19:20:03');
/*!40000 ALTER TABLE `service_page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `main_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'New Construction & Residential','new-construction','<p>Stone fabrication for new builds, working closely with builders, designers, and project teams to ensure accuracy, efficiency, and consistency from planning through installation.</p>',NULL,NULL,NULL,NULL,1,1,'2026-07-23 15:42:29','2026-07-27 12:08:13'),(2,'Remodel & Renovation','remodel-renovation','Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.',NULL,NULL,NULL,NULL,2,1,'2026-07-23 15:42:29','2026-07-23 15:42:29'),(3,'Multifamily & Commercial','multifamily-commercial','Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient xecution, consistent quality, and dependable delivery.',NULL,NULL,NULL,NULL,3,1,'2026-07-23 15:42:29','2026-07-29 19:20:03'),(5,'New Construction','new-construction-1','<p>Stone fabrication for new builds, working closely with builders, designers, andproject teams to ensure accuracy, efficiency, and consistency from planning through installation.</p>',NULL,NULL,NULL,NULL,1,0,'2026-07-29 19:20:03','2026-07-29 22:36:32');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2qZgOhR69cYDmFzuOQJFCV3XC22G1vihyMNaS7PV',1,'154.57.213.197','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTkhPakRxaFppT0F4TUlGOXV6Q0oyZVdBMENaZW1VZUliM3dQYmNlVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cHM6Ly9jcmVhdGl2ZS1ncmFuaXRlLnNpdGVzdGFnaW5nbGluay5jb20vYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1788215281),('3CO4slzuwTXTPepvChxh76vU8VeOFd1c3QbZ4jV1',NULL,'187.13.13.47','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkRUUDF4ZWcxeUg3dnZyVVVEVVFYQ09QbmtOakM5UDBSOE42UFhwUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1788213767),('3uckL8qQ9qpxZwxx81W1qGPr2ghze6lqPHTaQvmT',NULL,'136.38.202.166','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib09tSmJaRjhnY3lKN0txWWs4WFhOdU90aTVzb0VoWmgzU2hDbk1LWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788214653),('87icbVO0o4WPpWf3kZsaIoKPRRaYqt6eaWl5hbwr',NULL,'154.57.213.197','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzUxZ3BzWm1VZEl5OE1SSXBjWjRGTTRkZVBzdE1xa1p0cEUxbERWdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788209175),('8pETOQUszNz68Ee4MScgEje84J03fFoF7I7NzUh2',NULL,'154.57.192.84','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic1U5TnE0SXJ0eUg2dVJkcVoxbk1xVDlmZ3lCaDZxRFpxZmt6d0MxSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788210004),('9oqkOsB3n416flZmfzY4pTRpzNdo5Klv8NSnaMeJ',NULL,'154.57.192.84','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRm5PSjJsWFcwMmM2Ukoya1p5QU1XVGpMUlNkTGxjYjY2ekduZk5URCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1788217120),('BgDJubLoj6UzPDKMkdeKH0iF5x31vs49xHGgHgTL',1,'154.57.192.84','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU2R1RVF3clVXSm5XeWVtR0VqZFpjMjhDUzAzeFRzTDlBUWgzUlgxeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cHM6Ly9jcmVhdGl2ZS1ncmFuaXRlLnNpdGVzdGFnaW5nbGluay5jb20vYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1788283821),('c1gDANO9BcLvlDiRcmLLmbb919C3NAyCeOOo1b92',NULL,'100.55.96.51','Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)','YTozOntzOjY6Il90b2tlbiI7czo0MDoia25kSWE3ck9CeWQwQllOUTN6TzZ4bjBWMVpLalRPdmoxR1pMc1ExNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1788209965),('G22eWRz7etrty1pf3OZbSZ46o3keyKyShezGRbCP',NULL,'136.38.202.166','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoickN1MDFEZ3JBdlk1WGtQZk54ZU0ySnZnemJ1NUtuNm14QnFvZlpQNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2Nlc3MiO3M6NToicm91dGUiO3M6NzoicHJvY2VzcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1788204922),('UEDIsxOxooiegPu83iGeo1b5eWsU0CavCHe6pSwr',1,'154.57.213.197','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQmZIeU05YkRna2pHWTlZZ0Ric21CaUFOcmZFU2xudnJ4RkkwS01BbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjg6InByb2R1Y3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cHM6Ly9jcmVhdGl2ZS1ncmFuaXRlLnNpdGVzdGFnaW5nbGluay5jb20vYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1788217014),('V3oCUyWc1rWGXAMyS584YpjG0HGbgfyIWEx7g6OJ',NULL,'136.38.202.166','Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5.2 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWlNVXNqNWtqOWZOZ05OZ1FaOE01MTZaUmt2aDhBTjhyekxyWU1PcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1788216067),('wuGbIEVsTZFoXW88rYonEjNFXLcIwnQ1eXWsdfR8',1,'154.57.213.197','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1A2M2dMSVFodXVhc01jWHBWUlBqRnB0VXhLeHA0NzVWcU84TWVTciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vY3JlYXRpdmUtZ3Jhbml0ZS5zaXRlc3RhZ2luZ2xpbmsuY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1788281410);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'logo_path','/images/site/update-logo.png','image','assets','2026-07-23 15:42:29','2026-07-23 15:42:29'),(2,'about_image_path','/images/site/LakeLine-20.jpg','image','assets','2026-07-23 15:42:29','2026-07-28 14:31:53'),(3,'instagram_url','https://www.instagram.com/creativegraniteanddesign/','url','social','2026-07-23 15:42:29','2026-07-23 15:42:29'),(4,'showroom_maps_url','https://www.google.com/maps/place/1998+N+Redwood+Rd,+Salt+Lake+City,+UT+84116,+USA/@40.8115045,-111.9402546,16.96z/data=!4m6!3m5!1s0x8752f6bad3a740e7:0x54da835cc07f3b51!8m2!3d40.8115002!4d-111.9376702!16s%2Fg%2F11c1zjtg8r?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D','url','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(5,'address_line_1','1998 n redwood rd','string','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(6,'address_line_2','Salt lake city, ut 84116','string','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(7,'phone','801.886.0204','phone','contact','2026-07-23 15:42:29','2026-07-29 22:40:03'),(8,'email','info@creativegranite.com','email','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(9,'hours','8am – 5pm · Mon – Fri','string','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(10,'contact_form_intro','Tell us about your project — we will follow up with next steps, timing, and a path to estimate.','string','contact','2026-07-23 15:42:29','2026-07-23 15:42:29'),(11,'founded_year','1998','string','general','2026-07-23 15:42:29','2026-07-23 15:42:29'),(12,'footer_tagline','Built on craftsmanship. Serving Utah since 1998.','string','general','2026-07-23 15:42:29','2026-07-23 15:42:29'),(13,'who_we_are_eyebrow','Who we are','string','who_we_are','2026-07-23 15:42:29','2026-07-23 15:42:29'),(14,'who_we_are_heading','Built on craftsmanship since','string','who_we_are','2026-07-23 15:42:29','2026-07-23 15:42:29'),(15,'who_we_are_highlight_text','1998','string','who_we_are','2026-07-23 15:42:29','2026-07-23 15:42:29'),(16,'who_we_are_body','Creative Granite + Design is a Utah-based stone fabrication company specializing in custom countertops and architectural surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high-quality installation across residential and multifamily projects.','string','who_we_are','2026-07-23 15:42:29','2026-07-23 15:42:29'),(17,'gallery_eyebrow','Our Work','string','gallery','2026-07-28 14:31:53','2026-07-28 14:31:53'),(18,'gallery_heading','Explore Our Portfolio','string','gallery','2026-07-28 14:31:53','2026-07-29 19:20:03'),(19,'gallery_body','Discover a curated collection of kitchens, bathrooms, fireplaces, commercial spaces, and custom stone applications that showcase our craftsmanship and attention to detail.','string','gallery','2026-07-28 14:31:53','2026-07-29 19:20:03'),(20,'gallery_featured_eyebrow','Featured Projects','string','gallery','2026-07-28 14:31:53','2026-07-28 14:31:53'),(21,'gallery_featured_heading','A Collection of Our Work','string','gallery','2026-07-28 14:31:53','2026-08-14 22:21:55'),(22,'footer_copyright','© 2026 Creative granite & design. All rights reserved.','string','general','2026-07-29 15:56:32','2026-07-29 15:56:32'),(23,'services_page_eyebrow','Services','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(24,'services_page_heading','Stone Fabrication for Every Stage of Your Project','string','services_page','2026-07-29 19:20:03','2026-07-29 23:16:04'),(25,'services_page_body','From custom homes and remodels to multifamily and commercial spaces, we fabricate, install, and support premium stone surfaces built to last.','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(26,'services_page_hero_path','/storage/services-page/DDssHKzQdNGijsu6kQkA1IpTJ8fVood6YNvoq6Vt.webp','image','services_page','2026-07-29 19:20:03','2026-07-29 23:14:19'),(27,'services_page_repairs_number','04','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(28,'services_page_repairs_eyebrow','Repairs & Warranty','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(29,'services_page_repairs_heading','Stand Behind Every Installation','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(30,'services_page_repairs_body','Our commitment doesn\'t end after installation. We provide warranty support for qualifying workmanship and offer repair services to help keep your stone surfaces looking their best.','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(31,'services_page_repairs_image_path','/images/services/repairs-hero-voyager.png','image','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(32,'services_page_warranty_title','Warranty','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(33,'services_page_warranty_points','One-year workmanship warranty\r\nWarranty support for qualifying fabrication and installation issues\r\nDedicated service team','string','services_page','2026-07-29 19:20:03','2026-07-29 23:14:19'),(34,'services_page_warranty_cta','Request a Warranty Repair','string','services_page','2026-07-29 19:20:03','2026-07-29 23:16:04'),(35,'services_page_repairs_card_title','Repairs','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(36,'services_page_repairs_points','Repair services available by request\r\nContact us for an evaluation and quote','string','services_page','2026-07-29 19:20:03','2026-07-29 23:14:19'),(37,'services_page_repairs_cta','Request a Repair Estimate','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(38,'services_page_cta_heading','Start Your Project','string','services_page','2026-07-29 19:20:03','2026-08-14 17:15:36'),(39,'services_page_cta_body','Whether you\'re building a custom home, remodeling an existing space, or managing a multifamily or commercial project, our team is ready to bring your vision to life.','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(40,'services_page_cta_button','Get an Estimate','string','services_page','2026-07-29 19:20:03','2026-07-29 19:20:03'),(41,'process_eyebrow','Process','string','process','2026-08-17 17:57:46','2026-08-17 17:58:27'),(42,'process_heading','Project timeline','string','process','2026-08-17 17:57:46','2026-08-17 17:59:20'),(43,'process_subheading','','string','process','2026-08-17 17:57:46','2026-08-17 17:57:46'),(44,'process_top_banner_path','/storage/process/9fAxsFQe2ATYXkaFFbD7OC78I6nlvxwjnhFC3ZjM.jpg','image','process','2026-08-24 15:07:34','2026-08-24 15:07:34'),(45,'process_bottom_banner_path','/storage/process/UI6sOz7f67G1K40R9HZGAvJziv3sRIe4yt1aUr2u.jpg','image','process','2026-08-24 15:07:42','2026-08-24 15:07:42');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Admin','admin@admin.com',NULL,'$2y$12$Jri9ek5LTwQGksIt.t0VUety296lXlqdQ7KCkNS98tZm4WJzXOStW','i3RHGEG8soTizSSinnNPCGBw5nAPI6teMuoGjpTGXGTgLDsPri7ZGaurRIfi','2026-07-23 15:42:29','2026-07-23 15:42:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-01 22:34:10
