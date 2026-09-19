<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Nueva contraseña</title></head><body>
<h1>Nueva contraseña</h1>
<?php if ($msg = session()->getFlashdata('error')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<form method="post" action="/reset-password/<?= esc($token) ?>">
<?= csrf_field() ?><input type="password" name="password" placeholder="Nueva contraseña" minlength="8" required><button type="submit">Cambiar contraseña</button>
</form></body></html>
