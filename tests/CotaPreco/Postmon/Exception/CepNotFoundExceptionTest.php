<?php

namespace CotaPreco\Postmon\Exception;

use CotaPreco\Postmon\Cep;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class CepNotFoundExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function forCep()
    {
        $this->assertInstanceOf(
            CepNotFoundException::class,
            CepNotFoundException::forCep(Cep::fromString('12312300'))
        );
    }
}
