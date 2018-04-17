<?php

use yii\db\Migration;

class m161006_163052_add_description_to_category extends Migration
{
    public function up()
    {
        $this->addColumn('{{category}}', 'description', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{cateogry}}', 'description');
    }
}
