<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLotteryPrizes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'result_id' => ['type' => 'INT', 'unsigned' => true],
            'prize_level' => ['type' => 'ENUM', 'constraint' => ['1st', '2nd', '3rd', '4th', '5th']],
            'prize_number' => ['type' => 'VARCHAR', 'constraint' => 20],
            'is_consolation' => ['type' => 'TINYINT', 'default' => 0],
            'remarks' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('result_id', 'lottery_results', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('lottery_prizes');
    }

    public function down()
    {
        $this->forge->dropTable('lottery_prizes');
    }
}
