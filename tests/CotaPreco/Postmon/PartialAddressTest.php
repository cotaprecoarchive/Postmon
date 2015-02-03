<?php

namespace CotaPreco\Postmon;

use PHPUnit_Framework_TestCase as TestCase;
use JsonSerializable;

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

        $this->assertInstanceOf(PartialAddress::class, $address);
        $this->address = $address;
    }

    /**
     * @covers ::getState
     */
    public function testGetStateReturnsState()
    {
        $this->assertNotNull($this->address->getState());
    }

    /**
     * @covers ::getCity
     */
    public function testGetCity()
    {
        $this->assertNotNull($this->address->getCity());
    }

    /**
     * @covers ::getNeighborhood
     * @covers ::getStreet
     */
    public function testGetNeighborhoodAndStreet()
    {
        $this->assertNotNull($this->address->getNeighborhood());
        $this->assertNotNull($this->address->getStreet());
    }

    /**
     * @covers ::getComplement
     */
    public function testGetComplement()
    {
        $this->assertNotNull($this->address->getComplement());
    }

    /**
     * @covers ::jsonSerialize
     */
    public function testPartialAddressCanBeSerializedToJson()
    {
        $this->assertInstanceOf(
            JsonSerializable::class,
            $this->address
        );

        $expectedKeys = [
            'neighborhood',
            'city',
            'state',
            'street',
            'complement'
        ];

        /* @var string[] $serializedPartialAddress */
        $serializedPartialAddress = $this->address->jsonSerialize();

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $serializedPartialAddress
            );
        }
    }

    /**
     * @covers ::jsonSerialize
     */
    public function testJsonSerializedPartialAddressOmitsNullKeys()
    {
        $address = new PartialAddress(
            'Estado dos bobos',
            'Cidade dos bobos'
        );

        /* @var string[] $serializedPartialAddress */
        $serializedPartialAddress = $address->jsonSerialize();

        $this->assertArrayHasKey('city', $serializedPartialAddress);
        $this->assertArrayHasKey('state', $serializedPartialAddress);
        $this->assertArrayNotHasKey('street', $serializedPartialAddress);
        $this->assertArrayNotHasKey('complement', $serializedPartialAddress);
        $this->assertArrayNotHasKey('neighborhood', $serializedPartialAddress);
    }
}
