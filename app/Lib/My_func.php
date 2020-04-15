<?php

namespace App\Lib;

use Auth;
use App\Category;
use App\News;
use App\Word;

class My_func
{
  public static function get_news($id, $request = "")
  {
    //---- キーワード検索したいときのベースURL
    $API_BASE_URL = "https://news.google.com/news?hl=ja&ned=ja&ie=UTF-8&oe=UTF-8&output=atom&q=";

    //----　キーワードの文字コード変更
    //登録カテゴリーから飛んできた時
    if(!empty($id)){
      $category = Category::find($id);
      $keyword = $category->category_name;
    }else{
      //キーワードを入力し検索した時
      $keyword = $request->keyword;
    }

    $query = urlencode(mb_convert_encoding($keyword,"UTF-8", "auto"));

    //---- APIへのリクエストURL生成
    $api_url = $API_BASE_URL.$query;

    //---- APIにアクセス、結果をsimplexmlに格納
    $contents = file_get_contents($api_url);
    $xml = simplexml_load_string($contents);

    //記事エントリを取り出す
    $data = $xml->entry;

    $params = array($data, $keyword);

    return $params;

  }

  //2020/04/10
  //本文から関連ワードを抽出するメソッドだが重すげてPCが爆発しそうなので
  //解決策が思いつくまで代わりに下のget_test_word使う
  public static function get_word($id, $data){
    //$id カテゴリーを登録するときに使う

    //登録キーワードをループ
    $categories = Category::where('user_id', Auth::id())->get();

    $word_data = new Word();

    //対象のキーワードに関連するワードが登録されていれば取得し$words_listに格納する。
    $words = $word_data->where('user_id', Auth::id())->where('category_id', $id)->get();

    $word_list = array();
    if(!empty($words)){
      foreach ($words as $word) {
        //$wordを配列に格納
        array_push($word_list, $word->word);
      }
    }


    foreach ($categories as $category) {
      preg_match("/<a[^>]+href=[\"']?([-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)[\"']?([^>]*)>/", $data, $match);
      if($file = My_func::curl_get_contents($match[1])){
        $content = $file;
      }else{
        $content = 'null';
      }
      //本文に一致するキーワードが存在するかチェック
      //かつその記事のキーワードは除外
      if(strpos($content, $category->category_name) !== false && $category->id != $id){
        if(in_array($category->category_name, $word_list)){
          //2回目以降の場合は一致回数カラムを＋１アップデート
          $word_target = $word_data->where('category_id', $id)->where('word', $category->category_name)->first();
          $word_target->appear_num += 1;
          $word_target->save();

        }else{
        //そのカテゴリーに置いて初めて一致したワードだった場合は挿入
          $word_data->create([
            'word' => $category->category_name,
            'category_id' => $id,
            'user_id' => Auth::id(),
          ]);
        }
      }
    }
  }

  //curl使う時用
  public static function curl_get_contents($url, $timeout = 2 ){
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_HEADER, false );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
  }

  //タイトルから関連ワードを抽出(get_wordが解決するまでこれ使う)
  public static function get_word_test($id, $data){
    //$id カテゴリーを登録するときに使う

    //ユーザーIDを取得
    $user = Category::where('id', $id)->first();
    $user_id = $user->user_id;

    //登録キーワードをループ

    $categories = Category::where('user_id', $user_id)->get();

    $word_data = new Word();

    //対象のキーワードに関連するワードが登録されていれば取得し$words_listに格納する。
    // $words = $word_data->where('user_id', Auth::id())->where('category_id', $id)->get();
    $words = $word_data->where('category_id', $id)->get();


    $word_list = array();
    if(!empty($words)){
      foreach ($words as $word) {
        //$wordを配列に格納
        array_push($word_list, $word->word);
      }
    }

    $num = 0;
    foreach ($categories as $category) {
      //本文に一致するキーワードが存在するかチェック
      //かつその記事のキーワードは除外
      if(strpos($data, $category->category_name) !== false && $category->id != $id){
        if(in_array($category->category_name, $word_list)){
          //2回目以降の場合は一致回数カラムを＋１アップデート
          $word_target = $word_data->where('category_id', $id)->where('word', $category->category_name)->first();
          $word_target->appear_num += 1;
          $word_target->save();
          $num++;
        }else{
        //そのカテゴリーに置いて初めて一致したワードだった場合は挿入
          $word_data->create([
            'word' => $category->category_name,
            'category_id' => $id,
            'user_id' => $user_id,
          ]);
          $num++;
        }
      }
    }
    return $num;
  }

}
