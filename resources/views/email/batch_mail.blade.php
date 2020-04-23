@if(!empty($news))
<div>直近20件のニュース</div>
  <ul>
  @foreach($news as $v)
  <li><a href="{{ $v->link }}">{{ $v->title }}<a>({{ $v->opening_date }})</li>
  <hr>
  @endforeach
  </ul>
@else
  <p>ニュースがありません。</p>
@endif
