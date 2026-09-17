<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id_reset';
    protected $returnType = 'array';
    protected $allowedFields = ['id_usuario', 'token_hash', 'expira_en', 'usado'];
}
