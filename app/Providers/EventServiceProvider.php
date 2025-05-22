<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Listeners\SendPostCreatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Các sự kiện và listener của ứng dụng.
     *
     * @var array
     */
    protected $listen = [
        // Đăng ký sự kiện và listener
        PostCreated::class => [
            SendPostCreatedNotification::class,
        ],
    ];

    /**
     * Đăng ký bất kỳ sự kiện nào của ứng dụng.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}