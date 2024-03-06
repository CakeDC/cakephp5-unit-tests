<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Users',
        'app.Games',
        'app.Moves',
    ];

    public function testRegister(): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $email = 'bill@example.com';
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $this->assertCount(0, $usersTable->findByEmail($email));
        $data = [
            'first_name' => 'Bill',
            'last_name' => 'Smith',
            'email' => $email,
            'password' => 'password',
        ];
        $this->post('/users/add', $data);
        $this->assertResponseSuccess();
        $this->assertRedirect('/users');
        $user = $usersTable->findByEmail($email)->firstOrFail();
        $hasher = new DefaultPasswordHasher();
        $this->assertTrue($hasher->check('password', $user['password']));
        $this->assertTrue($user['is_active']);
        $this->assertFalse($user['is_superuser']);
        $this->assertSame('Bill', $user['first_name']);
        $this->assertSame('Smith', $user['last_name']);
        $this->assertSame($email, $user['email']);
    }

    public function testRegisterDuplicatedEmail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $email = 'a@example.com';
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $this->assertCount(1, $usersTable->findByEmail($email));
        $data = [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => $email,
            'password' => 'password',
        ];
        $this->enableRetainFlashMessages();
        $this->post('/users/add', $data);
        $this->assertResponseSuccess();
        $this->assertNoRedirect();
        $this->assertSame('The user could not be saved. Please, try again.',
            Hash::get($this->_flashMessages, 'flash.0.message')
        );
        $query = $usersTable->findByEmail($email);
        $this->assertCount(1, $query);
        $this->assertSame('a', $query->firstOrFail()->get('first_name'));
    }
}
