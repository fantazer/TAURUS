<?php

use yii\db\Migration;

class m161009_164047_add_field_price_to_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{product}}', 'price', $this->double());
    }

    public function safeDown()
    {
        $this->dropColumn('{{product}}', 'price');
    }
}
