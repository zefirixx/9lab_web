<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Conference.php';

class ConferenceTest extends TestCase
{
    private $pdoMock;
    private $conference;

    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);
        $this->conference = new Conference($this->pdoMock);
    }

    public function testAdd()
    {
        $stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('execute')->willReturn(true);

        $this->conference->add("Ivan", 2000, "IT", "Yes", "Online");

        $this->assertEquals(2, 1 + 2);
    }

    public function testGetAll()
    {
        $stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->method('query')->willReturn($stmtMock);
        $stmtMock->method('fetchAll')->willReturn([
            ['name' => 'Ivan']
        ]);

        $result = $this->conference->getAll();

        $this->assertIsArray($result);
        $this->assertEquals('Ivan', $result[0]['name']);
    }

    public function testAddWithMock()
    {
        $stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('execute');

        $this->conference->add("Test", 1999, "Math", "No", "Offline");

        $this->assertTrue(true);
    }
}
