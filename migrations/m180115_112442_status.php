<?php

use yii\db\Migration;

/**
 * Class m180115_112442_status
 */
class m180115_112442_status extends Migration
{
    public function up()
    {
        $this->createTable('status',[
            'id' => $this->primaryKey(),
            'value' => $this->string(),
            'company_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('status');
    }
}
