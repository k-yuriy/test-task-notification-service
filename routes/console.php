<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('notifications:dispatch-status-checks')
    ->everyMinute()
    ->withoutOverlapping();
