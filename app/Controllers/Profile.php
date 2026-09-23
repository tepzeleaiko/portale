<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ArtistModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Profile extends Controller
{
    public function index()
    {
        $user = (new UserModel())->find(session()->get('id_usuario'));
        $artist = (new ArtistModel())->where('id_usuario', session()->get('id_usuario'))->first();
        return view('profile/index', ['user' => $user, 'artist' => $artist]);
    }

    public function update()
    {
        $id = session()->get('id_usuario');
        $userModel = new UserModel();
        
        $userData = [
            'nombre'   => trim((string) $this->request->getPost('nombre')),
            'apellido' => trim((string) $this->request->getPost('apellido')),
        ];

        // Procesar subida de foto de perfil
        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            if (in_array($avatarFile->getMimeType(), $validTypes, true)) {
                $newName = $avatarFile->getRandomName();
                $uploadPath = FCPATH . 'uploads/avatars';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $avatarFile->move($uploadPath, $newName);
                $userData['avatar'] = '/uploads/avatars/' . $newName;
            }
        }

        $userModel->update($id, $userData);

        $artistModel = new ArtistModel();
        $artist = $artistModel->where('id_usuario', $id)->first();
        if ($artist) {
            $artistData = [
                'nombre_artistico' => trim((string) $this->request->getPost('nombre_artistico')),
                'ubicacion'        => trim((string) $this->request->getPost('ubicacion')),
                'biografia'        => trim((string) $this->request->getPost('biografia')),
                'spotify'          => trim((string) $this->request->getPost('spotify')),
                'soundcloud'       => trim((string) $this->request->getPost('soundcloud')),
                'instagram'        => trim((string) $this->request->getPost('instagram')),
            ];
            $artistModel->update($artist['id_artista'], $artistData);
        }

        session()->set('nombre', trim((string) $this->request->getPost('nombre')));
        return redirect()->to('/perfil')->with('success', 'Perfil y fotografía actualizados correctamente.');
    }

    public function artist(int $id)
    {
        $artistModel = new ArtistModel();
        $artist = $artistModel->getWithUser($id);
        
        if (!$artist) {
            throw PageNotFoundException::forPageNotFound('El perfil de artista solicitado no existe.');
        }

        return view('artists/show', ['artist' => $artist]);
    }
}
