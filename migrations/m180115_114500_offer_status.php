<?php

use yii\db\Migration;

/**
 * Class m180115_114500_offer_status
 */
class m180115_114500_offer_status extends Migration
{
    public function up()
    {
        $this->createTable('offerStatus',[
            'id' => $this->primaryKey(),
            'offer_id' => $this->integer(),
            'status_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('offerStatus');
    }
}
