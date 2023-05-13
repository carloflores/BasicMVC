<?php

abstract class Migration
{
    protected $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/database.php';
        $this->pdo = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['db'] . ';charset=' . $config['charset'],
            $config['user'],
            $config['pass']
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // These methods should be overridden by the child classes
    abstract public function up();
    abstract public function down();

    // This method can be used to execute raw SQL queries
    protected function execute($sql)
    {
        $this->pdo->exec($sql);
    }
}