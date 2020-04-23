<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Carbon\Carbon;
use DateTime;
use My_func;
use Auth;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  private $my_func;
  private $news;
  private $category;


  public function __construct(My_func $my_func, News $news, Category $category)
  {
    $this->my_func = $my_func;
    $this->news = $news;
    $this->category = $category;
  }


  public function index()
  {
    // $user_id = Auth::id();
    // $categories = Category::where('user_id', $user_id)->get();
    // $news = new News();
    //
    // $news_num = array();
    // foreach ($categories as $category) {
    //   array_push($news_num, $news->where('category_id', $category->id)->count());
    // }
    // return view('news.index', [
    //     'categories' => $categories,
    //     'user_id'    => $user_id,
    //     'news_num'   => $news_num,
    // ]);

    return view('news.index');

  }

  public function search()
  {
    return view('news.news_search');
  }

  public function news_list(Request $request, $id = "")
  {

    set_time_limit(90);

    //APIでニュースを取得
    $api_data = $this->my_func->get_news($id, $request);
    $data = $api_data[0];
    $keyword = $api_data[1];

    //記事のタイトルとURLを取り出して配列に格納
    for ($i = 0; $i < count($data); $i++) {

        $list[$i]['title'] = mb_convert_encoding($data[$i]->title ,"UTF-8", "auto");
        $url_split =  explode("=", (string)$data[$i]->link->attributes()->href);
        $list[$i]['url'] = end($url_split);
        $list[$i]['time'] = str_replace('T', ' ', substr($data[$i]->updated, 0, strcspn($data[$i]->updated,'.')));

    }

    //$max_num以上の記事数の場合は切り捨て
    if(count($list)>10){
        for ($i = 0; $i < 10; $i++){
            $list_gn[$i] = $list[$i];
            // $i++;
        }
    }else{
        $list_gn = $list;
    }

    $params = [
        'category_id' => $id,
        'title' => $keyword,
        'list_gn' => $list_gn,
        'data' => $data,
    ];

    return view('news.news_list', $params);
  }

  public function news_list_store(Request $request)
  {
    $last_update_time = "";
    $id = $request->category_id;

    //APIでニュースを取得
    $api_data = $this->my_func->get_news($id, $request);
    $data = $api_data[0];
    $keyword = $api_data[1];

    //記事のタイトルとURLを取り出して配列に格納
    // $news = new News();
    $date = new DateTime();
    $latest = $this->news->where('category_id', $id)->orderBy('updated_at', 'desc')->first();

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
        $this->news->create([
          'news_id' => $list[$i]['news_id'],
          'category_id' => $id,
          'title' => $list[$i]['title'],
          'link' => $list[$i]['url'],
          'opening_date' => $list[$i]['time'],
          'content' => $list[$i]['content'],
        ]);

      }
    }
    return redirect('/category');
  }

  public function news_list_all($id, $sort = "")
  {

    if(empty($sort)){
      $newses = $this->news->where('category_id', $id)->orderBy('opening_date', 'desc')->paginate(10);
    }elseif($sort == 'asc'){
      $newses = $this->news->where('category_id', $id)->orderBy('opening_date', 'asc')->paginate(10);
    }elseif($sort = 'relativity'){
      $newses = $this->news->where('category_id', $id)->orderBy('relativity', 'desc')->paginate(10);
    }

    $category = $this->category->find($id);

    return view('news.news_list_all', [
        'newses' => $newses,
        'category' => $category->category_name,
        'category_id' => $category->id,
    ]);
  }

  public function news_list_search(Request $request)
  {
    $data = $this->my_func->fuzzy_news_search($request->search_word);
    return view('news.index', ['match' => $data['match'], 'search_word' => $request->search_word, 'count' => $data['count']]);
  }
}
