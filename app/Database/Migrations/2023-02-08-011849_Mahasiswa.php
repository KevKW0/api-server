<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => FALSE,
            ],
            'npm' => [
                'type'          => 'VARCHAR',
                'constraint'    => 9,
                'unique'        => TRUE,
            ],

            'phone' => [
                'type'          => 'VARCHAR',
                'constraint'    => 16,
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => FALSE,
                'unique'        => TRUE
            ],
            'created_at' => [
                'type'      => 'datetime',
                'null'      => TRUE
            ],
            'updated_at' => [
                'type'  => 'datetime',
                'null'  => TRUE
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
