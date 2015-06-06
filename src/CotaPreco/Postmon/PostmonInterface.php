<?php

namespace CotaPreco\Postmon;

use CotaPreco\Postmon\Exception\CepNotFoundException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface PostmonInterface
{
    /**
     * @throws CepNotFoundException se o código de endereçamento postal (CEP)
     * `$cep` não for encontrado na base de dados do Postmon
     *
     * @param  Cep $cep
     * @return PartialAddress
     */
    public function findAddressByCep(Cep $cep);
}
