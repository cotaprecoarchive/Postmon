<?php

namespace CotaPreco\Postmon;

use Respect\Validation\Validator;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
final class Cep
{
    /**
     * @var string
     */
    private $cep;

    /**
     * @param string $cep
     */
    private function __construct($cep)
    {
        $this->cep = (string) $cep;
    }

    /**
     * @throws \InvalidArgumentException se o código de endereçamento postal (CEP)
     * `$cepString` for inválido
     *
     * @param  string $cepString
     * @return self
     */
    public static function fromString($cepString)
    {
        $cepString = (string) $cepString;

        if (! Validator::postalCode('BR')->validate($cepString)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'O CEP `%s` é inválido',
                    $cepString
                )
            );
        }

        return new self($cepString);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->cep;
    }
}
