<?php

use yii\db\Migration;

class m000000_000000_create_blog_tables extends Migration
{
    public function safeUp()
    {
// Create admins table
        $this->createTable('admins', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

// Create categories table
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

// Create posts table
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'admin_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

// Create post_images table
        $this->createTable('post_images', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'image_url' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

// Add foreign keys
        $this->addForeignKey('fk-posts-admin_id', 'posts', 'admin_id', 'admins', 'id', 'CASCADE');
        $this->addForeignKey('fk-posts-category_id', 'posts', 'category_id', 'categories', 'id', 'RESTRICT');
        $this->addForeignKey('fk-post_images-post_id', 'post_images', 'post_id', 'posts', 'id', 'CASCADE');

// Insert default admin for testing purposes (replace values later)
        $this->insert('admins', [
            'username' => 'admin1',
            'password_hash' => 'password_hash_example', // Replace with a hashed password
        ]);

// Insert some default categories for testing
        $this->batchInsert('categories', ['name'], [
            ['Technology'],
            ['Lifestyle'],
            ['Travel'],
            ['Education'],
            ['Health'],
        ]);
    }

    public function safeDown()
    {
// Drop foreign keys first
        $this->dropForeignKey('fk-post_images-post_id', 'post_images');
        $this->dropForeignKey('fk-posts-category_id', 'posts');
        $this->dropForeignKey('fk-posts-admin_id', 'posts');

// Drop tables in reverse order
        $this->dropTable('post_images');
        $this->dropTable('posts');
        $this->dropTable('categories');
        $this->dropTable('admins');
    }
}
