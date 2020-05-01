<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\News;
use App\Word;
use DateTime;
use My_func;
use Auth;
use App\Batch;


class NewsController extends Controller
{
  private $category;
  private $word;
  private $user_id;
  private $news;


  public function index()
  {
    return view('news.index');
  }

  public function news_vue($id, $news_id = '') {

    $this->category_data = new Category();
    $this->word = new Word();
    $this->user_id = Auth::id();
    $this->news = new News();
    $category_id = Category::where('user_id', $this->user_id)->get(['id'])->toArray();


    if($id == 1){
      //お気に入りワード別
      $data = $this->category_data->where('user_id', $this->user_id)->get();
    }elseif ($id == 2) {
      //ニュース一覧
      $data = \DB::table('newses')
            ->whereIn('category_id', $category_id)
            ->get();
    }elseif ($id == 3) {
      // 仮
    }elseif ($id == 4) {
      //集計履歴
      $data = Batch::where('user_id', $this->user_id)->orderBy('created_at', 'desc')->get();
    }

    return $data;

  }

  public function news_evaluate($news_id, $value)
  {
    $this->news = new News();
    $target = $this->news->where('id', $news_id)->first();
    $target->evaluation = $value;
    $target->save();
    return $value;

  }

}
