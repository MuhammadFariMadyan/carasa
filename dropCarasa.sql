# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases V9.1.2                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          carasa.dez                                      #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2016-04-26 16:25                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `Person` DROP FOREIGN KEY `Hospital_Person`;

ALTER TABLE `Product` DROP FOREIGN KEY `Kategori_Product`;

ALTER TABLE `Order` DROP FOREIGN KEY `Person_Order`;

ALTER TABLE `Cart` DROP FOREIGN KEY `Product_Cart`;

ALTER TABLE `Cart` DROP FOREIGN KEY `Order_Cart`;

# ---------------------------------------------------------------------- #
# Drop table "Cart"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `Cart` MODIFY `cart_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `Cart` DROP PRIMARY KEY;

DROP TABLE `Cart`;

# ---------------------------------------------------------------------- #
# Drop table "Order"                                                     #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `Order` DROP PRIMARY KEY;

DROP TABLE `Order`;

# ---------------------------------------------------------------------- #
# Drop table "Product"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `Product` MODIFY `product_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `Product` DROP PRIMARY KEY;

DROP TABLE `Product`;

# ---------------------------------------------------------------------- #
# Drop table "Person"                                                    #
# ---------------------------------------------------------------------- #

# Drop constraints #

ALTER TABLE `Person` DROP PRIMARY KEY;

DROP TABLE `Person`;

# ---------------------------------------------------------------------- #
# Drop table "Kategori"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `Kategori` MODIFY `id_kategori` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `Kategori` DROP PRIMARY KEY;

DROP TABLE `Kategori`;

# ---------------------------------------------------------------------- #
# Drop table "Hospital"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `Hospital` MODIFY `hospital_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `Hospital` DROP PRIMARY KEY;

DROP TABLE `Hospital`;
