<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Constants\TransactionType;

class SaleRequest extends Request
{
    public function __construct()
    {
        $this->setTransactionType(TransactionType::SALE);
    }
}
