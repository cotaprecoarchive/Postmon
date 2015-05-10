<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @coversDefaultClass CotaPreco\Postmon\PartialAddress
 * @covers ::__construct
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
        $address = new PartialAddress(
            'Estado dos bobos',
            'Cidade dos bobos',
            'Bairro dos bobos',
            'Rua dos bobos',
            'Complemento dos bobos'
        );

        $this->address = $address;
    }

    /**
     * @test
     * @covers ::getState
     */
    public function getState()
    {
        $this->assertNotNull($this->address->getState());
    }

    /**
     * @test
     * @covers ::getCity
     */
    public function getCity()
    {
        $this->assertNotNull($this->address->getCity());
    }

    /**
     * @test
     * @covers ::getNeighborhood
     */
    public function getNeighborhood()
    {
        $this->assertNotNull($this->address->getNeighborhood());
    }

    /**
     * @test
     * @covers ::getStreet
     */
    public function getStreet()
    {
        $this->assertNotNull($this->address->getStreet());
    }

    /**
     * @test
     * @covers ::getComplement
     */
    public function getComplement()
    {
        $this->assertNotNull($this->address->getComplement());
    }

    /**
     * @test
     * @covers ::jsonSerialize
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

        /* @var \string[] $jsonSerializedPartialAddress */
        $jsonSerializedPartialAddress = $this->address->jsonSerialize();

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey($expectedKey, $jsonSerializedPartialAddress);
        }
    }

    /**
     * @test
     * @covers ::jsonSerialize
     */
    public function jsonSerializeOmitsNullKeys()
    {
        $address = new PartialAddress(
            'Estado dos bobos',
            'Cidade dos bobos'
        );

        /* @var \string[] $jsonSerializedPartialAddress */
        $jsonSerializedPartialAddress = $address->jsonSerialize();

        $this->assertArrayHasKey('city', $jsonSerializedPartialAddress);
        $this->assertArrayHasKey('state', $jsonSerializedPartialAddress);

        $this->assertArrayNotHasKey('street', $jsonSerializedPartialAddress);
        $this->assertArrayNotHasKey('complement', $jsonSerializedPartialAddress);
        $this->assertArrayNotHasKey('neighborhood', $jsonSerializedPartialAddress);
    }
}
