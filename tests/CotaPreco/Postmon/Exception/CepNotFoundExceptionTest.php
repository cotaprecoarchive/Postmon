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
        $this->assertInstanceOf(
            CepNotFoundException::class,
            CepNotFoundException::forCep(Cep::fromString('12312300'))
        );
    }
}
