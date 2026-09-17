<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rol' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'nombre' => ['type'=>'VARCHAR','constraint'=>30],
        ]);
        $this->forge->addKey('id_rol', true);
        $this->forge->addUniqueKey('nombre');
        $this->forge->createTable('roles', true);
    }
    public function down(){ $this->forge->dropTable('roles', true); }
}
