<?php

namespace CotaPreco\Postmon\Exception;

use PHPUnit_Framework_TestCase as TestCase;
use CotaPreco\Postmon\Cep;

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
        $cep = $this->getMockBuilder(Cep::class)
                    ->disableOriginalConstructor()
                    ->getMock();

        $this->assertInstanceOf(
            CepNotFoundException::class,
            CepNotFoundException::forCep($cep)
        );
    }
}
