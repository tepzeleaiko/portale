<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'sesiones';
    protected $primaryKey = 'id_sesion';
    protected $returnType = 'array';
    protected $allowedFields = ['id_usuario', 'session_id', 'ip', 'user_agent', 'ultima_actividad'];
}
