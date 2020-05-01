<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConfigRequest;
use App\Category;
use App\News;
use App\Batch;
use DateTime;
use My_func;
use Mail;
use Carbon\Carbon;
use Auth;
use App\Config;

class SettingController extends Controller
{
  private $config;

  public function __construct(Config $config)
  {
    $this->config = $config;
  }

  public function index(){
    $user_id = Auth::id();
    // $user_data = Auth::user();

    if($this->config->where('user_id', $user_id)->exists()){
      //既に登録されている場合
      $user_data = $this->config->where('user_id', $user_id)->first();

    }else{
      //初回の場合
      // $address = "";
      $user_data = "";
    }

    $param = [
      'user_id' => $user_id,
      'user_data' => $user_data,

    ];

    return view('setting', $param);
  }

  public function set(ConfigRequest $request){
    $user_id = Auth::id();
    $config = new Config();

    if($this->config->where('user_id', $user_id)->exists()){
      $user_data = $config->where('user_id', $user_id)->first();
      $user_data->mail_flg = $request->mail;
      $user_data->mail_address = $request->address;
      $user_data->batch_flg = $request->batch;
      $user_data->graph_flg = $request->graph;
      $user_data->save();
    }else{
      //設定が初めての場合
        $config->create([
          'user_id' => $user_id,
          'mail_flg' => $request->mail,
          'mail_address' => $request->address,
          'batch_flg' => $request->batch,
          'graph_flg' => $request->graph,
        ]);


    }

    return redirect('/setting');
  }
}
