# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V9.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          carasa.dez                                      #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2016-04-26 16:25                                #
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
    CONSTRAINT `PK_Person` PRIMARY KEY (`username`)
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

CREATE TABLE `Order` (
    `order_id` INTEGER(11) NOT NULL,
    `status` ENUM() NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `username` VARCHAR(255),
    CONSTRAINT `PK_Order` PRIMARY KEY (`order_id`)
);

# ---------------------------------------------------------------------- #
# Add table "Cart"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `Cart` (
    `cart_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `jumlah` INTEGER(11) NOT NULL,
    `catatan` TEXT,
    `waktu_kirim` ENUM() NOT NULL,
    `product_id` INTEGER(11) NOT NULL,
    `order_id` INTEGER(11),
    CONSTRAINT `PK_Cart` PRIMARY KEY (`cart_id`)
);

# ---------------------------------------------------------------------- #
# Add foreign key constraints                                            #
# ---------------------------------------------------------------------- #

ALTER TABLE `Person` ADD CONSTRAINT `Hospital_Person` 
    FOREIGN KEY (`hospital_id`) REFERENCES `Hospital` (`hospital_id`);

ALTER TABLE `Product` ADD CONSTRAINT `Kategori_Product` 
    FOREIGN KEY (`id_kategori`) REFERENCES `Kategori` (`id_kategori`);

ALTER TABLE `Order` ADD CONSTRAINT `Person_Order` 
    FOREIGN KEY (`username`) REFERENCES `Person` (`username`);

ALTER TABLE `Cart` ADD CONSTRAINT `Product_Cart` 
    FOREIGN KEY (`product_id`) REFERENCES `Product` (`product_id`);

ALTER TABLE `Cart` ADD CONSTRAINT `Order_Cart` 
    FOREIGN KEY (`order_id`) REFERENCES `Order` (`order_id`);
