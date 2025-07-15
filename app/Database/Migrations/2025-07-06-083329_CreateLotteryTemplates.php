<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLotteryTemplates extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'templatefile' => ['type' => 'VARCHAR', 'constraint' => 100],
            'preview_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'first_prize_count' => ['type' => 'INT', 'unsigned' => true, 'default' => 1],
            'second_prize_count' => ['type' => 'INT', 'unsigned' => true, 'default' => 10],
            'third_prize_count' => ['type' => 'INT', 'unsigned' => true, 'default' => 20],
            'fourth_prize_count' => ['type' => 'INT', 'unsigned' => true, 'default' => 20],
            'fifth_prize_count' => ['type' => 'INT', 'unsigned' => true, 'default' => 100],
            'type' => ['type' => 'ENUM', 'constraint' => ['daily', 'bumper', 'special'], 'default' => 'daily'],
            'is_active' => ['type' => 'TINYINT', 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lottery_templates');
    }

    public function down()
    {
        $this->forge->dropTable('lottery_templates');
    }
}