<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerProject extends PointerApi
{
    protected $route = 'api/v2/integration/projects';

    public function __construct()
    {
        parent::__construct();
    }

}
