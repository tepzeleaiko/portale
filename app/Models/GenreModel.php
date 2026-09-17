<?php

namespace App\Models;

use CodeIgniter\Model;

class GenreModel extends Model
{
    protected $table = 'generos';
    protected $primaryKey = 'id_genero';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre'];
}
