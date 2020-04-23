<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\News;
use Carbon\Carbon;

class TopController extends Controller
{
  public function graph($id)
  {
    $category_data = new Category();
    $news_data = new News();
    $user_id = Auth::id();
    $category_id = Category::where('user_id', $user_id)->get(['id'])->toArray();

    if($id == 1){
      $category = $category_data->where('user_id', $user_id)->orderBy('news_store_num', 'DESC')->take(6)->get();
    }elseif($id == 2){
      //一括保存コード（開発用）
      // $news_num = array();
      // $categories = $category_data->where('user_id', $user_id)->get();
      // foreach ($categories as $category) {
      //   $news_num = $news_data->where('category_id', $category->id)->count();
      //   $category->news_store_num = $news_num;
      //   $category->save();
      // }

      $category = $category_data->where('user_id', $user_id)->orderBy('rel_word_num', 'DESC')->take(6)->get();

    }elseif ($id == 3) {

      $category = \DB::table('newses')
      ->select(\DB::raw('count(*) as news_count, category_id'))
      ->whereDate('created_at', '=', Carbon::today())
      ->whereIn('category_id', $category_id)
      ->groupBy('category_id')
      ->orderBy('news_count', 'DESC')
      ->take(6)
      ->get();

      foreach ($category as $v) {
        $name = $category_data->where('id', $v->category_id)->first();
        $v->category_id = $name->category_name;
      }

    }

    return $category;
  }
}
