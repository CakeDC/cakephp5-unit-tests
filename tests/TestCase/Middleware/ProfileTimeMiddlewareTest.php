<?php
declare(strict_types=1);

namespace App\Test\TestCase\Middleware;

use App\Middleware\ProfileTimeMiddleware;
use Cake\TestSuite\TestCase;

/**
 * App\Middleware\ProfileTimeMiddleware Test Case
 */
class ProfileTimeMiddlewareTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Middleware\ProfileTimeMiddleware
     */
    protected $ProfileTime;

    /**
     * Test process method
     *
     * @return void
     * @uses \App\Middleware\ProfileTimeMiddleware::process()
     */
    public function testProcess(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
