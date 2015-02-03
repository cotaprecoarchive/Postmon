<?php

namespace CotaPreco\Postmon;

use GuzzleHttp\Client          as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use CotaPreco\Postmon\Exception\CepNotFoundException;
use Exception;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class Postmon implements PostmonInterface
{
    /**
     * @var string
     */
    const API_VERSION      = 'v1';
    const API_ENDPOINT_URL = 'http://api.postmon.com.br/{version}';

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new GuzzleHttpClient([
            'base_url' => [self::API_ENDPOINT_URL, [
                'version' => self::API_VERSION
            ]]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function findAddressByCep(Cep $cep)
    {
        try {
            /* @var GuzzleHttp\Message\Response $response */
            $response = $this->httpClient->get(sprintf(
                '/cep/%s',
                (string) $cep
            ));

            /* @var string[][] $json */
            $json = $response->json();

            return new PartialAddress(
                $json['estado_info']['nome'],
                $json['cidade'],
                isset($json['bairro'])
                    ? $json['bairro']
                    : null,
                isset($json['logradouro'])
                    ? $json['logradouro']
                    : null,
                isset($json['complemento'])
                    ? $json['complemento']
                    : null
            );
        } catch (Exception $e) {
        }

        throw CepNotFoundException::forCep($cep);
    }
}
