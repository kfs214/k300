@extends('layouts.common')
@section('title', '新規登録')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">  <!--uname-->
                            <label for="uname" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control @error('uname') is-invalid @enderror" name="uname" value="{{ old('uname') }}" required autocomplete="name" autofocus>

                                @error('uname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">生年月日</label>

                            <div class="col-md-6">
                                <input id="bday_year" type="number" class="form-control @error('bday_year') is-invalid @enderror" name="bday_year" value="{{ old('bday_year') }}" required autocomplete="bday" placeholder="1980">年

                                <input id="bday_month" type="number" class="form-control @error('bday_month') is-invalid @enderror" name="bday_month" value="{{ old('bday_month') }}" required autocomplete="bday" placeholder="2">月

                                <input id="bday_day" type="number" class="form-control @error('bday_day') is-invalid @enderror" name="bday_day" value="{{ old('bday_day') }}" required autocomplete="bday" placeholder="14">日

                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">コメント</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" placeholder="ふんどし王子です。余市第1リフトで仕事してます。プログラマーやったり自衛官やったり家事代行やったりしてきました。南樽市場安くて幸せ。">{{ old('comment') }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">  <!--profile_shown-->
                            <label for="profile_shown" class="col-md-4 col-form-label text-md-right">公開範囲設定</label>

                            <div class="col-md-6">
                                <input type="checkbox" id="name_hidden" name="name_hidden" value="true"><lavel for="name_hidden">匿名を利用する</lavel><br>
                                <select name="type_shown">
                                  <option value="7">通常</option>
                                  <option value="6">60タイプ分類を非公開</option>
                                  <option value="4">12タイプ分類を非公開</option>
                                  <option value="0">3タイプ分類を非公開</option>
                                </select>
                                <p>※グループに参加しない場合は、登録した情報や診断結果は一切公開されません。</p>
                            </div>
                        </div>

                        <div class="form-group row">  <!--email-->
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
