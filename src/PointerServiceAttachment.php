<?php

namespace BfAtoms\Pointer;

use BfAtoms\Pointer\PointerApi;

class PointerServiceAttachment extends PointerApi
{
    protected $route = '/api/v2/integration/service-attachments';

    public function __construct()
    {
        parent::__construct();
    }
}
