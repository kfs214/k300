<div>
  <form method="POST" action="{{ url()->current() }}">
      @csrf
      <div class="content search-by-row">
        <div class="search-by-value">
          <select name="t12aname">
            <option value="">12タイプ</option>
            @foreach( $animal_groups['t12anames'] as $t4aname => $t12anames )
              <optgroup label="---{{ $t4aname }}---">
              <option value="{{ $loop->iteration }}" {{ $loop->iteration == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t4aname }}（以下の3種類すべて）</option>
                @foreach( $t12anames as $t12aname )
                  <option value="{{ $t12aname }}" {{ $t12aname == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t12aname }}</option>
                @endforeach
              </optgroup>
            @endforeach
            <optgroup label="---3タイプ---">
            @foreach( $animal_groups['t3anames'] as $t3aname )
              <option value="{{ $t3aname }}" {{ $t3aname == $selected_animals['t12aname'] ? 'selected' : ''}}>{{ $t3aname }}</option>
            @endforeach
          </select>

          <select name="rhythm" >
            <option value="">リズム</option>
            @foreach( $animal_groups['rhythms'] as $rhythm )
              <option value="{{ $rhythm }}" {{ $rhythm == $selected_animals['rhythm'] ? 'selected' : ''}}>{{ $rhythm }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" name="search_by" value="groups">
            AND検索で絞り込む
        </button>
      </div>

      <div class="content search-by-row">
        <div class="search-by-value">
          <select name="acode">
            <option value="">60タイプ</option>
            @foreach( $grouped_animals as $t3animal => $t12animals )
              <optgroup label="---{{ $t3animal }}---"></optgroup>
              @foreach( $t12animals as $t12animal => $t60animals)
                <optgroup label="{{ $t12animal }}">
                @foreach( $t60animals as $t60animal )
                  <option value="{{ $t60animal->id }}" {{ $t60animal->id == $selected_animals['acode'] ? 'selected' : ''}}>{{ $t60animal->aname }}</option>
                @endforeach
                </optgroup>
              @endforeach
            @endforeach
          </select>
          </div>

        <button type="submit" name="search_by" value="acode">
            60タイプで絞り込む
        </button>
      </div>
      <button type="submit" name="search_by" value="none">
        絞り込みを解除する
      </button>
  </form>
</div>
