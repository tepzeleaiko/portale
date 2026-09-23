<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtistModel extends Model
{
    protected $table = 'artistas';
    protected $primaryKey = 'id_artista';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_usuario', 'nombre_artistico', 'ubicacion', 'verificado', 'biografia', 'spotify', 'soundcloud', 'instagram'
    ];
    protected $useTimestamps = true;

    public function getWithUser(int $idArtista): ?array
    {
        return $this->select('artistas.*, usuarios.nombre as user_nombre, usuarios.apellido as user_apellido, usuarios.email, usuarios.avatar')
                    ->join('usuarios', 'usuarios.id_usuario = artistas.id_usuario')
                    ->where('artistas.id_artista', $idArtista)
                    ->first();
    }
}
