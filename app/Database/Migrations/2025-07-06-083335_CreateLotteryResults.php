<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLotteryResults extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'template_id' => ['type' => 'INT', 'unsigned' => true],
            'draw_date' => ['type' => 'DATE'],
            'draw_time' => ['type' => 'TIME'],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'scheduled', 'published', 'archived'], 'default' => 'draft'],
            'pdf_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pdf_generated_at' => ['type' => 'DATETIME', 'null' => true],
            'publish_time' => ['type' => 'DATETIME', 'null' => true],
            'created_by' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('template_id', 'lottery_templates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lottery_results');
    }

    public function down()
    {
        $this->forge->dropTable('lottery_results');
    }
}
