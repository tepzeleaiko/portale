<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Portale</title></head><body>
<h1>Portale</h1><p>Plataforma de comercialización de música digital independiente.</p>
<a href="/login">Iniciar sesión</a> | <a href="/register">Registrarse</a>
<?php if (session()->get('logged_in')): ?> | <a href="/perfil">Mi perfil</a> | <a href="/generos">Géneros</a><?php endif; ?>
</body></html>
