<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Category;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id = "", News $news)
    {
        switch ($id) {
          case 1:
            $col = 'created_at';
            $sort = 'ASC';
            break;
          // case 2:
          //   $col = 'relativity';
          //   $sort = 'DESC';
          //   break;
          case 3:
            $col = 'evaluation';
            $sort = 'DESC';
            break;
          default:
             $col = 'created_at';
             $sort = 'DESC';
            break;
        }

        $categories = Category::where('user_id', Auth::id())->get();
        $category_id = array();
        foreach ($categories as $category) {
          array_push($category_id, $category->id);
        }
        $data = $news->where('created_at', '>', Carbon::today())
                     ->whereIn('category_id', $category_id)
                     ->orderBy($col, $sort)
                     ->paginate(10);

        return view('home', ['newses' => $data]);
    }

    public function graph($id = "")
    {
        return view('graph.index');
    }
}
