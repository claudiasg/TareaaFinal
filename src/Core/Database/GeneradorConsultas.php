<?php

namespace Core\Database;

use PDO;
use PDOException;

class GeneradorConsultas
{

    public function __construct(public $pdo) {}

    public function obtenerRegistros($tabla)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$tabla}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // insertar //
    public function insertar(string $tabla, array $parametros)
    {
        $columnas =  implode(', ', array_keys($parametros));
        $valores = ":" . implode(', :', array_keys($parametros));
        $sql = "INSERT INTO {$tabla} ({$columnas}) VALUES ({$valores})";

        try {
            $query = $this->pdo->prepare($sql);
            $query->execute($parametros);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    // actualizar //
    public function actualizar($tabla, $id, $parametros)
    {
        // SQL: UPDATE tareas SET completado=:completado, color=:color WHERE id =:id;
        $columnas =  array_map(fn($columna) => "$columna = :$columna", array_keys($parametros));
        $columnas = implode(', ', $columnas);

        $sql = "UPDATE {$tabla} SET {$columnas} WHERE id = :id";

        try {
            $query = $this->pdo->prepare($sql);
            // dd(array_merge($parametros, ['id' => $id]));
            //dd([...$parametros, 'id' => $id]);
            $query->execute([...$parametros, 'id' => $id]);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    // eliminar //
    public function eliminar($tabla, $id)
    {
        // SQL: DELETE FROM tareas WHERE id = :id;
        $sql = "DELETE FROM {$tabla} WHERE id = :id";

        try {
            $query = $this->pdo->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }

    // buscar //
    public function buscar($tabla, $id)
    {
        // SQL: SELECT * FROM tabla WHERE id = :id;
        $sql = "SELECT * FROM {$tabla} WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function buscarPor($tabla, $parametros)
    {
        // SQL: SELECT * FROM tabla WHERE correo =: correo AND estado =: estado;
        $columnas =  array_map(fn($columna) => "$columna = :$columna", array_keys($parametros));
        $columnas = implode(" AND ", $columnas);

        $sql = "SELECT * FROM {$tabla} WHERE {$columnas}";

        try {
            $query = $this->pdo->prepare($sql);
            $query->execute($parametros);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die($error->getMessage());
        }

    }
}
