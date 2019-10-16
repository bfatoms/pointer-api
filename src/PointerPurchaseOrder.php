<?php

namespace BfAtoms\Pointer;


use BfAtoms\Pointer\PointerApi;

class PointerPurchaseOrder extends PointerApi
{
    protected $route = 'api/v2/integration/purchase-orders';


    public function __construct()
    {
        parent::__construct();
    }
}
