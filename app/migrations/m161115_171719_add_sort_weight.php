<?php

use yii\db\Migration;

class m161115_171719_add_sort_weight extends Migration
{
    public function up()
    {
        $this->addColumn('{{product}}', 'sort_weight', $this->integer());
        $this->addColumn('{{category}}', 'sort_weight', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{product}}', 'sort_weight');
        $this->dropColumn('{{category}}', 'sort_weight');
    }
}
