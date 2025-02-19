CREATE USER 'laravel_test_user'@'%' IDENTIFIED BY 'secret';
CREATE DATABASE IF NOT EXISTS laravel_test;
GRANT ALL PRIVILEGES ON laravel_test.* TO 'laravel_test_user'@'%';
FLUSH PRIVILEGES;