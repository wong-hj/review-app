<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Review extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'rating' => [
                'type' => 'INT',
                'constraint' => 1
            ],
            'restaurant' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 512

            ],
            'stall_pic' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]
        ]);

        $this->forge->addPrimaryKey('id')
                    ->addUniqueKey('name');

        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
        //
    }
}
