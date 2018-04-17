<?php

use yii\db\Migration;

class m161011_163456_create_table_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{tag}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('{{tag_product}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('index_tag', '{{tag_product}}', 'tag_id');
        $this->createIndex('index_post', '{{tag_product}}', 'product_id');
        $this->addForeignKey('fk_tag_to_product', '{{tag_product}}', 'tag_id', '{{tag}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_to_tag', '{{tag_product}}', 'product_id', '{{product}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{tag}}');
        $this->dropTable('{{tag_product}}');
    }
}
