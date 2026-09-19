<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Registro - Portale</title></head><body>
<h1>Crear cuenta</h1>
<?php if ($errors = session()->getFlashdata('errors')): ?><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul><?php endif; ?>
<form method="post" action="/register">
<?= csrf_field() ?>
<input name="nombre" placeholder="Nombre" required><br>
<input name="apellido" placeholder="Apellido" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Contraseña" required><br>
<select name="rol" required><option value="Consumidor">Consumidor</option><option value="Artista">Artista</option></select><br>
<button type="submit">Registrarme</button>
</form><a href="/login">Volver al login</a>
</body></html>
