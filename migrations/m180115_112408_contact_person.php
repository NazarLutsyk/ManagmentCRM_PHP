<?php

use yii\db\Migration;

/**
 * Class m180115_112408_contact_person
 */
class m180115_112408_contact_person extends Migration
{
    public function up()
    {
        $this->createTable('contactPerson',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'position' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'company_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('contactPerson');
    }
}
