<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\News;
use App\Category;
use Carbon\Carbon;


class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $news;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(News $news, $user_id)
    {
        // $this->news = $news->where('created_at', '>', Carbon::now()->subHour(10))->get();

        $category = Category::where('user_id', $user_id)->get(['id'])->toArray();
        $this->news = $news->whereIn('category_id', $category)->orderBy('opening_date', 'DESC')->take(20)->get();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('最新のニュースのお知らせ')
                    ->view('email.batch_mail');
    }
}
