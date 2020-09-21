@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">グラフ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <nav class="navbar navbar-expand-sm navbar-light">
                      <ul class="navbar-nav">
                        <li class="nav-item pl-3"><a class="nav-link" href="/graph/1">ニュース保存数グラフ<a/></li>
                        <!-- <li class="nav-item pl-3"><a class="nav-link" href="/graph/2">ワード保存数グラフ<a/></li> -->
                        <li class="nav-item pl-3"><a class="nav-link" href="/graph/3">今日のグラフ<a/></li>
                      </ul>
                    </nav>
                      <router-view></router-view>

                    <ul>
                      <!-- トップページになに表示させるか迷い中 -->
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
