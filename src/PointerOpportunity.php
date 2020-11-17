<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerOpportunity extends PointerApi
{
    protected $route = '/api/v2/integration/opportunities';

    public function __construct()
    {
        parent::__construct();
    }
}
