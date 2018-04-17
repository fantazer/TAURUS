<?php

use yii\db\Migration;

class m161006_145203_create_table_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'root_category_id' => $this->integer()->notNull(),
            'url' => $this->string(),
            'meta_title' => $this->text(),
            'meta_keywords' => $this->text(),
            'meta_description' => $this->text(),
        ]);

        $this->createIndex('category_unique_url', '{{category}}', ['root_category_id', 'url'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{category}}');
    }
}
