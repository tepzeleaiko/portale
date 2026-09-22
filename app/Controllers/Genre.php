<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\GenreModel;

class Genre extends Controller
{
    public function index()
    {
        return view('genres/index', ['genres' => (new GenreModel())->orderBy('nombre', 'ASC')->findAll()]);
    }

    public function new()
    {
        return view('genres/form', ['genre' => null]);
    }

    public function create()
    {
        $name = trim((string) $this->request->getPost('nombre'));
        if ($name === '') {
            return redirect()->back()->withInput()->with('error', 'El nombre es obligatorio.');
        }
        if ((new GenreModel())->where('nombre', $name)->first()) {
            return redirect()->back()->withInput()->with('error', 'Ese género ya existe.');
        }
        (new GenreModel())->insert(['nombre' => $name]);
        return redirect()->to('/generos')->with('success', 'Género creado.');
    }

    public function edit(int $id)
    {
        $genre = (new GenreModel())->find($id);
        if (!$genre) return redirect()->to('/generos')->with('error', 'Género inexistente.');
        return view('genres/form', ['genre' => $genre]);
    }

    public function update(int $id)
    {
        $name = trim((string) $this->request->getPost('nombre'));
        if ($name === '') return redirect()->back()->withInput()->with('error', 'El nombre es obligatorio.');
        $model = new GenreModel();
        $duplicate = $model->where('nombre', $name)->where('id_genero !=', $id)->first();
        if ($duplicate) return redirect()->back()->withInput()->with('error', 'Ese género ya existe.');
        $model->update($id, ['nombre' => $name]);
        return redirect()->to('/generos')->with('success', 'Género actualizado.');
    }

    public function delete(int $id)
    {
        (new GenreModel())->delete($id);
        return redirect()->to('/generos')->with('success', 'Género eliminado.');
    }
}
