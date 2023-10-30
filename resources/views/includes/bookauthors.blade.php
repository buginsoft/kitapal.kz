@foreach($authors as $author)
    {{$author["name_$lang"]}} @if(!$loop->last),@endif
@endforeach
