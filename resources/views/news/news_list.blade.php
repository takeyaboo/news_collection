@extends('layouts.app')

@section('content')
<div class="container">
  <!-- {{print_r($list_gn)}} -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">「{{ $title }}」に関する最近のニュース</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                @for($i = 0; $i < count($list_gn); $i++)
                  <p><a href="{{ $list_gn[$i]['url'] }}">{{ $list_gn[$i]['title'] }}</a></p>
                  <p>{{ $list_gn[$i]['time'] }}</p>
                  <hr>
                @endfor

                @if(!empty($category_id))
                  <!-- <form action="/news_list/store" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="category_id" value="{{ $category_id }}">
                    <input type="submit" 保存>
                  </form> -->

                  <a href="/news_list/all/{{ $category_id }}">{{ $title }}に関するニュースデータを全て見る</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- <a href="/home">メニューに戻る</a> -->

@endsection
