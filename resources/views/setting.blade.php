@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">設定画面
                </div>
                <!-- <nav class="navbar navbar-expand-sm navbar-light">
                  <ul class="navbar-nav">
                    <li class="nav-item pl-3"><a class="nav-link" href="/word_vue/1">お気に入りリワード別<a/></li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/word_vue/2">ワード一覧<a/></li>
                    <li class="nav-item pl-3"><a class="nav-link" href="/word_vue/4">集計履歴<a/></li>

                  </ul>
                </nav> -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/setting/set" method="POST">
                      {{ csrf_field() }}
                      @if(count($errors) > 0)
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      @endif
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="mail">ニュース通知メールON/OFF</label>
                        <input type="radio" class="ml-5" name="mail" id="mail" onclick="form_show()" value="1"{{ $user_data->mail_flg ? ' checked' : '' }}>ON
                        <input type="radio" class="ml-5" name="mail" id="mail" onclick="form_hide()" value="0"{{ $user_data->mail_flg ? '' : ' checked' }}>OFF
                      </div>
                      <div class="form-group mx-sm-3 mb-2" id="address_form">
                        <label for="address">通知宛てメールアドレス</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}">
                        @if(!empty($user_data->mail_address))
                        <p>登録されているアドレス:{{ $user_data->mail_address }}</p>
                        @endif
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="batch">ニュース自動保存ON/OFF</label>
                        <input type="radio" class="ml-5" name="batch" id="batch" value="1"{{ $user_data->batch_flg ? ' checked' : '' }}>ON
                        <input type="radio" class="ml-5" name="batch" id="batch" value="0"{{ $user_data->batch_flg ? '' : ' checked' }}>OFF
                      </div>

                      <input type="submit" class="btn btn-success mb-2" value="登録">
                    </form>
                </div>

                <div id="app">
                  <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function form_show() {
    document.getElementById("address_form").style.display="block";
}

function form_hide() {
    document.getElementById("address_form").style.display="none";
}
</script>
@endsection
