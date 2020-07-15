@extends('layouts.common')
@section('title', 'チームのメンバー一覧')

@section('content')
  <div class="content">
    <h2>チームのメンバー一覧</h2>
    @include('components.members_list', ['mode' => 'team'])
  </div>

  <div class="content">
    <h3>新たにチームメンバーを追加する</h3>
    <form method="POST" id="form" action="{{ route('team.add') }}">
        @csrf
        <div class="row">
          <h3><label for="name">{{ __('Name') }}</label></h3>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" {{ $errors->has('name') ? 'autofocus' : '' }}>
          @error('name')
              <span class="invalid-feedback">
                  {{ $message }}
              </span>
          @enderror
        </div>

        <div class="row">
          <h3><label for="birthday">生年月日</label></h3>
          <input id="bday_year" type="number" name="bday_year" value="{{ old('bday_year') }}" required autocomplete="bday" placeholder="1980" {{ $errors->has('birthday') ? 'autofocus' : ''}}>年

          <input id="bday_month" type="number" name="bday_month" value="{{ old('bday_month') }}" required autocomplete="bday" placeholder="2">月

          <input id="bday_day" type="number" name="bday_day" value="{{ old('bday_day') }}" required autocomplete="bday" placeholder="14">日<br>
          @error('birthday')
              <span class="invalid-feedback">
                  {{ $message }}
              </span>
          @enderror
        </div>

        <div class="row">
          <button type="submit">
              チームメンバーを追加する
          </button><br>
          <p>※チームメンバーの情報を表示できるのはあなただけです</p>
        </div>
    </form>
  </div>
@endsection
