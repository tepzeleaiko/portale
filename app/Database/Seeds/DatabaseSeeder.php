<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = $this->db;
        $db->table('roles')->insertBatch([
            ['nombre'=>'Administrador'],
            ['nombre'=>'Artista'],
            ['nombre'=>'Consumidor'],
        ]);

        $adminRole = $db->table('roles')->where('nombre','Administrador')->get()->getRowArray();
        $db->table('usuarios')->insert([
            'id_rol' => $adminRole['id_rol'],
            'nombre' => 'Administrador',
            'apellido' => 'Portale',
            'email' => 'admin@portale.local',
            'password_hash' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $db->table('generos')->insertBatch([
            ['nombre'=>'Rock'], ['nombre'=>'Pop'], ['nombre'=>'Hip Hop'],
            ['nombre'=>'Electrónica'], ['nombre'=>'Trap'], ['nombre'=>'Reggaetón']
        ]);
    }
}
