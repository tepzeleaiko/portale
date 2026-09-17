<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtistModel extends Model
{
    protected $table = 'artistas';
    protected $primaryKey = 'id_artista';
    protected $returnType = 'array';
    protected $allowedFields = ['id_usuario', 'nombre_artistico', 'biografia'];
    protected $useTimestamps = true;
}
