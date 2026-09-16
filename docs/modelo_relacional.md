# Modelo Relacional — Portale — Hito 1

## Tablas principales

**ROLES**
- `id_rol` PK
- `nombre` UNIQUE NOT NULL

**USUARIOS**
- `id_usuario` PK
- `id_rol` FK → ROLES.id_rol
- `nombre`
- `apellido`
- `email` UNIQUE
- `password_hash`
- `created_at`
- `updated_at`

**ARTISTAS**
- `id_artista` PK
- `id_usuario` FK UNIQUE → USUARIOS.id_usuario
- `nombre_artistico`
- `biografia`
- `created_at`
- `updated_at`

**GENEROS**
- `id_genero` PK
- `nombre` UNIQUE

**SESIONES**
- `id_sesion` PK
- `id_usuario` FK → USUARIOS.id_usuario
- `session_id`
- `ip`
- `user_agent`
- `ultima_actividad`

**PASSWORD_RESETS** *(tabla técnica para recuperación de contraseña)*
- `id_reset` PK
- `id_usuario` FK → USUARIOS.id_usuario
- `token_hash` UNIQUE
- `expira_en`
- `usado`

## Relaciones
- ROLES 1:N USUARIOS
- USUARIOS 1:0..1 ARTISTAS
- USUARIOS 1:N SESIONES
- USUARIOS 1:N PASSWORD_RESETS
- GENEROS queda preparada para relacionarse con RELEASES en Hito 2.

## Normalización hasta 3FN

**1FN:** todos los atributos contienen valores atómicos y no existen grupos repetitivos.

**2FN:** en las tablas con clave simple, todos los atributos no clave dependen de la clave primaria completa. En ARTISTAS, por ejemplo, los datos del perfil dependen de `id_artista`; la relación con el usuario se realiza mediante `id_usuario`.

**3FN:** no hay dependencias transitivas entre atributos no clave. El nombre del rol no se repite en USUARIOS: se obtiene mediante `id_rol`. Los datos específicos del artista tampoco se mezclan con los datos generales del usuario.

La tabla `password_resets` es de soporte técnico y mantiene su dependencia directa de `id_reset` y su relación con el usuario mediante FK.
