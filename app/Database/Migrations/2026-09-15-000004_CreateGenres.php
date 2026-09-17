<?php

namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateGenres extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_genero' => ['type'=>'INT','constraint'=>10,'unsigned'=>true,'auto_increment'=>true],
            'nombre' => ['type'=>'VARCHAR','constraint'=>80],
        ]);
        $this->forge->addKey('id_genero', true);
        $this->forge->addUniqueKey('nombre');
        $this->forge->createTable('generos', true);
    }
    public function down(){ $this->forge->dropTable('generos', true); }
}
