@extends('layouts.common')
@section('title', '新規登録')

@section('content')
  <div class="content">
    <h2>{{ __('Register') }}</h2>

    <div class="row scroll-img">
      <h3>設定した各項目の表示例</h3>
      <img src="{{ asset('/links/hidden-example.png') }}">
    </div>
    <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row">
      <h3><label for="uname">{{ __('Name') }}</label></h3>
      <input id="uname" type="text" name="uname" value="{{ old('uname') }}" required autocomplete="name" {{ $errors->any() ? $errors->has('uname') ? 'autofocus' : '' : 'autofocus' }}>
      @error('uname')
          <br><span class="invalid-feedback">
              {{ $message }}<br>
              ※現在{{mb_strlen(old('uname'))}}文字
          </span>
      @enderror
    </div>

    <div class="row">
      <h3><label for="birthday">生年月日</label></h3>
      <input id="bday_year" type="number" name="bday_year" value="{{ old('bday_year', session('bday_year')) }}" required autocomplete="bday" placeholder="1980" {{ $errors->has('birthday') ? 'autofocus' : ''}}>年
      <input id="bday_month" type="number" name="bday_month" value="{{ old('bday_month', session('bday_month')) }}" required autocomplete="bday" placeholder="2">月
      <input id="bday_day" type="number" name="bday_day" value="{{ old('bday_day', session('bday_day')) }}" required autocomplete="bday" placeholder="14">日
      @error('birthday')
          <br><span class="invalid-feedback">
              {{ $message }}
          </span>
      @enderror
    </div>

    <div class="row">
      <h3><label for="comment">コメント<br>（省略可）</label></h3>
      <textarea id="comment" name="comment" placeholder="ふんどし王子です。余市第1リフトで仕事してます。プログラマーやったり自衛官やったり家事代行やったりしてきました。南樽市場安くて幸せ。" {{ $errors->has('comment') ? 'autofocus' : ''}}>{{ old('comment') }}</textarea>

      @error('comment')
          <br><span class="invalid-feedback" role="alert">
              <strong>{{ $message }}
              ※現在{{mb_strlen(old('comment'))}}文字</strong>
          </span>
      @enderror
    </div>

    <div class="row">
      <h3><label for="profile_shown">公開範囲設定</label></h3>
      <input type="hidden" name="name_shown" value="1">
      <lavel for="name_shown"><input type="checkbox" id="name_shown" name="name_shown" value="0">匿名を利用する</lavel><br>
      <input type="hidden" name="birthday_shown" value="1">
      <lavel for="birthday_shown"><input type="checkbox" id="birthday_shown" name="birthday_shown" value="0">生年月日を非公開にする</lavel><br>
      <select name="type_shown">
        <option value="7">通常</option>
        <option value="6">60タイプ分類を非公開</option>
        <option value="4">12タイプ分類を非公開</option>
        <option value="0">3タイプ分類を非公開</option>
      </select>
      <p>※グループに参加しない場合は、登録した情報や診断結果は一切公開されません。</p>
    </div>

    <div class="row">
      <h3><label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label></h3>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" {{ $errors->has('email') ? 'autofocus' : ''}}>
      @error('email')
          <br><span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="row">
      <h3><label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label></h3>
      <input id="password" type="password" name="password" required autocomplete="new-password" {{ $errors->has('password') ? 'autofocus' : ''}}>
      @error('password')
          <br><span class="invalid-feedback">
              {{ $message }}
          </span>
      @enderror
    </div>

    <div class="row">
      <h3><label for="password-confirm">{{ __('Confirm Password') }}</label></h3>
      <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" {{ $errors->has('password_confirm') ? 'autofocus' : ''}}>
    </div>

    <div class="row">
      <button type="submit" class="btn btn-primary">
          {{ __('Register') }}
      </button>
    </div>
  </div>
@endsection
