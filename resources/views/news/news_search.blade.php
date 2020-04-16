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

                    <form class="form-inline" action="{{ url('/news_list')}}" method="POST">
                    {{ csrf_field() }}
                      <div class="form-group mx-sm-3 mb-2">
                        <!-- <label for="keyword">検索キーワード:</label> -->
                        <input type="text" class="form-control" id="keyword" name="keyword" value="" placeholder="入力してください。">
                        <!-- <label for="submit">検索ボタン:</label> -->
                      </div>
                      <input type="submit" class="btn btn-success mb-2" id="submit" value="Submit!!!!"/>

                  </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
