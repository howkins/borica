<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Constants\TransactionType;

class SaleRequest extends Request
{
    public function __construct()
    {
        $this->setTransactionType(TransactionType::SALE);
    }

    public function validate()
    {
        $this->errors->flush();

        foreach ([
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'DESC',
            'MERCHANT',
            'MERCH_NAME',
            // 'MERCH_URL', // OPTIONAL
            // 'EMAIL', // OPTIONAL
            'COUNTRY',
            'MERCH_GMT',
            // 'LANG', // OPTIONAL
            'ADDENDUM',
            'AD.CUST_BOR_ORDER_ID',
            'TIMESTAMP',
            'NONCE',
            'P_SIGN'
        ] as $property) {
            if ($this->$property === null || mb_strlen($this->$property) === 0) {
                $this->errors->set($property, 'The attribute is \'' . $property . '\' required.');
            }
        }

        return !$this->errors->hasErrors();
    }
}
