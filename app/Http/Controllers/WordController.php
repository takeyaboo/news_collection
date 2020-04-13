<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\News;
use App\Word;
use DateTime;
use My_func;
use Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('word.index');
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

    //1時間に1回バッチでこの処理することにしたから要らないけどデバック用で残す
    public function store(Request $request)
    {
      $id = $request->category_id;
      $newsdata = News::where('flg', 0)->where('category_id', $id);
      $newses = $newsdata->get();

      foreach ($newses as $news) {
        if($news->flg == 0){
        //   //ニュース本文に他の登録してるワードがあったら抽出し保存
          // My_func::get_word($id, $news->content);
          //ニュースタイトルに他の登録してるワードがあったら抽出し保存
          My_func::get_word_test($id, $news->title);
        }
      }

      $newsdata->update(['flg' => 1]);

      return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $words = Word::where('category_id', $id)->orderBy('appear_num', 'desc')->get();
        $category = Category::find($id);

        $params = [
          'words' => $words,
          'category' => $category->category_name,
          'category_id' => $category->id,
        ];

        return view('word.word_list', $params);
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
        //
    }
}
