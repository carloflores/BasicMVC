<?php

require_once __DIR__ . '/../../core/Migration.php';

class CreateUsersMigration extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE users";
        $this->execute($sql);
    }
}