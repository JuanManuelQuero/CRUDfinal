<?php
namespace Clases;
use PDO;
use PDOException;

class Departamentos extends Conexion {
    private $id;
    private $nom_dep;


    //### CRUD ###
    public function create() {
        $c = "insert into departamentos(nom_dep) values (:n)";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_dep
            ]);
        }catch(PDOException $ex) {
            die("Error al crear el departamento: " .$ex->getMessage());
        }
    }

    public function read() {
        $c = "select * from departamentos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al devolver los datos del departamento: " .$ex->getMessage());
        }
        $file = $stmt->fetch(PDO::FETCH_OBJ);
        return $file;
    }

    public function update() {
        $c = "update departamentos set nom_dep=:n where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_dep,
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al actualizar los datos del departamento: " .$ex->getMessage());
        }
    }

    public function delete() {
        $c = "delete from departamentos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al borrar el departamento: " .$ex->getMessage());
        }
    }



    //### Otros Métodos ###

    public function devolverTodo() {
        $c = "select * from departamentos order by nom_dep=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_dep
            ]);
        }catch(PDOException $ex) {
            die("Error al devolver los departamentos: " .$ex->getMessage());
        }
        return $stmt;
    }

    public function existeDepartamento($departamento) {
        $c = "select * from departamentos where nom_dep=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $departamento
            ]);
        }catch(PDOException $ex) {
            die("Error al comprobar si existe el departamento: " .$ex->getMessage());
        }
        $file = $stmt->fetch(PDO::FETCH_OBJ);
        return ($file == null) ? false : true;
    }

    
    //### GETTER AND SETTER ###
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
     * Get the value of nom_dep
     */ 
    public function getNom_dep()
    {
        return $this->nom_dep;
    }

    /**
     * Set the value of nom_dep
     *
     * @return  self
     */ 
    public function setNom_dep($nom_dep)
    {
        $this->nom_dep = $nom_dep;

        return $this;
    }
}