<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('sirdo:info', function () {
    $this->info('SIRDO Laravel siap digunakan.');
});
