<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;
use GuzzleHttp\Client          as GuzzleHttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Subscriber\Mock as GuzzleMockSubscriber;
use GuzzleHttp\Stream\Stream   as GuzzleStream;
use GuzzleHttp\Message\Response;
use CotaPreco\Postmon\Exception\CepNotFoundException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @coversDefaultClass CotaPreco\Postmon\Postmon
 * @covers ::__construct
 * @covers ::<!public>
 */
class PostmonTest extends TestCase
{
    public function testCreatePostmonClient()
    {
        $this->assertInstanceOf(
            Postmon::class,
            new Postmon($this->getMock(HttpClientInterface::class))
        );
    }

    /**
     * @covers ::findAddressByCep
     */
    public function testFindAddressByCepThrowsCepNotFoundException()
    {
        $this->setExpectedException(CepNotFoundException::class);

        $client = new GuzzleHttpClient();
        $client->getEmitter()->attach(new GuzzleMockSubscriber([
            new Response(404)
        ]));

        $postmon = new Postmon($client);
        $postmon->findAddressByCep(new Cep('99999999'));
    }

    /**
     * @covers ::findAddressByCep
     */
    public function testFindAddressByCepReturnsPartialAddress()
    {
        $client = new GuzzleHttpClient();
        $client->getEmitter()->attach(new GuzzleMockSubscriber([
            new Response(200, [], GuzzleStream::factory(
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
        $address = $postmon->findAddressByCep(new Cep('12312300'));

        $this->assertInstanceOf(
            PartialAddress::class,
            $address
        );
    }
}
