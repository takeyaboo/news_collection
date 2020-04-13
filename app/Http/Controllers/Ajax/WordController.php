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

class WordController extends Controller
{
  private $my_func;
  private $news;
  private $category_data;
  private $word;
  private $user_id;

  public function index(){
    return view('word.index');
  }

  public function word_vue($id) {

    $this->category_data = new Category();
    $this->word = new Word();
    $this->user_id = Auth::id();


    if($id == 1){
      $data = $this->category_data->where('user_id', $this->user_id)->orderBy('rel_word_num', 'desc')->get();
    }elseif ($id == 2) {
      //ワード一覧
      $data = $this->word->where('user_id', $this->user_id)->orderBy('appear_num', 'desc')->get();

    }elseif ($id == 3) {
      //(テスト)
      $data = $this->category_data->where('user_id', $this->user_id)->orderBy('rel_word_num', 'asc')->get();
    }elseif ($id == 4) {
      //バッチログ表示
      $data = Batch::orderBy('created_at', 'desc')->get();


      //下のは却下
      // $this->update_word_num();
      // $data = $this->category_data->where('user_id', $this->user_id)->orderBy('rel_word_num', 'desc')->get();
    }


    return $data;

  }

  // public function update_word_num(){
  //   $categories = $this->category_data->where('user_id', $this->user_id)->get();
  //   $words = $this->word->where('user_id', $this->user_id)->get();
  //
  //   foreach ($categories as $category) {
  //     //加算する値を初期化
  //     $i = 0;
  //     foreach ($words as $word) {
  //       // 関連ワードをループしカテゴリーIDと一致したら
  //       // その関連ワードの出現回数を$iに加算する。
  //       if($word->category_id == $category->id){
  //         $i += $word->appear_num;
  //       }
  //     }
  //     // 対象カテゴリーの総関連ワード数に$iを加算しアップデート
  //     $category->rel_word_num = $i;
  //     $category->save();
  //   }
  // }
}
