<?php

namespace BfAtoms\Pointer;


use BfAtoms\Pointer\PointerApi;


class PointerOrder extends PointerApi
{
    protected $route = 'api/v2/integration/orders';

    public function __construct()
    {
        parent::__construct();
    }
}
