<?php

namespace CotaPreco\Postmon;

use CotaPreco\Postmon\Exception\CepNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Subscriber\Mock;
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

        $client = new Client();

        $client->getEmitter()->attach(new Mock([
            new Response(404)
        ]));

        $postmon = new Postmon($client);

        $postmon->findAddressByCep(Cep::fromString('99999999'));
    }

    /**
     * @test
     */
    public function findAddressByCep()
    {
        $client = new Client();

        $client->getEmitter()->attach(new Mock([
            new Response(200, [], Stream::factory(
                json_encode([
                    'bairro'      => 'Cidade Salvador',
                    'cidade'      => 'Jacareí',
                    'estado_info' => [
                        'nome' => 'São Paulo'
                    ],
                    'logradouro'  => 'Rua Mabito Shoji',
                    'complemento' => null
                ])
            ))
        ]));

        $postmon = new Postmon($client);

        $address = $postmon->findAddressByCep(Cep::fromString('12312300'));

        $this->assertInstanceOf(PartialAddress::class, $address);
    }
}
