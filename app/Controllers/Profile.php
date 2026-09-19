<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ArtistModel;

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
        $userModel->update($id, [
            'nombre' => trim($this->request->getPost('nombre')),
            'apellido' => trim($this->request->getPost('apellido')),
        ]);

        $artist = (new ArtistModel())->where('id_usuario', $id)->first();
        if ($artist) {
            (new ArtistModel())->update($artist['id_artista'], [
                'nombre_artistico' => trim($this->request->getPost('nombre_artistico')),
                'biografia' => trim($this->request->getPost('biografia')),
            ]);
        }

        session()->set('nombre', trim($this->request->getPost('nombre')));
        return redirect()->to('/perfil')->with('success', 'Perfil actualizado.');
    }
}
