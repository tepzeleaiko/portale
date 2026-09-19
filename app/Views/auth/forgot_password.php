<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Recuperar contraseña</title></head><body>
<h1>Recuperar contraseña</h1>
<?php if ($msg = session()->getFlashdata('success')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<?php if ($msg = session()->getFlashdata('error')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<?php if ($token = session()->getFlashdata('reset_token_demo')): ?><p>Modo demo: <a href="/reset-password/<?= esc($token) ?>">continuar con el token de prueba</a>.</p><?php endif; ?>
<form method="post" action="/forgot-password">
<?= csrf_field() ?><input type="email" name="email" placeholder="Tu email" required><button type="submit">Enviar</button>
</form><a href="/login">Volver</a>
</body></html>
