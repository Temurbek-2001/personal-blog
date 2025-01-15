<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        verify($user = User::findIdentity(1))->notEmpty();
        verify($user->username)->equals('john_doe');

        verify(User::findIdentity(999))->empty();
    }

    public function testFindUserByAccessToken()
    {
        verify($user = User::findIdentityByAccessToken('token1'))->notEmpty();
        verify($user->username)->equals('john_doe');

        verify(User::findIdentityByAccessToken('non-existing'))->empty();        
    }

    public function testFindUserByUsername()
    {
        verify($user = User::findByUsername('john_doe'))->notEmpty();
        verify(User::findByUsername('not-john_doe'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        $user = User::findByUsername('john_doe');
        verify($user->validateAuthKey('authkey1'))->notEmpty();
        verify($user->validateAuthKey('not-authkey1'))->empty();

    }

}
