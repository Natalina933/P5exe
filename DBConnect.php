<?php

class DBConnect
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=Gest_contact;charset=utf8', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            die();
        }
    }

    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
