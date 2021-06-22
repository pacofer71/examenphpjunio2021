<?php
    namespace Clases;
    use PDOException;
    use PDO;
    class Placas extends Conexion{
    private $id, $marca, $modelo, $precio, $microId;
    
    public function __construct(){
        parent::__construct();
    }

    // CRUD ---------------------------------------------------------------
    public function create(){
        $c="insert into placas(marca, modelo, precio, microId) values(:ma, :mo, :p, :mi)";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':ma'=>$this->marca,
                ':mo'=>$this->modelo,
                ':p'=>$this->precio,
                ':mi'=>$this->microId
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    public function read(){
        $c="select * from placas where id=:i";
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
        $c="update placas set marca=:ma, modelo=:mo, precio=:np, microId=:mi where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':ma'=>$this->marca,
                ':mo'=>$this->modelo,
                ':np'=>$this->precio,
                ':mi'=>$this->microId,
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    public function delete(){
        $c="delete from placas where id=:i";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
    }
    // Otros Métodos -----------------------------------------------------------------------------------
    public static function getTodos(){
        $c="select * from placas order by marca, modelo";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
        return $stmt;
    }
    public function getPlacasMicro($mi){
        $c="select * from placas where microId=:i order by marca, modelo";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute([
                ':i'=>$mi
            ]);
        }catch(PDOException $ex){
            die(">Error: {$ex->getMessage()}");
        }
        return $stmt;
    }
    // Setters ------------------------------------------------------------------------------------------

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
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Set the value of microId
     *
     * @return  self
     */ 
    public function setMicroId($microId)
    {
        $this->microId = $microId;

        return $this;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }
}