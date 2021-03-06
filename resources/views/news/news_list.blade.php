@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">好きなカテゴリ検索</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  @if(!auth()->guest())
                  <form class="form-inline" action="{{ url('/news_list')}}" method="POST">
                  {{ csrf_field() }}
                    <div class="form-group mx-sm-3 mb-2">
                      <input type="text" class="form-control" id="keyword" name="keyword" value="" placeholder="なんでも検索できます">
                    </div>
                    <input type="submit" class="btn btn-success mb-2" id="submit" value="検索"/>
                  @endif

                  @guest
                  <form class="form-inline" action="{{ url('/news_list_public')}}" method="POST">
                  {{ csrf_field() }}
                    <div class="form-group mx-sm-3 mb-2">
                      <input type="text" class="form-control" id="keyword" name="keyword" value="" placeholder="なんでも検索できます">
                    </div>
                    <input type="submit" class="btn btn-success mb-2" id="submit" value="検索"/>
                  @endguest
                </form>
              </div>

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

                @if(!auth()->guest())
                  @if(!empty($category_id))

                    <a href="/news_list/all/{{ $category_id }}">{{ $title }}に関するニュースデータを全て見る</a>
                  @else
                    <form class="form-inline" action="/category" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="category_name" value="{{ $title }}">
                      <input type="hidden" name="user_id" value="{{ $user_id }}">
                      <input type="submit" class="btn btn-success mb-2" value="このキーワードをお気に入りに登録">
                    </form>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
  <router-view></router-view>
  <top_button></top_button>
@endsection
