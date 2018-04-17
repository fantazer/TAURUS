<?php

use yii\db\Migration;

class m161026_160309_add_description_to_tag extends Migration
{
    public function up()
    {
        $this->addColumn('{{tag}}', 'description', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{tag}}', 'description');
    }
}
