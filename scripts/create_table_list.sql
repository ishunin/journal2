CREATE TABLE IF NOT EXISTS `list` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_shift` int(11),
  `Jira_num` text NOT NULL,
  `Content` text NOT NULL,
  `Action` text NOT NULL,
  `Author` text NOT NULL,
  `Destination` text NOT NULL,
  `Edit_date` int(11) NOT NULL,
  `Create_date` int(11) NOT NULL,

  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;