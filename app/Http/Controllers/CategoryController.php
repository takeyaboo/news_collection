<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\News;
use App\Word;
use My_func;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $news;
     private $category;
     private $word;

    public function __construct(News $news, Category $category, Word $word)
    {
       $this->news = $news;
       $this->category = $category;
       $this->word = $word;
    }

    public function index()
    {
      $user_id = Auth::id();
      $categories = $this->category->where('user_id', $user_id)->get();
      // $news = new News();

      $news_num = array();
      foreach ($categories as $category) {
        array_push($news_num, $this->news->where('category_id', $category->id)->count());
      }
      return view('category.index', [
          'categories' => $categories,
          'user_id'    => $user_id,
          'news_num'   => $news_num,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //15個以上だったらリダイレクト
        if(15 <= $this->category->where('user_id', $request->user_id)->count()){
          \Session::flash('error_message', '15個までしか登録できません。');
          return redirect('/category');
        //登録済みだったらリダイレクト
        }elseif($this->category->where('category_name', $request->category_name)->where('user_id', $request->user_id)->exists()){
          \Session::flash('error_message', '「'.$request->category_name.'」は登録済みです。');
          return redirect('/category');
        }else{
          // $category = new Category();
          $this->category->create([
            'category_name' => $request->category_name,
            'user_id' => $request->user_id,
          ]);

          //APIでニュースを取得を取得し保存するバッチ

          $new_category = $this->category->where('user_id', $request->user_id)->where('category_name', $request->category_name)->first();
          $api_data = My_func::get_news($new_category->id);
          $data = $api_data[0];
          $keyword = $api_data[1];

          for ($i = 0; $i < count($data); $i++) {
            $list[$i]['time'] = str_replace('T', ' ', substr($data[$i]->updated, 0, strcspn($data[$i]->updated,'.')));
            $list[$i]['news_id'] = $data[$i]->id;
            $list[$i]['title'] = mb_convert_encoding($data[$i]->title ,"UTF-8", "auto");
            $url_split =  explode("=", (string)$data[$i]->link->attributes()->href);
            $list[$i]['url'] = end($url_split);
            $list[$i]['content'] = $data[$i]->content;


            //ニュースを保存
            $this->news->create([
              'news_id' => $list[$i]['news_id'],
              'category_id' => $new_category->id,
              'title' => $list[$i]['title'],
              'link' => $list[$i]['url'],
              'opening_date' => $list[$i]['time'],
              'content' => $list[$i]['content'],
            ]);
          }

          $calc_data = My_func::deviation_calc1();
          $new_newses = News::where('flg', 0)->where('category_id', $new_category->id)->get();

          $num = 0; //カテゴリーごとのワードの総数を更新
          foreach ($new_newses as $new_news) {
            if($new_news->flg == 0){
              $ret_num = My_func::get_word_test($new_category->id, $new_news->title);
              $num += $ret_num;

              $result = My_func::deviation_calc2($ret_num, $calc_data['avg'], $calc_data['variance']);
              $new_news->relativity = My_func::get_relativity($result);
              $new_news->flg = 1;
              $new_news->save();
            }
          }

          $new_category->rel_word_num += $num;
          $new_category->news_store_num = count($data);
          $new_category->save();

          \Session::flash('message', '「'.$request->category_name.'」を登録しました。');
          return redirect('/category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // $user_id = Auth::id();
      // $categories = Category::where('user_id', $user_id)->get();
      // $news = new News();
      //
      // $news_num = array();
      // foreach ($categories as $category) {
      //   array_push($news_num, $news->where('category_id', $category->id)->count());
      // }
      //
      // return view('category.index', [
      //     'categories' => $categories,
      //     'user_id'    => $user_id,
      // ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //カテゴリーを削除
      $category = $this->category->find($id);
      $category_name = $category->category_name; //あとで使うため取得してから削除
      $category->delete();

      //カテゴリーに関連するニュースを削除
      $this->news->where('category_id', $id)->delete();

      //カテゴリーに関連する関連ワードを削除
      $this->word->where('category_id', $id)->delete();

      //他のカテゴリーの関連対象からも削除
      $this->word->where('word', $category_name)->delete();



      return redirect('/category');

    }
}
