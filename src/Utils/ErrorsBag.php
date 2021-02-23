<?php

namespace Howkins\Borica\Utils;

class ErrorsBag extends ParameterBag
{
    
    public function flush()
    {
        $this->replace();
    }

    public function hasErrors()
    {
        return !!$this->count();
    }
}
