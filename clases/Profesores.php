<?php
namespace Clases;

use PDO;
use PDOException;

class Profesores extends Conexion {
    private $id;
    private $nom_prof;
    private $sueldo;
    private $fecha_prof;
    private $dep;

    //### CRUD ###
    public function create() {
        $c = "insert into profesores(nom_prof, sueldo, fecha_prof, dep) values (:n, :s, :f, :d)";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_prof,
                ':s' => $this->sueldo,
                ':f' => $this->fecha_prof,
                ':d' => $this->dep
            ]);
        }catch(PDOException $ex) {
            die("Error al añadir el profesor: " .$ex->getMessage());
        }
    }

    public function read() {
        $c = "select * from profesores where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al devolver los datos del profesor: " .$ex->getMessage());
        }
        $file = $stmt->fetch(PDO::FETCH_OBJ);
        return $file;
    }

    public function update() {
        $c = "update profesores set nom_prof=:n, sueldo=:s, fecha_prof=:f, dep=:d where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_prof,
                ':s' => $this->sueldo,
                ':f' => $this->fecha_prof,
                ':d' => $this->fecha_prof,
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al actualizar los datos del profesor: " .$ex->getMessage());
        }
    }

    public function delete() {
        $c = "delete from profesores where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        }catch(PDOException $ex) {
            die("Error al borrar el profesor: " .$ex->getMessage());
        }
    }



    //### Otros Métodos ###
    public function devolverTodo() {
        $c = "select * from profesores order by nom_prof=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nom_prof
            ]);
        }catch(PDOException $ex) {
            die("Error al devolver los datos de los profesores: " .$ex->getMessage());
        }
        return $stmt;
    }

    public function existeProfesor($profesor) {
        $c = "select * from profesores where nom_prof=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $profesor
            ]);
        }catch(PDOException $ex) {
            die("Error al comprobar si existe el profesor: " .$ex->getMessage());
        }
        $file = $stmt->fetch(PDO::FETCH_OBJ);
        return ($file == null) ? false : true;
    }

    



    //### SETTER AND GETTER ###
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
     * Get the value of nom_prof
     */ 
    public function getNom_prof()
    {
        return $this->nom_prof;
    }

    /**
     * Set the value of nom_prof
     *
     * @return  self
     */ 
    public function setNom_prof($nom_prof)
    {
        $this->nom_prof = $nom_prof;

        return $this;
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of fecha_prof
     */ 
    public function getFecha_prof()
    {
        return $this->fecha_prof;
    }

    /**
     * Set the value of fecha_prof
     *
     * @return  self
     */ 
    public function setFecha_prof($fecha_prof)
    {
        $this->fecha_prof = $fecha_prof;

        return $this;
    }

    /**
     * Get the value of dep
     */ 
    public function getDep()
    {
        return $this->dep;
    }

    /**
     * Set the value of dep
     *
     * @return  self
     */ 
    public function setDep($dep)
    {
        $this->dep = $dep;

        return $this;
    }
}