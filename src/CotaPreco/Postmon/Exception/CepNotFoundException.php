<?php

namespace CotaPreco\Postmon\Exception;

use CotaPreco\Postmon\Cep;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class CepNotFoundException extends \Exception implements
    ExceptionInterface
{
    /**
     * @param  Cep  $cep
     * @return self
     */
    public static function forCep(Cep $cep)
    {
        return new self(sprintf('CEP `%s` não encontrado', (string) $cep));
    }
}
