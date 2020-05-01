<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\News;
use My_func;

class test2Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:testcommand2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
      $hoge = My_func::deviation_calc1();
      $news = News::all();
      foreach ($news as $v) {
        $score = My_func::deviation_calc2($v->rel_word, $hoge['avg'], $hoge['variance']);
        $v->relativity = My_func::get_relativity($score);
        $v->save();
      }
    }
}
