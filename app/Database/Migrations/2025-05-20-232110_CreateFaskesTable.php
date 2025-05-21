<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaskesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'code'          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'image'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'address'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'district'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'amenity'       => ['type' => 'ENUM', 'constraint' => ['Puskesmas', 'Rumah Sakit', 'Klinik'], 'null' => true],
            'class'         => ['type' => 'ENUM', 'constraint' => ['A', 'B', 'C', 'D'], 'null' => true],
            'hospital_type' => ['type' => 'ENUM', 'constraint' => ['Pemerintah', 'Swasta'], 'null' => true],
            'care_type'     => ['type' => 'ENUM', 'constraint' => ['Rawat Inap', 'Non Rawat Inap'], 'null' => true],
            'lat'           => ['type' => 'DECIMAL', 'constraint' => '10,6', 'null' => true],
            'lng'           => ['type' => 'DECIMAL', 'constraint' => '10,6', 'null' => true],
        ]);

        $this->forge->addKey('id', true); // primary key
        $this->forge->createTable('faskes');
    }

    public function down()
    {
        $this->forge->dropTable('faskes');
    }
}
