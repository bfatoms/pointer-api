<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerSupplier extends PointerApi
{
    protected $route = '/api/v2/integration/contacts';

    public function __construct()
    {
        parent::__construct();
    }

}
