<?php

namespace CotaPreco\Postmon\Exception;

use CotaPreco\Postmon\Cep;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class CepNotFoundException extends \Exception implements ExceptionInterface
{
    /**
     * @param  Cep  $cep
     * @return self
     */
    public static function forCep(Cep $cep)
    {
        return new self(
            sprintf(
                'O CEP `%s` não foi encontrado. Talvez o mesmo não exista na base ' .
                'de dados do Postmon',
                (string) $cep
            )
        );
    }
}
