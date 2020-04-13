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

                    <form action="{{ url('/news_list')}}" method="POST">
                    {{ csrf_field() }}
                    <label for="keyword">検索キーワード:</label>
                    <input type="text" id="keyword" name="keyword" value=""></p>
                    <label for="submit">検索ボタン:</label>
                    <input type="submit" id="submit" value="Submit!!!!"/>
                  </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
