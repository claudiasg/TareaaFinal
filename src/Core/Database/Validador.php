<?php

namespace Core\Database;

class Validador
{
    private $reglas = [];
    private $errores = [];
    private $mensajes = [];

    public function setReglas(array $reglas, array $mensajes)
    {
        $this->reglas = $reglas;
        $this->mensajes = $mensajes;
        return $this;
    }

    public function validar(array $datos)
    {
        $this->errores = [];
        foreach ($this->reglas as $campo => $columnaReglas) {
            $valor = $datos[$campo] ?? null;
            $reglas = explode('|', $columnaReglas);
            foreach ($reglas as $regla) {
                if ($this->aplicarRegla($regla, $valor, $campo) == false) {
                    break;
                }
            }
        }

        return empty($this->errores);
    }

    private function aplicarRegla($reglas, $valor, $campo)
    {
        [$nombreRegla, $parametro] =  array_pad(explode(':', $reglas), 2, null); // min:6|color_hexadecimal, null

        switch ($nombreRegla) {
            case 'required':
                if (empty($valor) && $valor !== '0') {
                    $this->agregarError($campo, $nombreRegla, "El campo $campo es requerido");
                    return false;
                }
                break;
            case 'min':
                if (strlen((string)$valor) < (int)$parametro) {
                    $this->agregarError($campo, $nombreRegla, "El campo $campo debe tener al menos $parametro caracteres");
                    return false;
                }
                break;
            case 'max':
                if (strlen((string)$valor) > (int)$parametro) {
                    $this->agregarError($campo, $nombreRegla, "El campo $campo debe tener como máximo $parametro caracteres");
                    return false;
                }
                break;
            case 'email':
                if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
                    $this->agregarError($campo, $nombreRegla, "El campo $campo debe ser un email válido");
                    return false;
                }
                break;

            case 'color_hexadecimal':
                if (preg_match('/^#[a-f0-9]{6}$/i', $valor) == 0) { // #FFFFFF -> #FFF
                    $this->agregarError($campo, $nombreRegla, "El campo $campo debe ser un color hexadecimal");
                    return false;
                }
                break;

            default:
                $this->agregarError($campo, $nombreRegla, "La regla $nombreRegla no está definida");
                break;
        }

        return true;
    }

    private function agregarError($campo, $regla, $mensaje)
    {
        $this->errores[$campo] = $this->mensajes[$campo][$regla] ?? $mensaje;
    }

    public function getErrores()
    {
        return $this->errores;
    }
}
