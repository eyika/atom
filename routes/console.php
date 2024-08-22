<?php

use Eyika\Atom\Framework\Foundation\Console\Artisan;
use Eyika\Atom\Framework\Support\Inspiring;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
