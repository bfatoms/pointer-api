<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerContact extends PointerApi
{
    protected $route = '/api/v2/integration/contacts';

    public function __construct()
    {
        parent::__construct();
    }
}
