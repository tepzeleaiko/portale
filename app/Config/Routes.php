<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Autenticación
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);

// Recuperación de contraseña
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('forgot-password', 'Auth::sendResetLink');
$routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('reset-password/(:segment)', 'Auth::updatePassword/$1');

// Perfil
$routes->get('perfil', 'Profile::index', ['filter' => 'auth']);
$routes->post('perfil', 'Profile::update', ['filter' => 'auth']);

// Entidad secundaria: Géneros
$routes->get('generos', 'Genre::index', ['filter' => 'auth']);
$routes->get('generos/nuevo', 'Genre::new', ['filter' => ['auth', 'admin']]);
$routes->post('generos', 'Genre::create', ['filter' => ['auth', 'admin']]);
$routes->get('generos/editar/(:num)', 'Genre::edit/$1', ['filter' => ['auth', 'admin']]);
$routes->post('generos/actualizar/(:num)', 'Genre::update/$1', ['filter' => ['auth', 'admin']]);
$routes->post('generos/eliminar/(:num)', 'Genre::delete/$1', ['filter' => ['auth', 'admin']]);

