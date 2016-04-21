# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V9.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          carasa.dez                                      #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2016-03-22 17:28                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Add tables                                                             #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "Hospital"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `Hospital` (
    `hospital_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `alamat` TEXT NOT NULL,
    `telepon` VARCHAR(15) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    CONSTRAINT `PK_Hospital` PRIMARY KEY (`hospital_id`)
);

# ---------------------------------------------------------------------- #
# Add table "Kategori"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `Kategori` (
    `id_kategori` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    CONSTRAINT `PK_Kategori` PRIMARY KEY (`id_kategori`)
);

# ---------------------------------------------------------------------- #
# Add table "Person"                                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `Person` (
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `nama` VARCHAR(255) NOT NULL,
    `alamat` TEXT NOT NULL,
    `hp` VARCHAR(12) NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `hospital_id` INTEGER(11),
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `remember_token` varchar(100),
    primary key (`id`)
);

# ---------------------------------------------------------------------- #
# Add table "Product"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `Product` (
    `product_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `harga` INTEGER(11) NOT NULL,
    `foto` BLOB NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `id_kategori` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_Product` PRIMARY KEY (`product_id`)
);

# ---------------------------------------------------------------------- #
# Add table "Order"                                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `Orderan` (
    `order_id` INTEGER(11) NOT NULL,
    `jumlah` INTEGER(11) NOT NULL,
    `catatan` TEXT,
    `waktu_kirim` DATETIME NOT NULL,
    `status` Varchar(100) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `product_id` INTEGER(11),
    primary key (`order_id`,`username`)
);

# ---------------------------------------------------------------------- #
# Add foreign key constraints                                            #
# ---------------------------------------------------------------------- #

ALTER TABLE `Person` ADD CONSTRAINT `Hospital_Person` 
    FOREIGN KEY (`hospital_id`) REFERENCES `Hospital` (`hospital_id`);

ALTER TABLE `Product` ADD CONSTRAINT `Kategori_Product` 
    FOREIGN KEY (`id_kategori`) REFERENCES `Kategori` (`id_kategori`);

ALTER TABLE `Orderan` ADD CONSTRAINT `Person_Order` 
    FOREIGN KEY (`username`) REFERENCES `Person` (`username`);

ALTER TABLE `Orderan` ADD CONSTRAINT `Product_Order` 
    FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`);
