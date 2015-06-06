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
    public function fromStringThrowsInvalidArgument($cep)
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        Cep::fromString($cep);
    }

    /**
     * @test
     * @covers ::fromString
     */
    public function fromString()
    {
        $cep = Cep::fromString('12312300');

        $this->assertInstanceOf(Cep::class, $cep);
        $this->assertEquals('12312300', (string) $cep);

    }

    /**
     * @return \string[][]
     */
    public function provideInvalidCeps()
    {
        return [
            ['1234567.8'],
            ['#123455678'],
            ['12345'],
            [''],
            [null]
        ];
    }
}
