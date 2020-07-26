@inject('services', 'App\Services\AnimalService')

<form method="post" action="{{ route('letters.form', ['to_user_id' => session('to_user_id')]) }}">
  @csrf
  <textarea name="content" {{ $errors->has('content') ? 'autofocus' : '' }}>{{ old('content') ?? session('content') ?? ''}}</textarea><br>
  <button type="submit">内容を確認する</button>
  <button type="button" onClick="location.href='{{ url()->previous() }}'">下書きを破棄して戻る</button>
</form>
@error('content')
  <span class="invalid-feedback">{{$message}}<br>
  ※現在{{mb_strlen(old('content'))}}文字</span>
@enderror

<p>診断結果をGoogleで検索する：{!! $shown_aname == Config::get('view.hidden_aname') ? Config::get('view.hidden') : $services->getLink($shown_aname) !!}</p>
