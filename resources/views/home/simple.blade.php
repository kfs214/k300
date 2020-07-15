@extends('layouts.common')
@section('title', '簡易診断')

@section('content')
<form method="POST">
  @csrf
  <div class="row">
    <label>生年月日</label><br>
    <input id="bday_year" type="number" name="bday_year" value="{{ old('bday_year') }}" required autocomplete="bday" placeholder="1980" autofocus>年
    <input id="bday_month" type="number" name="bday_month" value="{{ old('bday_month') }}" required autocomplete="bday" placeholder="2">月
    <input id="bday_day" type="number" name="bday_day" value="{{ old('bday_day') }}" required autocomplete="bday" placeholder="14">日<br>
    @error('birthday')
      <span class="invalid-feedback">
          {{ $message }}
      </span>
    @enderror
  </div>

  <button type="submit">
      簡易診断を行う
  </button>
</form>
@endsection
