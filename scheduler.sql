DROP TABLE IF EXISTS `jobschedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

CREATE TABLE `jobschedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DBName` char(30) NOT NULL,
  `JobName` char(30) NOT NULL,
  `JobTime` timestamp,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO 'jobschedule' ('DBName','JobName') VALUES ('world','job_city');
