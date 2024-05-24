CREATE DATABASE barangay

USE barangay;

CREATE TABLE userr(id INT(255) AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL, passwordd VARCHAR(255) NOT NULL, UNIQUE(email));

ALTER TABLE userr AUTO_INCREMENT = 1000;

INSERT INTO userr VALUES(NULL, "marcakes25@gmail.com", "12345678");

SELECT * FROM userr

CREATE TABLE infos(id INT(255) AUTO_INCREMENT PRIMARY KEY, user_id INT(255), full_name VARCHAR(255), bert DATE, 
age INT(255), sex VARCHAR(255), civil VARCHAR(255), email VARCHAR(255), 
contact VARCHAR(255), address VARCHAR(255), FOREIGN KEY(user_id) REFERENCES userr(id));

INSERT INTO infos VALUES(NULL, 1000, "Markniel Dangca", "2006-06-30", 17, "Male", "Married", "marcakes24@gmail.com",
"09939638279", "152 Ginintuang Landas, Sta. Monica, Novaliches, Quezon City");

SELECT * FROM infos;

UPDATE infos 

ALTER TABLE infos DROP COLUMN image;

ALTER TABLE infos ADD COLUMN image VARCHAR(255);

DROP TABLE pdf_table

CREATE TABLE pdf_table (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(255),
    namee VARCHAR(255),
    typee VARCHAR(255),
    reqTime DATE,
    statuss VARCHAR(255),
    pdf_content LONGBLOB
);

ALTER TABLE pdf_table MODIFY COLUMN pdf_content LONGBLOB;

SELECT * FROM pdf_table

USE barangay

CREATE TABLE adminn(id INT(255) AUTO_INCREMENT PRIMARY KEY, id_num VARCHAR(255), passwordd VARCHAR(255))

INSERT INTO adminn VALUES(NULL, "01090208", "admin123");

SELECT * FROM adminn

CREATE TABLE images(id INT(255) AUTO_INCREMENT PRIMARY KEY, 
admin_id INT(255), 
image_name VARCHAR(255) NOT NULL, 
image_path LONGBLOB);

DROP TABLE images

SELECT * FROM images

CREATE TABLE rquirements(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
request_id INT(255),
name_of_req VARCHAR(255),
requirements LONGBLOB);

DROP TABLE rquirements

SELECT * FROM rquirements

CREATE TABLE notification(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
notif VARCHAR(255));

DROP TABLE notification

SELECT * FROM notification;

CREATE TABLE schedulee(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
sched VARCHAR(255));

DROP TABLE schedulee;

CREATE TABLE in_proc(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
namee VARCHAR(255),
typee VARCHAR(255),
reqTime DATE,
statuss VARCHAR(255));

INSERT INTO in_proc VALUES(NULL, 1000, 2, 'Markniel', 'Indigency', '2024-04-16', 'In_Processing')

DROP TABLE in_proc;

SELECT * FROM in_proc;

CREATE TABLE completed(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
namee VARCHAR(255),
typee VARCHAR(255),
reqTime DATE,
statuss VARCHAR(255),
schedulee DATE,
transactionNum INT(255));

DROP TABLE completed

SELECT * FROM completed

CREATE TABLE kk(try TIMESTAMP, tr VARCHAR(255))

DROP TABLE kk

INSERT INTO kk VALUES(NOW(),'sad');

SELECT* FROM kk

CREATE TABLE verify(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
verif VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)

SELECT DATE_ADD(created_at, INTERVAL 5 MINUTE) AS expiry_time FROM verify;

SELECT * FROM verify

DROP TABLE verify

DELETE FROM verify WHERE created_at < NOW() - INTERVAL 5 MINUTE

CREATE TABLE audit(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
namee VARCHAR(255),
actionn VARCHAR(255))

SELECT * FROM audit

DROP TABLE audit

DELETE FROM notification WHERE id = 7

SELECT * FROM notification

CREATE TABLE admin_notif(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
notif VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE numm(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
opened VARCHAR(255))

SELECT * FROM numm

CREATE TABLE deleted_user(id INT(255) PRIMARY KEY, email VARCHAR(255) NOT NULL, passwordd VARCHAR(255) NOT NULL, UNIQUE(email));

CREATE TABLE deleted_infos(id INT(255) AUTO_INCREMENT PRIMARY KEY, user_id INT(255), full_name VARCHAR(255), bert DATE, 
age INT(255), sex VARCHAR(255), civil VARCHAR(255), email VARCHAR(255), 
contact VARCHAR(255), address VARCHAR(255));	

DROP TABLE deleted_user

SELECT * FROM deleted_infos

ALTER TABLE deleted_infos ADD COLUMN image VARCHAR(255);

CREATE TABLE admin_numm(id INT(255) AUTO_INCREMENT PRIMARY KEY,
opened VARCHAR(255))

CREATE TABLE residents(id INT(255) AUTO_INCREMENT PRIMARY KEY,
namee VARCHAR(255))

INSERT INTO residents VALUES(NULL, 'Allyssa F. Ombao');

SELECT * FROM residents

CREATE TABLE schedule_user(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
sched VARCHAR(255))

DROP TABLE schedule_user

DELETE FROM schedule_user

CREATE TABLE schedule_user1(id INT(255) AUTO_INCREMENT PRIMARY KEY,
user_id INT(255),
req_id INT(255),
sched VARCHAR(255))

SELECT *
FROM schedule_user

SELECT * FROM pdf_table RIGHT JOIN schedule_user 
ON pdf_table.id = schedule_user.req_id AND pdf_table.user_id = schedule_user.user_id;

CREATE TABLE loginCount(id INT(255) AUTO_INCREMENT PRIMARY KEY,
logCount INT(255),
created_at DATE);

DROP TABLE loginCount

INSERT INTO loginCount VALUES(NULL, 0, CURDATE());

SELECT * FROM loginCount

CREATE TABLE requestCount(id INT(255) AUTO_INCREMENT PRIMARY KEY,
reqCount INT(255),
created_at DATE);

INSERT INTO requestCount VALUES(NULL, 0, CURDATE());

SELECT * FROM requestCount

CREATE TABLE completedCount(id INT(255) AUTO_INCREMENT PRIMARY KEY,
comCount INT(255),
created_at DATE);

INSERT INTO completedCount VALUES(NULL, 0, CURDATE());

SELECT * FROM completedCount

SELECT * FROM loginCount 
INNER JOIN requestCount ON loginCount.created_at = requestCount.created_at
INNER JOIN completedCount ON requestCount.created_at = completedCount.created_at 
ORDER BY completedCount.created_at DESC, requestCount.created_at DESC, loginCount.created_at DESC
