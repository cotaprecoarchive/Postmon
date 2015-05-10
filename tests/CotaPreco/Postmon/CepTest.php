<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @coversDefaultClass CotaPreco\Postmon\Cep
 */
class CepTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideInvalidCeps
     * @param string $cep
     */
    public function newCepThrowsInvalidArgument($cep)
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        new Cep($cep);
    }

    /**
     * @test
     * @covers ::fromString
     */
    public function fromString()
    {
        $this->assertInstanceOf(Cep::class, Cep::fromString('12312300'));
    }

    /**
     * @test
     * @covers ::fromString
     * @covers ::__toString
     */
    public function castsToString()
    {
        $this->assertSame('12312300', (string) Cep::fromString('12312300'));
    }

    /**
     * @return \string[][]
     */
    public function provideInvalidCeps()
    {
        return [
            ['--------'],
            ['1234567.8'],
            ['#123455678'],
            ['12345'],
            [''],
            [null]
        ];
    }
}
