

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


USE sample;
CREATE TABLE `customer` (
  `customer_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `customer_street` varchar(20) CHARACTER SET utf8 NOT NULL,
  `customer_city` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `customer` (`customer_name`, `customer_street`, `customer_city`) VALUES
('Abigail', 'Leatherwood', 'Reno'),
('Ada', 'Gates', 'Ravenna'),
('Adela', 'West Lake', 'Davison'),
('Adelaide', 'NW. 4th', 'Pataskala'),
('Afra', 'Cobblestone Lane', 'Kalamazoo');



CREATE TABLE `depositor` (
  `customer_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `account_number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `depositor` (`customer_name`, `account_number`) VALUES
('Abigail', 10000),
('Ada', 50000),
('Adela', 25000),
('Adelaide', 28000),
('Afra', 35000);


CREATE TABLE `depstore` (
  `AreaCode` bigint(15) NOT NULL COMMENT '店家區域碼',
  `Description` varchar(255) NOT NULL COMMENT '店家簡單描述',
  `BusinessHour` varchar(255) NOT NULL COMMENT '店家營業時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `depstore` (`AreaCode`, `Description`, `BusinessHour`) VALUES
(201609260001, '精品店', '早上9點~晚上8點');


CREATE TABLE `menu` (
  `keynumber` int(11) NOT NULL COMMENT '選單key',
  `linkname` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '選單名稱',
  `linkvalue` varchar(255) CHARACTER SET utf8 DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `menu` (`keynumber`, `linkname`, `linkvalue`) VALUES
(1, '選單維護', 'content/menu.php'),
(11, '測試選單', 'http://www.cs.ntou.edu.tw/');



CREATE TABLE `persons` (
  `P_Id` int(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



INSERT INTO `persons` (`P_Id`, `LastName`, `FirstName`, `Address`, `City`) VALUES
(1, 'Tom', 'Lee', 'Road', 'Taipei');



CREATE TABLE `toy` (
  `ToyID` bigint(15) NOT NULL COMMENT '玩具ID',
  `AreaCode` bigint(15) NOT NULL COMMENT '玩具的區域碼',
  `Name` varchar(255) NOT NULL COMMENT '玩具名字',
  `Price` varchar(255) NOT NULL COMMENT '玩具價錢',
  `Description` varchar(255) NOT NULL COMMENT '玩具描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `toy` (`ToyID`, `AreaCode`, `Name`, `Price`, `Description`) VALUES
(1, 201609260001, '水槍', '120', '可以跟小孩一起在溪邊玩耍。');



CREATE TABLE `toysupplier` (
  `ToyID` bigint(15) NOT NULL COMMENT '玩具ID',
  `Name` varchar(255) NOT NULL COMMENT '廠商名字',
  `Address` varchar(255) NOT NULL COMMENT '廠商地址',
  `Phone` varchar(255) NOT NULL COMMENT '廠商電話'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `toysupplier` (`ToyID`, `Name`, `Address`, `Phone`) VALUES
(1, '什麼公司', '什麼地址', '什麼電話');


ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_name`);


ALTER TABLE `depositor`
  ADD PRIMARY KEY (`customer_name`,`account_number`);


ALTER TABLE `depstore`
  ADD PRIMARY KEY (`AreaCode`);


ALTER TABLE `menu`
  ADD PRIMARY KEY (`keynumber`);


ALTER TABLE `toy`
  ADD PRIMARY KEY (`ToyID`),
  ADD UNIQUE KEY `ToyID_2` (`ToyID`);


ALTER TABLE `toysupplier`
  ADD PRIMARY KEY (`ToyID`),
  ADD UNIQUE KEY `ToyID` (`ToyID`);


ALTER TABLE `depstore`
  MODIFY `AreaCode` bigint(15) NOT NULL AUTO_INCREMENT COMMENT '店家區域碼', AUTO_INCREMENT=2147483647;

ALTER TABLE `menu`
  MODIFY `keynumber` int(11) NOT NULL AUTO_INCREMENT COMMENT '選單key', AUTO_INCREMENT=17;

ALTER TABLE `toy`
  MODIFY `ToyID` bigint(15) NOT NULL AUTO_INCREMENT COMMENT '玩具ID', AUTO_INCREMENT=2;

ALTER TABLE `depositor`
  ADD CONSTRAINT `destrict` FOREIGN KEY (`customer_name`) REFERENCES `customer` (`customer_name`);


ALTER TABLE `toysupplier`
  ADD CONSTRAINT `ToyID_Restrict` FOREIGN KEY (`ToyID`) REFERENCES `toy` (`ToyID`) ON DELETE CASCADE ON UPDATE CASCADE;
