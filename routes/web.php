<?php

use App\Events\OrderStatusUpdatedEvent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    request()->headers->set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTY1NGY5NzM1MGUwYjBhZDJlNjRiMDMyNjQ5MGIwODIzMTI2NzU5NzdhYmRhZGJhNjkxOGI1YTlmOWU1ODZiZWNmZWEyZDcxYzdjMmJjOWYiLCJpYXQiOjE3NDc2MDQ3NTEuMDcyOTA1LCJuYmYiOjE3NDc2MDQ3NTEuMDcyOTA4LCJleHAiOjE3NzkxNDA3NTEuMDY0OTY3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.0zIoaYTLZL7GBhoOPEjYu5500cIkWJSZCyWMxt_tant9nJdb2KVDRUAYnTvOwvdC0KPy6_LQ7lCN3OZ_BA99WTxtHDhCjTIKAi6DgXBIwILjkZB3hwiupmqDntb8yudTqz5pPAlIkJZYkBkZlEteCNTmAm9pGh0hPv7u6d6j0LoXbG4tKsc8LRKzMK5jWzfpkOl84wPaDbi5_fYg-j_4XwVPKtkWK90F0z4i4wI73RZNFFQI8Ijeg3evbqcUBLebNHPXpTt-NogQ_9ad7x0R1nhSzI1YnyBef0YzcnCSJLq2386-7maNa9g_xN6iIvlemIVd1-LgjQjNQe3MR0Uigce47Dq-1n_Rg1v6xo6Gb1KQx9hrDRgvO-neTipsEF4cyXaI5K88SwzKCfSzvOPUf8ayEeopR6VeiomnrCPLAJwH-geCvQf8Y2sSED02F6mZjsE5INV8DKWLHqJ8kpXuiSNvKBFyNe7mtJmw5FLAuEvTAgiBNNHgqWGXfBbbzAc8iueyyGVOYe7zT5_g1qTZ_Iw-Q97DWcGoblYSDIhuolYIOnpA2MAWd_LOr-l2Wv1-Ade5THstPeOtMT2Bjnx_maNUWB4AgwRFHH96GPAg4ARxeAvEk2jaMxc5aE6sbclPxJOyLXQUogc2KN8ZeXdCeg10Djznq6RbdjFiCm9aJCc');
//    \App\Events\OrderStatusUpdatedEvent::dispatch(\App\Models\Order::first(), 'Завершен');
    broadcast(new \App\Events\PrivateEvent(1));
//    broadcast(new \App\Events\TestEvent('darova'));
//    dd(auth('worker')->user());
});

Route::get('/test8', function () {
    dd(111);
});
