<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ArtistModel;
use App\Models\SessionModel;
use App\Models\PasswordResetModel;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');
        $userModel = new UserModel();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Email o contraseña incorrectos.');
        }

        $role = (new RoleModel())->find($user['id_rol']);
        session()->regenerate(true);
        session()->set([
            'id_usuario' => $user['id_usuario'],
            'email' => $user['email'],
            'nombre' => $user['nombre'],
            'rol' => $role['nombre'],
            'logged_in' => true,
        ]);

        (new SessionModel())->insert([
            'id_usuario' => $user['id_usuario'],
            'session_id' => session_id(),
            'ip' => $this->request->getIPAddress(),
            'user_agent' => (string) $this->request->getUserAgent(),
            'ultima_actividad' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/perfil')->with('success', 'Inicio de sesión correcto.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $rules = [
            'nombre' => 'required|min_length[2]|max_length[50]',
            'apellido' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email|max_length[120]|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]',
            'rol' => 'required|in_list[Artista,Consumidor]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $role = (new RoleModel())->where('nombre', $this->request->getPost('rol'))->first();
        $userModel = new UserModel();
        $idUsuario = $userModel->insert([
            'id_rol' => $role['id_rol'],
            'nombre' => trim($this->request->getPost('nombre')),
            'apellido' => trim($this->request->getPost('apellido')),
            'email' => strtolower(trim($this->request->getPost('email'))),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ], true);

        if ($role['nombre'] === 'Artista') {
            $nombreArtistico = trim((string) $this->request->getPost('nombre_artistico'));
            (new ArtistModel())->insert([
                'id_usuario' => $idUsuario,
                'nombre_artistico' => $nombreArtistico !== '' ? $nombreArtistico : trim($this->request->getPost('nombre')),
                'biografia' => trim((string) $this->request->getPost('biografia')),
            ]);
        }

        return redirect()->to('/login')->with('success', 'Cuenta creada. Ahora podés iniciar sesión.');
    }

    public function logout()
    {
        (new SessionModel())->where('session_id', session_id())->delete();
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada.');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $user = (new UserModel())->findByEmail($email);

        // No se revela si el correo existe.
        if ($user) {
            $token = bin2hex(random_bytes(32));
            (new PasswordResetModel())->insert([
                'id_usuario' => $user['id_usuario'],
                'token_hash' => hash('sha256', $token),
                'expira_en' => date('Y-m-d H:i:s', time() + 3600),
                'usado' => 0,
            ]);
            // En producción, enviar $token por correo mediante un servicio SMTP.
            session()->setFlashdata('reset_token_demo', $token);
        }

        return redirect()->to('/forgot-password')->with('success', 'Si el correo está registrado, se generó un enlace de recuperación.');
    }

    public function resetPassword(string $token)
    {
        $reset = (new PasswordResetModel())->where('token_hash', hash('sha256', $token))->where('usado', 0)->first();
        if (!$reset || strtotime($reset['expira_en']) < time()) {
            return redirect()->to('/forgot-password')->with('error', 'El enlace no es válido o expiró.');
        }
        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword(string $token)
    {
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->where('token_hash', hash('sha256', $token))->where('usado', 0)->first();
        if (!$reset || strtotime($reset['expira_en']) < time()) {
            return redirect()->to('/forgot-password')->with('error', 'El enlace no es válido o expiró.');
        }

        $password = (string) $this->request->getPost('password');
        if (strlen($password) < 8) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }

        (new UserModel())->update($reset['id_usuario'], ['password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
        $resetModel->update($reset['id_reset'], ['usado' => 1]);
        return redirect()->to('/login')->with('success', 'Contraseña actualizada.');
    }
}
