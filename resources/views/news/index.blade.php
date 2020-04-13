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
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/1">お気に入りリワード別</li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/2">ニュース一覧</li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/3">ニュース更新(仮)</li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/news_vue/4">集計履歴</li>
                  </ul>
                </nav>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
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
