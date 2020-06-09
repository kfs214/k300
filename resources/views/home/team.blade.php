@extends('layouts.common')
@section('title', 'チームのメンバー一覧')

@section('content')
<h1>チームのメンバー一覧</h1>
@include('components.members_list', ['mode' => 'team'])

<h3>新たにチームメンバーを追加する</h3>
  @if( session('status') !== null )
    {{ session('status') }}<br><br>
  @endif
  <form method="POST" id="form" action="{{ route('team.add') }}">
      @csrf
      <div class="form-group row">  <!--name-->
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

              @error('name')
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
                  <strong>{{ $message }}</strong>
              @enderror


          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  チームメンバーを追加する
              </button><br>
              ※チームメンバーの情報を表示できるのはあなただけです
          </div>
      </div>
  </form>
@endsection
