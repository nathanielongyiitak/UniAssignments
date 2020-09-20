CREATE TABLE `contactTable` (
    `ID` varchar(9) NOT NULL,
    `Address` varchar(254) NULL DEFAULT NULL,
    `Postcode` int(5) UNSIGNED ZEROFILL NULL DEFAULT NULL,
    `City` varchar(20) NULL DEFAULT NULL,
    `State` varchar(30) NULL DEFAULT NULL,
    `Phone` int(11) UNSIGNED ZEROFILL NULL DEFAULT NULL,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `contacttable`
  ADD UNIQUE KEY `UCON_ID` (`ID`);