<?php

namespace Howkins\Borica\Constants;
use Howkins\Borica\Constants\TransactionType;

class Mac
{
    const EXTENDED_REQUEST_FIELDS = [
        TransactionType::SALE => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'MERCHANT',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'MERCHANT',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::COMPLETE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'MERCHANT',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::REVERSE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'MERCHANT',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::REVERSAL => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'MERCHANT',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::STATUS_CHECK => [
            'TERMINAL',
            'TRTYPE',
            'ORDER',
            'NONCE'
        ]
    ];

    const COMMON_REQUEST_FIELDS = [
        TransactionType::SALE => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'TIMESTAMP'
        ],
        TransactionType::DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP',
            'DESC'
        ],
        TransactionType::COMPLETE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP',
            'DESC'
        ],
        TransactionType::REVERSE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP',
            'DESC'
        ],
        TransactionType::REVERSAL => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP',
            'DESC'
        ],
        TransactionType::STATUS_CHECK => [
            'TERMINAL',
            'TRTYPE',
            'ORDER'
        ]
    ];

    const EXTENDED_RESPONSE_FIELDS = [
        TransactionType::SALE => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::DEFERRED_AUTHORIZATION => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::COMPLETE_DEFERRED_AUTHORIZATION => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::REVERSE_DEFERRED_AUTHORIZATION => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::REVERSAL => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ],
        TransactionType::STATUS_CHECK => [
            'ACTION',
            'RC',
            'APPROVAL',
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'CURRENCY',
            'ORDER',
            'RRN',
            'INT_REF',
            'PARES_STATUS',
            'ECI',
            'TIMESTAMP',
            'NONCE'
        ]
    ];
    const COMMON_RESPONSE_FIELDS = [
        TransactionType::SALE => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP'
        ],
        TransactionType::DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'ORDER',
            'TIMESTAMP'
        ],
        TransactionType::COMPLETE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'ORDER',
            'TIMESTAMP'
        ],
        TransactionType::REVERSE_DEFERRED_AUTHORIZATION => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'ORDER',
            'TIMESTAMP'
        ],
        TransactionType::REVERSAL => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'ORDER',
            'TIMESTAMP'
        ],
        TransactionType::STATUS_CHECK => [
            'TERMINAL',
            'TRTYPE',
            'AMOUNT',
            'TIMESTAMP'
        ]
    ];

}
