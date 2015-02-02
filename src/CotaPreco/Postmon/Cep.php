<?php

namespace CotaPreco\Postmon;

use Respect\Validation\Validator as RespectValidator;
use InvalidArgumentException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class Cep
{
    /**
     * @var string
     */
    private $cep;

    public function __construct($cep)
    {
        $cep = (string) $cep;

        if (!RespectValidator::postalCode('BR')->validate($cep)) {
            throw new InvalidArgumentException(sprintf(
                'CEP `%s` inválido',
                $cep
            ));
        }

        $this->cep = $cep;
    }

    /**
     * @param  string $cep
     * @return self
     */
    public static function fromString($cep)
    {
        return new Cep($cep);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->cep;
    }
}
