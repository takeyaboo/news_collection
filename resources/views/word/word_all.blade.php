@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り(ワード)　一覧>
                </div>
                <!-- <nav class="navbar navbar-toggleable-md navbar-light"> -->
                <nav class="navbar navbar-expand-sm navbar-light">
                  <ul class="navbar-nav">
                    <li class="nav-item pl-3"><a class="nav-link" href="/category/1">保存総数順</li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/category/2">期間別順</li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/category/3">関連ワード数</li>
                  </ul>
                </nav>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(!empty($news_num))

                      <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="category_name" value="" placeholder="気になるキーワードを入力" size="30">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="submit" value="登録">
                      </form>

                      @if (session('message'))
                        <div class="flash_message bg-success text-center py-3 my-0">
                            {{ session('message') }}
                        </div>
                      @endif

                        <ul>
                          <?php $i = 0; ?>
                          @foreach($categories as $category)
                            <li><a href="/news_list/{{ $category->id }}">{{ $category->category_name }}</a>
                              <a href="/word/{{ $category->id }}">関連ワードを確認</a>
                              <div style="display:inline" class="text-right">
                                <form action="/category/{{ $category->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <p>保存件数({{ $news_num[$i] }})</p>
                                    <button type="submit" class="">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                              </div>
                            </li>
                            <hr>
                            <?php $i++ ?>
                          @endforeach
                        </ul>
                      @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
