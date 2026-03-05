<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('bookings:check-status')->daily();