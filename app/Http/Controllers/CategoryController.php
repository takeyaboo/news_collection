<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\News;
use App\Word;

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
        // $category = new Category();
        $this->category->create([
          'category_name' => $request->category_name,
          'user_id' => $request->user_id,
        ]);

        \Session::flash('message', '「'.$request->category_name.'」を登録しました');
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
