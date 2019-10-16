<?php

namespace BfAtoms\Pointer;


use BfAtoms\Pointer\PointerApi;

class PointerProduct extends PointerApi
{
    protected $route = 'api/v2/integration/products';

    public function __construct()
    {
        parent::__construct();
    }
}
