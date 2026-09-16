# Rutas Hito 1

| Método | Ruta | Controlador | Acceso |
|---|---|---|---|
| GET | `/` | Home::index | Público |
| GET | `/login` | Auth::login | Público |
| POST | `/login` | Auth::attemptLogin | Público |
| GET | `/register` | Auth::register | Público |
| POST | `/register` | Auth::attemptRegister | Público |
| GET | `/logout` | Auth::logout | Logueado |
| GET | `/forgot-password` | Auth::forgotPassword | Público |
| POST | `/forgot-password` | Auth::sendResetLink | Público |
| GET | `/reset-password/(:segment)` | Auth::resetPassword | Público |
| POST | `/reset-password/(:segment)` | Auth::updatePassword | Público |
| GET | `/perfil` | Profile::index | Logueado |
| POST | `/perfil` | Profile::update | Logueado |
| GET | `/generos` | Genre::index | Logueado |
| GET | `/generos/nuevo` | Genre::new | Administrador |
| POST | `/generos` | Genre::create | Administrador |
| GET | `/generos/editar/(:num)` | Genre::edit | Administrador |
| POST | `/generos/actualizar/(:num)` | Genre::update | Administrador |
| POST | `/generos/eliminar/(:num)` | Genre::delete | Administrador |
