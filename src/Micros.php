<?php
    namespace Clases;
    use PDOException;
    use PDO;
    class Micros extends Conexion{
    private $id, $marca, $modelo, $numprocesadores;
    
    public function __construct(){
        parent::__construct();
    }

    // CRUD ---------------------------------------------------------------
    public function create(){
        $c="insert into micros(marca, modelo, numprocesadores) values(:ma, :mo, :np)";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':ma'=>$this->marca,
                ':mo'=>$this->modelo,
                ':np'=>$this->numprocesadores
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    public function read(){
        $c="select * from micros where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function update(){
        $c="update micros set marca=:ma, modelo=:mo, numprocesadores=:np where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':ma'=>$this->marca,
                ':mo'=>$this->modelo,
                ':np'=>$this->numprocesadores,
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    public function delete(){
        $c="delete from micros where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    
    // FIN CRUD -----------------------------------------------------------
    // Otros métodos
    public static function getTodos(){
        $c="select * from micros order by marca, modelo";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
        return $stmt;
    }
    public function readC(){
        $c="select distinct micros.*, placas.modelo as pmodelo, placas.marca as pmarca from micros, placas where placas.id=:i and microId=micros.id";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
        return $stmt;
    }

    
    //----------------------------------------------

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of marca
     */ 
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */ 
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of modelos
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelos
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of numprocesadores
     */ 
    public function getNumprocesadores()
    {
        return $this->numprocesadores;
    }

    /**
     * Set the value of numprocesadores
     *
     * @return  self
     */ 
    public function setNumprocesadores($numprocesadores)
    {
        $this->numprocesadores = $numprocesadores;

        return $this;
    }
}