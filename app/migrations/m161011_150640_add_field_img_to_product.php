<?php

use yii\db\Migration;

class m161011_150640_add_field_img_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('{{product}}', 'image', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{product}}', 'image');
    }
}
