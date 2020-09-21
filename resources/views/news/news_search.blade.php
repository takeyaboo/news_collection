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

            </div>
        </div>
    </div>
</div>
  <router-view></router-view>
@endsection
