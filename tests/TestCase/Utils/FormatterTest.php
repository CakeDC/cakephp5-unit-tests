<?php
declare(strict_types=1);

namespace App\Test\TestCase\Utils;

use App\Utils\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
    protected Formatter $formatter;

    public function setUp(): void
    {
        parent::setUp();
        $this->formatter = new Formatter();
    }

    public function tearDown(): void
    {
        unset($this->formatter);
        parent::tearDown();
    }

    public function testFormatStatPercentage(): void
    {
        $expected = '50%';
        $result = $this->formatter->formatStatPercentage(1, 1);
        $this->assertSame($expected, $result);
    }

    public function testFormatStatPercentageShouldReturnPlayMoreGames(): void
    {
        $expected = 'Play more games!';
        $result = $this->formatter->formatStatPercentage(0, 1);
        $this->assertSame($expected, $result);
    }
}
