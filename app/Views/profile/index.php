<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Mi perfil</title></head><body>
<h1>Mi perfil</h1>
<?php if ($msg = session()->getFlashdata('success')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<p>Rol: <?= esc(session()->get('rol')) ?></p>
<form method="post" action="/perfil">
<?= csrf_field() ?>
<input name="nombre" value="<?= esc($user['nombre']) ?>" placeholder="Nombre" required><br>
<input name="apellido" value="<?= esc($user['apellido']) ?>" placeholder="Apellido" required><br>
<input value="<?= esc($user['email']) ?>" disabled><br>
<?php if ($artist): ?>
<input name="nombre_artistico" value="<?= esc($artist['nombre_artistico']) ?>" placeholder="Nombre artístico"><br>
<textarea name="biografia" placeholder="Biografía"><?= esc($artist['biografia']) ?></textarea><br>
<?php endif; ?>
<button type="submit">Guardar cambios</button>
</form>
<a href="/generos">Géneros</a> | <a href="/logout">Cerrar sesión</a>
</body></html>
