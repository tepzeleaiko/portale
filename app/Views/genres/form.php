<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Género</title></head><body>
<h1><?= $genre ? 'Editar género' : 'Nuevo género' ?></h1>
<?php if ($msg = session()->getFlashdata('error')): ?><p><?= esc($msg) ?></p><?php endif; ?>
<form method="post" action="<?= $genre ? '/generos/actualizar/'.$genre['id_genero'] : '/generos' ?>">
<?= csrf_field() ?><input name="nombre" value="<?= $genre ? esc($genre['nombre']) : '' ?>" placeholder="Nombre del género" required><button type="submit">Guardar</button>
</form><a href="/generos">Cancelar</a>
</body></html>
