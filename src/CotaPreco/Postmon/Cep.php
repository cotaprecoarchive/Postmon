<?php

/*
 * Copyright (c) 2015 Cota Preço
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

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
