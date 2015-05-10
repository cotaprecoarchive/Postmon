<?php

namespace CotaPreco\Postmon;

use CotaPreco\Postmon\Exception\CepNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\Response;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class Postmon implements PostmonInterface
{
    /**
     * @var string
     */
    const API_VERSION = 'v1';

    /**
     * @var string
     */
    const API_ENDPOINT_URL = 'http://api.postmon.com.br/{version}';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'base_url' => [
                self::API_ENDPOINT_URL, [
                    'version' => self::API_VERSION
                ]
            ]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function findAddressByCep(Cep $cep)
    {
        try {
            /* @var Response $response */
            $response = $this->httpClient->get('/cep/' . (string) $cep);

            /* @var string[][] $json */
            $json = $response->json();

            return new PartialAddress(
                $json['estado_info']['nome'],
                $json['cidade'],
                isset($json['bairro']) ? $json['bairro'] : null,
                isset($json['logradouro']) ? $json['logradouro'] : null,
                isset($json['complemento']) ? $json['complemento'] : null
            );
        } catch (\Exception $e) {
        }

        throw CepNotFoundException::forCep($cep);
    }
}
