@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り(ニュース)
                </div>
                <!-- <nav class="navbar navbar-toggleable-md navbar-light"> -->
                <nav class="navbar navbar-expand-sm navbar-light">
                  <ul class="navbar-nav">
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/1">お気に入りリワード別<a/></li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/2">ニュース一覧<a/></li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/3">ニュース更新(仮)<a/></li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/4">集計履歴<a/></li>
                  </ul>
                </nav>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-inline" action="/news_list/search" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" name="search_word" value="" placeholder="保存しているニュースを検索">
                      </div>
                      <input type="submit" class="btn btn-success mb-2" value="検索">
                    </form>

                    @if(!empty($match))
                    <!-- {{ print_r($match) }} -->
                    <h3>「{{ $search_word }}」の検索結果{{ count($match) }}件</h2>
                      <ul>
                      @foreach($match as $v)
                        <li class="list-group-item">
                          <a href="{{ $v->link }}">
                            {{ $v->title }}
                          </a>
                        </li>
                      @endforeach
                    </ul>

                    @endif

                    <div id="app">
                      <router-view></router-view>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
