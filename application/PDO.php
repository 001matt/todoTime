<?php

namespace Application;

class PDO{
    
   private static $instance = null;
   private $pdo = null;
   const DNS = 'mysql:dbname=projet;host=127.0.0.1';
   const HOST = 'root';
   const PASS = '';

   private function __clone() {
    }

    public function getPdo(){
        return $this->pdo;
    }
    
    public static function getInstance(){
        if(null === self::$instance){
             self::$instance = new self(self::DNS,  self::HOST,  self::PASS);
         }
         return self::$instance;
   }

    public function __construct() {
        if(null === self::$instance){
            $this->pdo = new \PDO(self::DNS,  self::HOST,  self::PASS);
        }
   }
}