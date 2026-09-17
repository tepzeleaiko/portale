<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'id_rol' => ['type'=>'INT','constraint'=>10,'unsigned'=>true],
            'nombre' => ['type'=>'VARCHAR','constraint'=>50],
            'apellido' => ['type'=>'VARCHAR','constraint'=>50],
            'email' => ['type'=>'VARCHAR','constraint'=>120],
            'password_hash' => ['type'=>'VARCHAR','constraint'=>255],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id_usuario', true);
        $this->forge->addKey('id_rol');
        $this->forge->addUniqueKey('email');
        $this->forge->addForeignKey('id_rol','roles','id_rol','CASCADE','RESTRICT');
        $this->forge->createTable('usuarios', true);
    }
    public function down(){ $this->forge->dropTable('usuarios', true); }
}
