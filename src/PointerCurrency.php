<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerCurrency extends PointerApi
{
    protected $route = '/api/v2/integration/currencies';

    public function __construct()
    {
        parent::__construct();
    }
}
