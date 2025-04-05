DROP TABLE IF EXISTS checkoutTransactionItem;
DROP TABLE IF EXISTS checkoutTransaction;
DROP TABLE IF EXISTS Patron;
DROP TABLE IF EXISTS ItemAuthor;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Author;

CREATE TABLE Patron (
	patronID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	patronLastName VARCHAR(45) NOT NULL,
	patronFirstName VARCHAR(45) NOT NULL,
	patronAddress VARCHAR(90) NOT NULL,
	patronDateOfBirth DATE NOT NULL,
	patronLastRenewed DATE NOT NULL DEFAULT (CURRENT_DATE),
	patronContactPhone CHAR(10) NOT NULL,
	paymentBalance DECIMAL(13,2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (patronID)
);

CREATE TABLE Item (
	itemISBN VARCHAR(17) NOT NULL,
	itemID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	itemTitle VARCHAR(90) NOT NULL,
	itemType VARCHAR(15) NOT NULL,
	itemYearPublished YEAR NOT NULL,
	itemPublisher VARCHAR(45) NOT NULL,
	itemLoC VARCHAR(16) NOT NULL,
	itemCost DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	itemAquisitionDate DATE NOT NULL DEFAULT (CURRENT_DATE),
	itemCopy INT NOT NULL,
	itemBranch VARCHAR(16) NOT NULL,
	itemStatus VARCHAR(16) NOT NULL,
	itemSecurityDeviceFlag VARCHAR(16),
	itemDamage VARCHAR(16) NOT NULL,
	PRIMARY KEY (itemID),
	CONSTRAINT chkItemType CHECK (itemType IN ('books', 'periodicals', 'recordings', 'videos'))
	CONSTRAINT chkItemStatus CHECK (ItemStatus IN ('Available', 'Not Available', 'Checked In', 'Checked Out'))
);

ALTER TABLE Item
AUTO_INCREMENT = 3000;

DELIMITER //
CREATE TRIGGER UpdateCopyOnInsert
BEFORE INSERT ON Item
FOR EACH ROW
BEGIN
	SET NEW.itemCopy = (
		SELECT COALESCE(MAX(itemCopy), 0) + 1
		FROM Item
		WHERE itemISBN = NEW.itemISBN
	);
END;
//
DELIMITER;;

CREATE TABLE Author (
	authorID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	authorLastName VARCHAR(45) NOT NULL,
	authorFirstName VARCHAR(45) NOT NULL,
	PRIMARY KEY (authorID)
);

ALTER TABLE Author
AUTO_INCREMENT = 2000;

CREATE TABLE ItemAuthor (
	itemID SMALLINT UNSIGNED NOT NULL,
	authorID SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY (itemID, authorID),
	CONSTRAINT fk_ItemAuthor_Item FOREIGN KEY (itemID) REFERENCES Item (itemID)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	CONSTRAINT fk_ItemAuthor_Author FOREIGN KEY (authorID) REFERENCES Author (authorID)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
);

CREATE TABLE checkoutTransaction (
	transactionID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	patronID SMALLINT UNSIGNED NOT NULL,
	transactionDate DATE NOT NULL DEFAULT (CURRENT_DATE),
	paymentAmount DECIMAL(7,2) DEFAULT 0.00,
	PRIMARY KEY (transactionID),
	CONSTRAINT fk_checkoutTransaction_Patron FOREIGN KEY (patronID) REFERENCES Patron (patronID)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
);

CREATE TABLE checkoutTransactionItem (
	transactionID SMALLINT UNSIGNED NOT NULL,
	itemID SMALLINT UNSIGNED NOT NULL,
	dueDate DATE NOT NULL DEFAULT (DATE_ADD(CURRENT_DATE, INTERVAL 2 WEEK)),
	returnDATE DATE NOT NULL DEFAULT (CURRENT_DATE),
	transactionItemStatus VARCHAR(16) NOT NULL,
	PRIMARY KEY (transactionID, itemID),
	CONSTRAINT chkTransactionItemStatus CHECK (transactionItemStatus IN ('Available', 'Not Available', 'Checked In', 'Checked Out'))
	CONSTRAINT fk_checkoutTransactionItem_checkoutTransaction FOREIGN KEY (transactionID) REFERENCES checkoutTransaction (transactionID)
		ON DELETE RESTRICT
		ON UPDATE CASCADE,
	CONSTRAINT fk_checkoutTransactionItem_Item FOREIGN KEY (itemID) REFERENCES Item (itemID)
		ON DELETE RESTRICT
		ON UPDATE CASCADE
);


