<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;
use InvalidArgumentException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @covers CotaPreco\Postmon\Cep
 * @covers ::__construct
 */
class CepTest extends TestCase
{
    /**
     * @dataProvider provideInvalidCeps
     * @param string $cep
     */
    public function testCreateCepWithInvalidPostalCodeThrowsException($cep)
    {
        $this->setExpectedException(InvalidArgumentException::class);
        new Cep($cep);
    }

    /**
     * @covers ::fromString
     */
    public function testCreateCepFromString()
    {
        $this->assertInstanceOf(Cep::class, Cep::fromString('12312300'));
    }

    /**
     * @covers ::fromString
     * @covers ::__toString
     */
    public function testCepCastsToString()
    {
        $cep = '12312300';
        $this->assertSame($cep, (string) Cep::fromString($cep));
    }

    /**
     * @return string[][]
     */
    public function provideInvalidCeps()
    {
        return [
            ['--------'],
            ['1234567.8'],
            ['#123455678'],
            ['12345']
        ];
    }
}
