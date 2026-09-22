<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Géneros - Portale</title></head><body>
<h1>Géneros musicales</h1>
<?php if ($msg = session()->getFlashdata('success')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<?php if ($msg = session()->getFlashdata('error')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<?php if (session()->get('rol') === 'Administrador'): ?><a href="/generos/nuevo">Nuevo género</a><?php endif; ?>
<ul><?php foreach ($genres as $genre): ?><li><?= esc($genre['nombre']) ?>
<?php if (session()->get('rol') === 'Administrador'): ?>
<a href="/generos/editar/<?= $genre['id_genero'] ?>">Editar</a>
<form method="post" action="/generos/eliminar/<?= $genre['id_genero'] ?>" style="display:inline"><?= csrf_field() ?><button type="submit">Eliminar</button></form>
<?php endif; ?></li><?php endforeach; ?></ul>
<a href="/perfil">Volver al perfil</a>
</body></html>
