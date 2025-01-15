<?php

namespace app\tests\unit\models;

use Codeception\PHPUnit\TestCase;
use Yii;
use app\models\Posts;
use app\models\User;
use app\models\Categories;
use yii\db\ActiveRecord;

class PostsTest extends TestCase
{
    private $testUser;
    private $testCategory;

    private $postId;

    /**
     * Setup test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        // Create a test user and category for testing purposes
        $this->testUser = User::findOne(1);
        $this->testCategory = Categories::findOne(1);

    }


    /**
     * Test rules validation for creating a post.
     */
    public function testValidation()
    {
        // Test that creating a post without required fields fails
        $post = new Posts();
        $this->assertFalse($post->validate());

        // Check that it needs user_id, category_id, title, and content
        $this->assertArrayHasKey('user_id', $post->errors);
        $this->assertArrayHasKey('category_id', $post->errors);
        $this->assertArrayHasKey('title', $post->errors);
        $this->assertArrayHasKey('content', $post->errors);

        // Test creating a post with valid data
        $post->user_id = $this->testUser->id;
        $post->category_id = $this->testCategory->id;
        $post->title = 'Sample Post';
        $post->content = 'This is a sample post content';
        $this->assertTrue($post->validate());
    }

    /**
     * Test relationships with User and Categories models.
     */
    public function testRelations()
    {
        $post = new Posts();
        $post->user_id = $this->testUser->id;
        $post->category_id = $this->testCategory->id;
        $post->title = 'Sample Post';
        $post->content = 'This is a sample post content';
        $post->save();

        // Test the relationship with User
        $user = $post->user;
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotEmpty($user);

        // Test the relationship with Categories
        $category = $post->category;
        $this->assertInstanceOf(Categories::class, $category);
        $this->assertNotEmpty($category);

        // Cleanup after test
        $post->delete();
    }

    /**
     * Test creating a post with view_count default value.
     */
    public function testDefaultViewCount()
    {
        $post = new Posts();
        $post->user_id = $this->testUser->id;
        $post->category_id = $this->testCategory->id;
        $post->title = 'Post with default view_count';
        $post->content = 'Test content for view count';
        $this->assertTrue($post->save());

        // Check that view_count defaults to 0
        $savedPost = Posts::findOne($post->id);
        $this->assertEquals(0, $savedPost->view_count);

        // Cleanup after test
        $post->delete();
    }

    /**
     * Test that the updated_at field is updated on save.
     */
    public function testUpdatedAtField()
    {
        $post = new Posts();
        $post->user_id = $this->testUser->id;
        $post->category_id = $this->testCategory->id;
        $post->title = 'Post with updated_at test';
        $post->content = 'Updated content for updated_at';
        $post->save();

        $originalUpdatedAt = $post->updated_at;

        // Update the post content
        $post->content = 'Updated content again';
        $this->assertTrue($post->save());

        // Assert that the updated_at field has changed
        $post->refresh();
        $this->assertNotEquals($originalUpdatedAt, $post->updated_at);

        // Cleanup after test
        $post->delete();
    }

    /**
     * Test the post's delete functionality.
     */
    public function testDeletePost()
    {
        // Create a new post
        $post = new Posts();
        $post->user_id = $this->testUser->id;
        $post->category_id = $this->testCategory->id;
        $post->title = 'Post to delete';
        $post->content = 'Test content for delete';

        $this->assertTrue($post->save(), 'Failed to save the post');

        $postId = $post->id;

        $this->assertNotNull(Posts::findOne($postId), 'Post not found before deletion');

        $deleteResult = $post->delete();
        $this->assertTrue($deleteResult == 1, 'Post deletion failed');

        $this->assertNull(Posts::findOne($postId), 'Post was not deleted');
    }


}
