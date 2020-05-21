@extends('layouts.common')
@inject('services', 'App\Services\AnimalService')

@section('content')
  @if( session('status') !== null )
    {{ session('status') }}<br><br>
  @endif
  @isset($team_members['0'])
    <a href="#form">新たにチームメンバーを追加する</a><br>
    <table>
      <tr>
        <th>お名前</th>
        <th>生年月日</th>
        <th>60タイプ</th>
        <th>リズム</th>
        <th>12タイプ</th>
        <th>3タイプ</th>
        <th>ホワイトエンジェル</th>
        <th>ブラックデビル</th>
      </tr>
      @foreach($team_members as $team_member)
        <tr>
          <td>{{ $team_member->name }}</td>
          <td>{{ $team_member->birthday }}</td>
          <td>{!! $services->getLink($team_member->animal->aname) !!}</td>
          <td>{!! $services->getLink($team_member->animal->rhythm) !!}</td>
          <td>{!! $services->getLink($team_member->animal->t12aname) !!}</td>
          <td>{!! $services->getLink($team_member->animal->t3aname) !!}</td>
          <td>{!! $services->getLink($team_member->animal->wangel) !!}</td>
          <td>{!! $services->getLink($team_member->animal->bdebil) !!}</td>
        </tr>
      @endforeach
    </table>
    {{ $team_members->links() }}
  @else
    まだメンバーがいないようです。
  @endisset


<h3>新たにチームメンバーを追加する</h3>
  <form method="POST" id="form">
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
              @enderror


          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  チームメンバーを追加する
              </button>
              ※チームメンバーの情報を表示できるのはあなただけです
          </div>
      </div>
  </form>
@endsection
