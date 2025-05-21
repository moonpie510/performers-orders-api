<?php
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('worker.{workerId}', function ($worker, int $workerId) {
    return $worker->id === $workerId;
}, ['guards' => ['worker']]);
