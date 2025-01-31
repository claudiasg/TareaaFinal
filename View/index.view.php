<?php require 'parciales/header.view.php'; ?>
<h1>productos</h1>
<h2>Disponibles</h2>
<ul>
    <?php foreach ($productosDisponibles as $producto): ?>
        <li style="precio: <?= $producto->precio ?>;"><?= $producto->descripcion ?>
            <form style="display: inline;" action="productos/actualizar/<?= $producto->id ?>" method="post">
                <input type="hidden" name="completado" value="0">
                <button type="submit">🔄</button>
            </form>
            <form onsubmit="return confirm('¿Está seguro de eliminar la producto?'); " style="display: inline;" action="productos/eliminar/<?= $producto->id ?>" method="post">
                <button type="submit">❌</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<h2>Faltantes</h2>
<ul>
    <?php foreach ($productosFaltantes as $producto): ?>
        <li style="precio: <?= $producto->precio ?>;"><?= $producto->descripcion ?>
            <form style="display: inline;" action="productos/actualizar/<?= $producto->id ?>" method="post">
                <input type="hidden" name="completado" value="1">
                <button type="submit">✅</button>
            </form>
            <form onsubmit="return confirm('¿Está seguro de eliminar la producto?'); " style="display: inline;" action="productos/eliminar/<?= $producto->id ?>" method="post">
                <button type="submit">❌</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<hr>
<h4>Formulario de Registro</h4>

<?php if (isset($_SESSION['errores'])): ?>
    <ul>
        <?php foreach ($_SESSION['errores'] as $error): ?>
            <li style="precio:red;"><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php unset($_SESSION['errores']); ?>

<form action="productos/crear" method="POST">
    <input type="text" name="descripcion" placeholder="Descripción de la producto">
    <input type="precio" name="precio">
    <button type="submit">Crear producto</button>
</form>
<?php require 'parciales/footer.view.php'; ?>