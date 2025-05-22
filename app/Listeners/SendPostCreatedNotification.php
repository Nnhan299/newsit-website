<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreatedMail;
use Illuminate\Queue\InteractsWithQueue;

class SendPostCreatedNotification
{
    /**
     * Xử lý sự kiện.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        // Lấy bài viết từ sự kiện
        $post = $event->post;

        // Gửi email thông báo khi bài viết được tạo
        Mail::to('admin@example.com')->send(new PostCreatedMail($post));
    }
}