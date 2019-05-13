<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase {
    public function testDefined(): void {
        $this->assertNotNull(
            Request::class
        );
    }
}

?>