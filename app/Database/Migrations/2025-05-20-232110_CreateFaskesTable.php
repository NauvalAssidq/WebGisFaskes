<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaskesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'district' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'amenity' => [
                'type'       => "ENUM('Puskesmas', 'Rumah Sakit', 'Klinik')",
                'default'    => null,
                'null'       => true,
            ],
            'class' => [
                'type'       => "ENUM('A', 'B', 'C', 'D')",
                'default'    => null,
                'null'       => true,
            ],
            'hospital_type' => [
                'type'       => "ENUM('Pemerintah', 'Swasta')",
                'default'    => null,
                'null'       => true,
            ],
            'lat' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,6',
                'null'       => true,
            ],
            'lng' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,6',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('faskes');
    }

    public function down()
    {
        $this->forge->dropTable('faskes');
    }
}