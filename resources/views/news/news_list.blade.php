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
                  <!-- <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Sunsets don&#39;t get much better than this one over <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>. <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw">#nature</a> <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw">#sunset</a> <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a></p>&mdash; US Department of the Interior (@Interior) <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw">May 5, 2014</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
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
<div id="app">
  <router-view></router-view>
</div>
@endsection
