<?php

namespace CotaPreco\Postmon;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class PartialAddress implements \JsonSerializable
{
    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string|null
     */
    private $neighborhood;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $complement;

    /**
     * @param string      $state
     * @param string      $city
     * @param string|null $street
     * @param string|null $neighborhood
     * @param string|null $complement
     */
    public function __construct(
        $state,
        $city,
        $neighborhood = null,
        $street = null,
        $complement = null
    ) {
        $this->state        = (string) $state;
        $this->city         = (string) $city;
        $this->neighborhood = $neighborhood;
        $this->street       = $street;
        $this->complement   = $complement;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @return \string[]
     */
    public function jsonSerialize()
    {
        return array_filter([
            'state' => $this->state,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
            'street' => $this->street,
            'complement' => $this->complement
        ]);
    }
}
