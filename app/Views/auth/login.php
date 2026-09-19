<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Login - Portale</title></head><body>
<h1>Iniciar sesión</h1>
<?php if ($msg = session()->getFlashdata('success')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<?php if ($msg = session()->getFlashdata('error')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<form method="post" action="/login">
<?= csrf_field() ?>
<label>Email <input type="email" name="email" required></label><br>
<label>Contraseña <input type="password" name="password" required></label><br>
<button type="submit">Ingresar</button>
</form>
<a href="/register">Crear cuenta</a><br><a href="/forgot-password">Olvidé mi contraseña</a>
</body></html>
