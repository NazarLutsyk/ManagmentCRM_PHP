<?php

use yii\db\Migration;

/**
 * Class m180115_112431_call
 */
class m180115_112431_call extends Migration
{
    public function up()
    {
        $this->createTable('call',[
            'id' => $this->primaryKey(),
            'date' => $this->dateTime(),
            'description' => $this->string(),
            'company_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('call');
    }
}
