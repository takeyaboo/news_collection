@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category }}に関する関連ワード一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                      @foreach($words as $word)
                        <li class="list-group-item">{{ $word->word }}
                          ({{ $word->appear_num }}回)
                        </li>
                      @endforeach
                    </ul>

                    <!-- <form action="/word" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="category_id" value="{{ $category_id }}">
                      <input type="submit" 集計>
                    </form> -->
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
