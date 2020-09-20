CREATE TABLE `academicTable` (
    `ID` varchar(9) NOT NULL,
    `Faculty` varchar(254) NULL DEFAULT NULL,
    `Course` varchar(254) NULL DEFAULT NULL,
    `EntryYear` int(4) UNSIGNED ZEROFILL NULL DEFAULT NULL,
    `Duration` varchar(9) NULL DEFAULT NULL,
    `Mode` varchar(13) NULL DEFAULT NULL,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `academictable`
  ADD UNIQUE KEY `UA_ID` (`ID`);