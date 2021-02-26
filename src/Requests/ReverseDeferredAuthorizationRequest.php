<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Constants\TransactionType;

class ReverseDeferredAuthorizationRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setTransactionType(TransactionType::REVERSE_DEFERRED_AUTHORIZATION);
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
            'RRN',
            'INT_REF',
            'NONCE',
            'P_SIGN'
        ] as $property) {
            if ($this->parameters->get($property) === null || mb_strlen($this->parameters->get($property)) === 0) {
                $this->errors->set($property, 'The attribute is \'' . $property . '\' required.');
            }
        }

        return !$this->errors->hasErrors();
    }
}
