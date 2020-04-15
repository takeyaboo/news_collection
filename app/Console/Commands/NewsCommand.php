<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\News;
use App\Batch;
use DateTime;
use My_func;

class NewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:newscommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ニュースを保存し関連ワードを集計する';

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
      $news = new News();
      $batch_log = new Batch();
      $categories = Category::all();
      $date = new DateTime();

      $last_update_time = "";



      $num = 0;
      $num2 = 0;
      foreach ($categories as $category) {
        //APIでニュースを取得を取得し保存するバッチ

        $api_data = My_func::get_news($category['id']);
        $data = $api_data[0];
        $keyword = $api_data[1];

        //記事のタイトルとURLを取り出して配列に格納

        $latest = $news->where('category_id', $category['id'])->orderBy('updated_at', 'desc')->first();

        if(!empty($latest)){
          $last_update_time = $latest->updated_at;
        }

        for ($i = 0; $i < count($data); $i++) {
          $list[$i]['time'] = str_replace('T', ' ', substr($data[$i]->updated, 0, strcspn($data[$i]->updated,'.')));
          //挿入するカテゴリーのニュースの最終保存日より後に公開されたニュースを挿入
          //そのカテゴリーのニュースが初めて挿入される場合は取得したものを全て挿入
          if($list[$i]['time'] > $last_update_time || empty($last_update_time)){

            $list[$i]['news_id'] = $data[$i]->id;
            $list[$i]['title'] = mb_convert_encoding($data[$i]->title ,"UTF-8", "auto");
            $url_split =  explode("=", (string)$data[$i]->link->attributes()->href);
            $list[$i]['url'] = end($url_split);
            $list[$i]['content'] = $data[$i]->content;


            //ニュースを保存
            $news->create([
              'news_id' => $list[$i]['news_id'],
              'category_id' => $category['id'],
              'title' => $list[$i]['title'],
              'link' => $list[$i]['url'],
              'opening_date' => $list[$i]['time'],
              'content' => $list[$i]['content'],
            ]);

            $num++;
          }
        }

        //ここから各カテゴリーごとのニュースから関連ワードを抽出し登録する
        // $newsdata = $news->where('flg', 0)->where('category_id', $category['id']);
        // $newses = $newsdata->get();
        $newses = News::where('flg', 0)->where('category_id', $category->id)->get();

        $num3 = 0; //カテゴリーごとのワードの総数を更新
        foreach ($newses as $news2) {
          if($news2->flg == 0){

            //4/13 15:12 フラグを認識して通ってることを確認

            //ニュース本文に他の登録してるワードがあったら抽出し保存
            // My_func::get_word($id, $news->content);
            //ニュースタイトルに他の登録してるワードがあったら抽出し保存
            $ret_num = My_func::get_word_test($category->id, $news2->title);
            // My_func::get_word_test($category->id, $news2->title);

            $num2 += $ret_num;
            //wordを追加した分をバッチログのword追加数に使う変数に加算
            $num3 += $ret_num;
            //wordを追加した分をカテゴリーごとのワード総数に使う変数に加算
            // $news2->update(['flg' => 1]);
            $news2->flg = 1;
            $news2->save();
          }
        }

        // $newsdata->update(['flg' => 1]);

        // 対象カテゴリーの総関連ワード数に$iを加算しアップデート
        $category->rel_word_num += $num3;
        $category->save();

      }



      //バッチ実行時に何件ニュースを保存したかログに記録
      $batch_log->create([
        'create_num' => $num,
        'word_create_num' => $num2,
      ]);

    }
}
