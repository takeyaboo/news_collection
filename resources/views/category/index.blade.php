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
                              <div style="display:inline" class="text-right">
                                <form action="/category/{{ $category->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <p>保存件数({{ $news_num[$i] }})</p>
                                    <p>関連ワード数({{ $category->rel_word_num }})</p>
                                    <button type="submit" class="">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                              </div>
                            </li>
                            <hr>
                            <!-- {{ $category->test_data }} -->
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
