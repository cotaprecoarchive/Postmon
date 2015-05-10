<?php

namespace CotaPreco\Postmon\Exception;

use CotaPreco\Postmon\Cep;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @coversDefaultClass CotaPreco\Postmon\Exception\CepNotFoundException
 */
class CepNotFoundExceptionTest extends TestCase
{
    /**
     * @covers ::forCep
     */
    public function testNotFoundForCep()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|Cep $cep */
        $cep = $this->getMockBuilder(Cep::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(
            CepNotFoundException::class,
            CepNotFoundException::forCep($cep)
        );
    }
}
