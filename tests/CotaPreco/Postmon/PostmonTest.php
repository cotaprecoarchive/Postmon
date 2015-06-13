<?php

namespace CotaPreco\Postmon;

use CotaPreco\Postmon\Exception\CepNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class PostmonTest extends TestCase
{
    /**
     * @test
     */
    public function findAddressByCepThrowsCepNotFound()
    {
        $this->setExpectedException(CepNotFoundException::class);

        $handler = new MockHandler([
            new Response(404)
        ]);

        $client = new Client([
            'handler' => HandlerStack::create($handler)
        ]);

        $postmon = new Postmon($client);

        $postmon->findAddressByCep(Cep::fromString('99999999'));
    }

    /**
     * @test
     */
    public function findAddressByCep()
    {
        $handler = new MockHandler([
            new Response(200, [], json_encode([
                'bairro'      => 'Cidade Salvador',
                'cidade'      => 'Jacareí',
                'estado_info' => [
                    'nome' => 'São Paulo'
                ],
                'logradouro'  => 'Rua Mabito Shoji',
                'complemento' => null
            ]))
        ]);

        $client = new Client([
            'handler' => HandlerStack::create($handler)
        ]);

        $postmon = new Postmon($client);

        $address = $postmon->findAddressByCep(Cep::fromString('12312300'));

        $this->assertInstanceOf(PartialAddress::class, $address);
    }
}
