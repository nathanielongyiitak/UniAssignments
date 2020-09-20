CREATE TABLE `personalTable` (
  `ID` varchar(9) NOT NULL,
  `ProfilePicture` longblob NULL,
  `NewMatrics` varchar(10) NULL DEFAULT NULL,
  `IC` varchar(20) NULL DEFAULT NULL,
  `Nationality` varchar(13) NULL DEFAULT NULL,
  `Gender` varchar(6) NULL DEFAULT NULL,
  `Birthday` varchar(254) NULL DEFAULT NULL,
  `Race` varchar(10) NULL DEFAULT NULL,
  `Religion` varchar(12) NULL DEFAULT NULL,
  `Marital` varchar(10) NULL DEFAULT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `personaltable`
  ADD UNIQUE KEY `UP_ID` (`ID`);