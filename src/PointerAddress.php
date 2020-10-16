<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerAddress extends PointerApi
{
    protected $route = '/api/v2/integration/addresses';

    public function __construct()
    {
        parent::__construct();
    }
}
