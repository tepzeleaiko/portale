<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre'];
}
