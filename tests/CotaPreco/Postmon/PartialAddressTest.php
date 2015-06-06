<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class PartialAddressTest extends TestCase
{
    /**
     * @var PartialAddress
     */
    private $address;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->address = new PartialAddress(
            'Estado dos bobos',
            'Cidade dos bobos',
            'Bairro dos bobos',
            'Rua dos bobos',
            'Complemento dos bobos'
        );
    }

    /**
     * @test
     */
    public function getState()
    {
        $this->assertEquals('Estado dos bobos', $this->address->getState());
    }

    /**
     * @test
     */
    public function getCity()
    {
        $this->assertEquals('Cidade dos bobos', $this->address->getCity());
    }

    /**
     * @test
     */
    public function getNeighborhood()
    {
        $this->assertEquals('Bairro dos bobos', $this->address->getNeighborhood());
    }

    /**
     * @test
     */
    public function getStreet()
    {
        $this->assertEquals('Rua dos bobos', $this->address->getStreet());
    }

    /**
     * @test
     */
    public function getComplement()
    {
        $this->assertEquals('Complemento dos bobos', $this->address->getComplement());
    }

    /**
     * @test
     */
    public function jsonSerialize()
    {
        $this->assertInstanceOf(\JsonSerializable::class, $this->address);

        $expectedKeys = [
            'neighborhood',
            'city',
            'state',
            'street',
            'complement'
        ];

        /* @var \string[] $jsonSerialized */
        $jsonSerialized = $this->address->jsonSerialize();

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey($expectedKey, $jsonSerialized);
        }
    }

    /**
     * @test
     */
    public function jsonSerializeOmitsNullKeys()
    {
        $address = new PartialAddress(
            'Estado dos bobos',
            'Cidade dos bobos'
        );

        /* @var \string[] $jsonSerialized */
        $jsonSerialized = $address->jsonSerialize();

        $this->assertArrayHasKey('city', $jsonSerialized);
        $this->assertArrayHasKey('state', $jsonSerialized);

        $this->assertArrayNotHasKey('street', $jsonSerialized);
        $this->assertArrayNotHasKey('complement', $jsonSerialized);
        $this->assertArrayNotHasKey('neighborhood', $jsonSerialized);
    }
}
