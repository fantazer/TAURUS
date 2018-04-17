<?php

use yii\db\Migration;

class m161010_161338_create_table_product_slide extends Migration
{
    public function up()
    {
        $this->createTable('{{product_slide}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_product_slide_to_product', '{{product_slide}}', 'product_id', '{{product}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_product_slide_to_product');
        $this->dropTable('{{product_slide}}');
    }
}
