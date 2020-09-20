CREATE TABLE `activityTable` (
  `ID` varchar(9) NOT NULL,
  `Year` int NOT NULL,
  `Semester` int NOT NULL,
  `Activity 1` varchar(254) DEFAULT '-',
  `Activity 2` varchar(254) DEFAULT '-',
  `Activity 3` varchar(254) DEFAULT '-',
  CONSTRAINT PK_activitytable PRIMARY KEY (ID, Year, Semester)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `activitytable`
  ADD UNIQUE KEY `UP_ID` (`ID`,`Year`,`Semester`);
