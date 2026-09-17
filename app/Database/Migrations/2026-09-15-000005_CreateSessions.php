<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateSessions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sesion' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'id_usuario' => ['type'=>'INT','constraint'=>10,'unsigned'=>true],
            'session_id' => ['type'=>'VARCHAR','constraint'=>128],
            'ip' => ['type'=>'VARCHAR','constraint'=>45],
            'user_agent' => ['type'=>'TEXT','null'=>true],
            'ultima_actividad' => ['type'=>'DATETIME'],
        ]);
        $this->forge->addKey('id_sesion', true);
        $this->forge->addKey('id_usuario');
        $this->forge->addKey('session_id');
        $this->forge->addForeignKey('id_usuario','usuarios','id_usuario','CASCADE','CASCADE');
        $this->forge->createTable('sesiones', true);
    }
    public function down(){ $this->forge->dropTable('sesiones', true); }
}
