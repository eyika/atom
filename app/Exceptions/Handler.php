<?php

namespace App\Exceptions;

use Eyika\Atom\Framework\Exceptions\NotImplementedException;

class Exception
{
    public function render ()
    {
        throw new NotImplementedException("Feature is not yet implemented", 1);
    }
}