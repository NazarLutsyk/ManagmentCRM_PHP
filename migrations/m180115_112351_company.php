<?php

use yii\db\Migration;

/**
 * Class m180115_112351_company
 */
class m180115_112351_company extends Migration
{
    public function up()
    {
        $this->createTable('company',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'adress' => $this->string(),
            'url' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('company');
    }
}
