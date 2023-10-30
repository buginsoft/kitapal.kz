@php
    $collection = App\Models\Collection::all();
@endphp
    <option selected>Выберите</option>
@foreach ($collection as $item)
    @if(!empty($book))
    <option value="{{ $item->collection_id }}" {{ ($book->book_collection_id == $item->collection_id) ? "selected" : "" }}>{{ $item->collection_name_ru }}</option>
    @else
    <option value="{{ $item->collection_id }}">{{ $item->collection_name_ru }}</option>
    @endif
@endforeach