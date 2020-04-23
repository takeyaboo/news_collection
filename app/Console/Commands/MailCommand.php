<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\News;
use App\Batch;
use DateTime;
use My_func;
use Mail;
use Carbon\Carbon;
use App\Config;
use App\Mail\OrderShipped;

class MailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:mailcommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ニュースのデータをメールで送るバッチ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(News $news)
    {
      $users = Config::where('mail_flg', 1)->get();
      foreach ($users as $user) {
        //メール送信
        // $store_news = $news->where('created_at', '>', Carbon::now()->subHour(1))->get();
        // $store_news = $news->where('category_id', 1)->first();
        // $data = [
        //          'store_news' => $store_news,
        //         ];

        // $address = $user->mail_address;
        // Mail::send('email.batch_mail', $data, function($message){
        //     $message->to($address, 'Test')->subject('最新のニュースのお知らせ');
        // });
        Mail::to($user->mail_address)
            // ->send(new OrderShipped($news, Config::where('user_id', $user->user_id)->first()));
            ->send(new OrderShipped($news, $user->user_id));

      }
    }
}
