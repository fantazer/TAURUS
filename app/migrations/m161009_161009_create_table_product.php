<?php

use yii\db\Migration;

class m161009_161009_create_table_product extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'characteristics' => $this->text(),
            'category_id' => $this->integer()->notNull(),
            'url' => $this->string(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
        ]);

        $this->addForeignKey('fk_product_to_category', '{{product}}', 'category_id', '{{category}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{product}}');
    }
}
