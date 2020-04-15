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
                        <li class="nav-item pl-3"><a class="nav-link" href="/home/1">ニュース保存数グラフ</li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/home/2">ワード保存数グラフ</li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/home/3">今日のグラフ</li>
                      </ul>
                    </nav>
                    <div id="app">
                      <!-- <router-link to="/">1</router-link>
                       <router-link to="/page2">2</router-link> -->
                      <!-- <span v-if="seen">Now you see me</span> -->
                      <router-view></router-view>
                    </div>

                    <ul>
                      <!-- トップページになに表示させるか迷い中 -->
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
