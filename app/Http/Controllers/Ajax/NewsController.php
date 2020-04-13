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


  public function index(){
    return view('news.index');
  }

  public function news_vue($id) {

    $this->category_data = new Category();
    $this->word = new Word();
    $this->user_id = Auth::id();
    $this->news = new News();


    if($id == 1){
      //お気に入りワード別
      $data = $this->category_data->where('user_id', $this->user_id)->get();
    }elseif ($id == 2) {
      //ニュース一覧
      $data = \DB::table('newses')
            ->select()
            ->leftJoin('categories', 'newses.category_id', '=', 'categories.id')
            ->get();
      // $data = $this->word->where('user_id', $this->user_id)->get();
    }elseif ($id == 3) {
      // 仮
    }elseif ($id == 4) {
      //集計履歴
      $data = Batch::orderBy('created_at', 'desc')->get();
    }

    // $news_num = array();
    // foreach ($categories as $category) {
    //   array_push($news_num, $news->where('category_id', $category->id)->count());
    // }

      // $categories = Category::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

    return $data;

  }

}
