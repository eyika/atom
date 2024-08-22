<?php

namespace App\Models;

use Eyika\Atom\Framework\Support\Database\Contracts\UserModelInterface;
use Eyika\Atom\Framework\Support\Database\Model as DatabaseModel;

abstract class Model extends DatabaseModel
{
    /**
     * Create a new model instance.
     *
     * @param array  $values
     * @param self|UserModelInterface $child
     * @return void
     */
    public function __construct(array $values = [], $child = null)
    {
        parent::__construct($values, $child);
    }
}
