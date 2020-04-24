@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り(ニュース)　一覧
                </div>
                <!-- <nav class="navbar navbar-toggleable-md navbar-light"> -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif







                      <form class="form-inline" action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group mx-sm-3 mb-2">
                          <input type="text" class="form-control" name="category_name" value="" placeholder="気になるキーワードを入力" size="30">
                          <input type="hidden" name="user_id" value="{{ $user_id }}">
                        </div>
                        <input type="submit" class="btn btn-success mb-2" value="登録">
                      </form>

                      @if(!empty($news_num))

                      @if (session('message'))
                        <div class="flash_message bg-success text-center py-3 my-0">
                            {{ session('message') }}
                        </div>
                      @elseif(session('error_message'))
                      <div class="flash_message bg-danger text-center py-3 my-0">
                          {{ session('error_message') }}
                      </div>
                      @endif


                          <?php $i = 0; ?>
                          @foreach($categories as $category)
                          <ul class="list-group">
                            <li class="list-group-item">
                              <a class="btn btn-lg btn-info" href="/news_list/{{ $category->id }}">{{ $category->category_name }}</a>
                              <div style="display:inline" class="text-right">
                                <form action="/category/{{ $category->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <p>保存件数({{ $news_num[$i] }})</p>
                                    <p>関連ワード数({{ $category->rel_word_num }})</p>
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                              </div>
                            </li>
                            <!-- <hr> -->
                            <!-- {{ $category->test_data }} -->
                            </ul>
                            <?php $i++ ?>

                          @endforeach

                      @endif

                </div>

            </div>
        </div>
    </div>
</div>
<div id="app">
  <router-view></router-view>
</div>
@endsection
