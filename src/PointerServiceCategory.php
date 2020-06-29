<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerServiceCategory extends PointerApi
{
    protected $route = '/api/v2/integration/categories';

    public function __construct()
    {
        parent::__construct();
    }
}
