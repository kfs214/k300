@inject('services', 'App\Services\AnimalService')

<form method="post" action="{{ route('letters.confirm') }}">
  @csrf
  <input type="hidden" name="to_user_id" value="{{ $letter->from_user_id ?? $user->id }}">
  <textarea name="content" {{ $errors->has('content') ? 'autofocus' : '' }}>{{ old('content') ?? session('content') ?? ''}}</textarea>
  <button type="submit">内容を確認する</button>
  <button type="button" onClick="location.href='{{ url()->previous() }}'">下書きを破棄して戻る</button>
</form>
@error('content')
  {{$message}}
@enderror

<p>診断結果をGoogleで検索する：{!! $services->getLink($letter->from_user->shown_aname ?? $user->shown_aname) !!}</p>
