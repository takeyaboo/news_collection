@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TOP</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav class="navbar navbar-expand-sm navbar-light">
                      <ul class="navbar-nav">
                        <li class="nav-item pl-3"><a class="nav-link" href="/home">新着順<a/></li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/home/1">古い順<a/></li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/home/2">オススメ順<a/></li>
                      </ul>
                    </nav>

                    <h4>今日のニュース一覧</h4>
                    <ul>
                      @foreach($newses as $news)
                        <li><a href="{{ $news->link }}">{{ $news->title }}</a></li>
                          ({{ $news->created_at }})
                          オススメ度:{{ $news->relativity }}
                      @endforeach
                    </ul>
                    {{ $newses->links() }}
                </div>
                <div id="app">
                  <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
