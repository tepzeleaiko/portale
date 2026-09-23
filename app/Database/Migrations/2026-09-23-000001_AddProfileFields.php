<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileFields extends Migration
{
    public function up()
    {
        // Agregar avatar a usuarios
        $this->forge->addColumn('usuarios', [
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'password_hash',
            ],
        ]);

        // Agregar ubicacion, verificado y redes a artistas
        $this->forge->addColumn('artistas', [
            'ubicacion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'nombre_artistico',
            ],
            'verificado' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'ubicacion',
            ],
            'spotify' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'biografia',
            ],
            'soundcloud' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'spotify',
            ],
            'instagram' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'soundcloud',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', ['avatar']);
        $this->forge->dropColumn('artistas', ['ubicacion', 'verificado', 'spotify', 'soundcloud', 'instagram']);
    }
}
