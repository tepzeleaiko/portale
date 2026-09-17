<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateArtists extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_artista' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'id_usuario' => ['type'=>'INT','constraint'=>10,'unsigned'=>true],
            'nombre_artistico' => ['type'=>'VARCHAR','constraint'=>100],
            'biografia' => ['type'=>'TEXT','null'=>true],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id_artista', true);
        $this->forge->addUniqueKey('id_usuario');
        $this->forge->addForeignKey('id_usuario','usuarios','id_usuario','CASCADE','CASCADE');
        $this->forge->createTable('artistas', true);
    }
    public function down(){ $this->forge->dropTable('artistas', true); }
}
