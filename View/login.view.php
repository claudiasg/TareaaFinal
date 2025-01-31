<?php require 'parciales/header.view.php'; ?>
<h1>Iniciar Sesión</h1>
<form action="/login" method="post">
    <div>
        <input style="margin-top: 10px;" type="email" name="correo" id="correo" placeholder="Usuario" required />
    </div>

    <div>
        <input style="margin-top: 10px;" type="password" name="password" id="password" placeholder="Password" required />
    </div>

    <div>
        <button style="margin-top: 10px;" type="submit">Iniciar Sesión</button>
    </div>
</form>
<?php require 'parciales/footer.view.php'; ?>