<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images_gallery_model}}`.
 */
class m201209_114821_create_images_gallery_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images_gallery_model}}', [
            'id' => $this->primaryKey()->unsigned(),
            'weight' => $this->integer()->unsigned()->notNull(),
            'modelName' => $this->string(150)->notNull(),
            'itemId' => $this->integer()->unsigned()->notNull(),
            'title' => $this->string(255),
            'desc' => $this->text(),
        ]);

        $this->createIndex(
            'idx-images_gallery_model-weight',
            'images_gallery_model',
            'weight'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images_gallery_model}}');
    }
}
