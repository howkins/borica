<?php

namespace Howkins\Borica\Utils;

use \DateTimeZone as DTZ;

class DateTimeZone extends DTZ
{
    public function getOffset(\DateTimeInterface $datetime)
    {
        $offset = parent::getOffset($datetime);
        $offsetInHours = $offset / 60 / 60;
        $sign = '+';

        if (max($offsetInHours, 0) != $offsetInHours) {
            $sign = '-';
        }

        return $sign . '' . str_pad(abs($offsetInHours), 2, '0', STR_PAD_LEFT);
    }
}
