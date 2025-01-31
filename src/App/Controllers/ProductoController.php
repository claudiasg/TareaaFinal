<?php

namespace App\Controllers;

use App\Models\Producto;

class ProductoController
{
    public function crear()
    {
        Producto::insert(
            [
                'descripcion' => $_POST['descripcion'],
                'precio' => $_POST['precio'],
            ]
        );

        return redirect('/');
    }

    public function actualizar($id)
    {
        $producto = Producto::find($id);
        $producto->update(
            [
                'disponible' => $_POST['disponible'],
                'id' => $id
            ]
        );

        return redirect('/');
    }

    public function eliminar($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return redirect('/');
    }
}
