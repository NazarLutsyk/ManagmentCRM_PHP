<?php

use yii\db\Migration;

/**
 * Class m180115_112446_task
 */
class m180115_112446_task extends Migration
{
    public function up()
    {
        $this->createTable('task',[
            'id' => $this->primaryKey(),
            'description' => $this->string(),
            'dateExec' => $this->dateTime(),
            'checked' => $this->boolean(),
            'company_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('task');
    }
}
