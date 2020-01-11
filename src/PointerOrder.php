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
    
    public function pay($id, $amount, $reference = null)
    {
        $url = $this->makeRoute($id)."/pay";
        return $this->post($url, ['amount' => $amount,'reference' => $reference], $this->getDigest());
    }
}
