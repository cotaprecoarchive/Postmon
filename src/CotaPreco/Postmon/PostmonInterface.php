<?php

namespace CotaPreco\Postmon;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface PostmonInterface
{
    /**
     * @throws CepNotFoundException se o CEP `$cep` não for encontrado na base
     * de dados do Postmon
     *
     * @param  Cep $cep
     * @return PartialAddress
     */
    public function findAddressByCep(Cep $cep);
}
