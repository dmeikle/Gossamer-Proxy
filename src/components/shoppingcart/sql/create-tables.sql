
create table Categories (
    id int not null auto_increment,   
    thumbnail varchar(100) not null,    
    parentId int not null,
    priority int not null default 0,
    lastModified timestamp default now() on update now(),
primary key (id)
) ;

create table CategoriesI18n (
    Categories_id int not null,
    locale char(5) not null,
    category varchar(30) not null,
    description varchar(255) not null,
    primary key (Categories_id, locale)
);

create table Locales (
    id int not null auto_increment,
    locale char(5),
    languageName varchar(30),
    isDefault boolean,
    lastModified timestamp default now() on update now(),
    primary key (id)
);

 insert into Locales values
    (null, 'en_US', 'US English', true, null),
    (null, 'fr_CA', 'CA French', false, null);

CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_rating` float DEFAULT NULL,
  `isOnSale` int(11) DEFAULT NULL,
  `picture` varchar(150) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `big_picture` varchar(30) DEFAULT NULL,
  `in_stock` int(11) DEFAULT NULL,
  `customer_votes` int(11) DEFAULT NULL,
  `items_sold` int(11) DEFAULT NULL,
  `brief_description` text,
  `product_code` char(25) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `dateIn` date DEFAULT NULL,
  `hasCustomText` tinyint(1) DEFAULT NULL,
  `shippingOffset` float DEFAULT NULL,
  `shipsSeparately` bit(1) DEFAULT NULL COMMENT 'this is to tell the shipping calculator this ships as a separate package',
  `minOrderQuantity` int(11) DEFAULT NULL,
  `numPerBox` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  `isFeatured` tinyint(1) DEFAULT NULL,
  `isDownloadable` tinyint(1) DEFAULT NULL,
  `filename` varchar(30) DEFAULT NULL,
  `notDiscountable` tinyint(1) DEFAULT NULL,
  deliveryTime int,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` int(11) DEFAULT NULL,
  `discontinued` int(11) DEFAULT NULL,
    priceUSD float,
priceCAD float,
salePriceUSD float,
salePriceCAD float,
listPriceUSD float,
listPriceCAD float,
  PRIMARY KEY (`id`)
);

CREATE TABLE `ProductsI18n` (
  `Products_id` int(11) NOT NULL,
  `locale` char(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `briefDescription` varchar(200) not null,
  primary key (Products_id, locale)
)

create table ProductsCategories (
    Products_id int not null,
    Categories_id int not null
);

CREATE TABLE `Clients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` VARCHAR(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` VARCHAR(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` VARCHAR(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` CHAR(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` VARCHAR(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipFirstname` VARCHAR(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipLastname` VARCHAR(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipEmail` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipCompany` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipTelephone` VARCHAR(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipAddress1` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipAddress2` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipCity` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipState` CHAR(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipZip` VARCHAR(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipCountry` CHAR(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  lastModified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `Purchases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  orderDate DATETIME NOT NULL ,
  `PurchaseTypes_id` INT(11) NOT NULL,
  `PaymentTypes_id` INT(11) NOT NULL,
  `status` INT(11) NOT NULL,
  `Clients_id` FLOAT NOT NULL,
  `lastModified` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
