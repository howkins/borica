<?php

namespace Howkins\Borica\Constants;

class TransactionType
{
    const SALE = 1;
    const DEFERRED_AUTHORIZATION = 12;
    const COMPLETE_DEFERRED_AUTHORIZATION = 21;
    const REVERSE_DEFERRED_AUTHORIZATION = 22;
    const REVERSAL = 24;
    const STATUS_CHECK = 90;
}
