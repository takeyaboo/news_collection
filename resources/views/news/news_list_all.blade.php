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

                    @for($i = 0; $i < count($newses); $i++)
                      <p><a href="{{ $newses[$i]->link }}">{{ $newses[$i]->title }}</a></p>
                      <p>{{ $newses[$i]->opening_date }}</p>
                      <hr>
                    @endfor
                    {{ $newses->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
<a href="/home">メニューに戻る</a>

@endsection
