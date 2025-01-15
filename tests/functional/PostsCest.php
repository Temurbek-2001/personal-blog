<?php

namespace app\tests\functional;

use app\models\User;
use FunctionalTester;
use Yii;

class PostsCest
{
    private $testUser;

    public function _before(FunctionalTester $I)
    {
        // Assume testUser is authenticated
        $this->testUser = User::findOne(1);
        $I->amLoggedInAs($this->testUser);
    }

    public function testIndexPage(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Welcome!', 'h1');
        $I->see('Here are the latest posts:', 'p');
    }

    public function testCreatePost(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Welcome!', 'h1');
        $I->seeLink('Create');
        $I->click('Create');
        $I->see('Create Posts', 'h1');


        $I->submitForm('#posts-form-id', [
            'Posts[title]' => 'Functional Test Post',
            'Posts[content]' => 'This is a functional test.',
            'Posts[category_id]' => 1,
        ]);

        $I->see('Functional Test Post');
        $I->see('This is a functional test.');
    }

    public function testUpdatePost(FunctionalTester $I)
    {
        $postId = 1; // Assume a post with ID 1 exists

        // Navigate to the homepage
        $I->amOnPage('/');
        $I->see('Welcome!', 'h1');
        $I->seeLink('Posts'); // Ensure the 'Posts' link exists
        $I->click('Posts'); // Simulate clicking the 'Posts' link
        $I->see('My Posts', 'h1'); // Confirm navigation to the posts list

        // Navigate to the update page for a specific post
        $I->seeLink('Edit'); // Ensure the 'Edit' link exists
        $I->click('Edit'); // Click the 'Edit' link
        $I->see('Category', 'label'); // Confirm navigation to the update page

        // Submit the form with updated data
        $I->submitForm('#posts-form-id', [
            'Posts[title]' => 'Updated Functional Test Post',
            'Posts[content]' => 'Updated content for functional test.',
            'Posts[category_id]' => 1,
        ]);

        // Verify the updated content is displayed
        $I->see('Updated Functional Test Post');
        $I->see('Updated content for functional test.');
    }




}