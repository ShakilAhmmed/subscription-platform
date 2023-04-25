<?php

namespace App\Jobs;

use App\Mail\PostMailToSubscriber;
use App\Models\Post;
use App\Models\User;
use App\Services\SubscriberService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Post $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(SubscriberService $subscriberService): void
    {
        $subscribers = $subscriberService->getAllSubscribers($this->post->website_id);
        $users = User::query()->whereIn('id', $subscribers)->get();
        foreach ($users as $subscriber) {
            Mail::to($subscriber)->send(new PostMailToSubscriber($this->post));
        }
    }
}
