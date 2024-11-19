<?php
class config {
    const DBHOST = 'db';
    const DBUSER = 'test';
    const DBNAME = 'demo';
    const DBPASS = 'pass';

    public static function getConnexion() {
        $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME;
        try {
            $db = new PDO($dsn, self::DBUSER, self::DBPASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo 'Une erreur est survenue: ' . $e->getMessage();
            die;
        }
    }
}
?>
