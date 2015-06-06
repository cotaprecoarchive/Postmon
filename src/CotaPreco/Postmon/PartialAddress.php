<?php

/*
 * Copyright (c) 2015 Cota Preço
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

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
