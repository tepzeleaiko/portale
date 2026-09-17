<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreatePasswordResets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reset' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'id_usuario' => ['type'=>'INT','constraint'=>10,'unsigned'=>true],
            'token_hash' => ['type'=>'VARCHAR','constraint'=>64],
            'expira_en' => ['type'=>'DATETIME'],
            'usado' => ['type'=>'TINYINT','constraint'=>1,'default'=>0],
        ]);
        $this->forge->addKey('id_reset', true);
        $this->forge->addKey('id_usuario');
        $this->forge->addUniqueKey('token_hash');
        $this->forge->addForeignKey('id_usuario','usuarios','id_usuario','CASCADE','CASCADE');
        $this->forge->createTable('password_resets', true);
    }
    public function down(){ $this->forge->dropTable('password_resets', true); }
}
