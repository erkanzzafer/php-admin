<?php

class AdminClass
{

    protected $pdo = null;
    protected $host = 'localhost';
    protected $dbname = 'project1';
    protected $username = 'root';
    protected $password = '';
    protected $charset = 'utf8';

    public function __construct()
    {
        try {
            $this->pdo = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
            print("db bağlantı sağlandı");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function pdoInsert($sql, $args)
    {
        $statement = $this->pdo->prepare($sql);
        $response = $statement->execute($args);
        if ($response) {
            return '<div class="alert alert-success">işlem başarılı</div>';
        } else {
            return '<div class="alert alert-danger">işlem başarısız</div>';
        }
    }




    public function pdoDelete($sql, $args)
    {
        $statement = $this->pdo->prepare($sql);
        $response = $statement->execute($args);
        if ($response) {
            return '<div class="alert alert-success">Silme işlemi başarılı</div>';
        } else {
            return '<div class="alert alert-danger">Silme işlemi başarısız</div>';
        }
    }

    public function pdoPrepare($sql, $args)
    {
        $statement = $this->pdo->prepare($sql);
        $response = $statement->execute($args);
        if ($response) {
            return '<div class="alert alert-success">Güncelleme işlemi başarılı</div>';
        } else {
            return '<div class="alert alert-danger">Güncelleme işlemi başarısız</div>';
        }
    }




    public function getAbout()
    {

        $sql = $this->pdo->query("SELECT * FROM qp_about ORDER BY id DESC", PDO::FETCH_ASSOC)->fetchAll();
        if ($sql) {
            return $sql;
        } else {
            return false;
        }
    }





    public function getSecurity($data)
    {

        if (is_array($data)) {
            $variable = array_map('htmlspecialchars', $data);
            $response = array_map('stripslashes', $variable);
            return $response;
        } else {
            $variable = htmlspecialchars($data);
            $response = stripslashes($variable);
            return $response;
        }
    }
}
