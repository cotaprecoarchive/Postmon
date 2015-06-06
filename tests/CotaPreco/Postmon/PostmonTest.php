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
 * @coversDefaultClass CotaPreco\Postmon\Postmon
 * @covers ::__construct
 * @covers ::<!public>
 */
class PostmonTest extends TestCase
{
    /**
     * @test
     * @covers ::findAddressByCep
     */
    public function throwsCepNotFoundException()
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
     * @covers ::findAddressByCep
     */
    public function returnsPartialAddress()
    {
        $client = new Client();

        $client->getEmitter()->attach(new Mock([
            new Response(200, [], Stream::factory(
                json_encode([
                    'bairro'      => 'Cidade Salvador',
                    'cidade'      => 'Jacareí',
                    'estado_info' => ['nome' => 'São Paulo'],
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
