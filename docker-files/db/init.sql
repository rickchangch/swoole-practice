CREATE DATABASE IF NOT EXISTS `test_db`;
UPDATE mysql.user SET host = '%' WHERE user = 'root';
GRANT ALL ON main_db.* TO 'user'@'%';
GRANT ALL ON test_db.* TO 'user'@'%';
FLUSH PRIVILEGES;
