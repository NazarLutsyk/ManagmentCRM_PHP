<?php

use yii\db\Migration;

/**
 * Class m180115_112437_offer
 */
class m180115_112437_offer extends Migration
{
    public function up()
    {
        $this->createTable('offer',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('offer');
    }
}
