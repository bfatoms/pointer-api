<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerNote extends PointerApi
{
    protected $route = '/api/v2/integration/notes';

    public function __construct()
    {
        parent::__construct();
    }
}
