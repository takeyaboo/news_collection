@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category }}に関する全てのニュース</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <nav class="navbar navbar-expand-sm navbar-light">
                      <ul class="navbar-nav">
                        <li class="nav-item pl-3"><a class="nav-link" href="/news_list/all/{{ $category_id }}">新着順<a/></li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/news_list/all/{{ $category_id }}/asc">古い順<a/></li>
                        <li class="nav-item pl-3"><a class="nav-link" href="/news_list/all/{{ $category_id }}/relativity">オススメ順<a/></li>
                      </ul>
                    </nav>

                    @for($i = 0; $i < count($newses); $i++)
                      <p><a href="{{ $newses[$i]->link }}">{{ $newses[$i]->title }}</a></p>
                      <p>オススメ度:{{ $newses[$i]->relativity }}</p>
                      <p>{{ $newses[$i]->opening_date }}</p>
                      <hr>
                    @endfor
                    {{ $newses->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
<div id="app">
  <router-view></router-view>
</div>
@endsection
