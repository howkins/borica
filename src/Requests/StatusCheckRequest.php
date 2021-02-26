<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Constants\TransactionType;

class StatusCheckRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->setTransactionType(TransactionType::STATUS_CHECK);
    }

    public function validate()
    {
        $this->errors->flush();

        foreach ([
            'TERMINAL',
            'TRTYPE',
            'ORDER',
            'TRAN_TRTPE',
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
