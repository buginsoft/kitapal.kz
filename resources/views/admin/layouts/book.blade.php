@php
    $book = App\Models\Book::all();
@endphp
    <option selected>Выберите</option>
@foreach ($book as $item)
    @if(!empty($chapter))
    <option value="{{ $item->book_id }}" {{ ($chapter->ch_book_id == $item->book_id) ? "selected" : "" }}>{{ $item->book_name }}</option>
    @elseif(!empty($slider))
    <option value="{{ $item->book_id }}" {{ ($slider->slider_book_id == $item->book_id) ? "selected" : "" }}>{{ $item->book_name }}</option>
    @elseif(!empty($text))
    <option value="{{ $item->book_id }}" {{ ($text->text_book_id == $item->book_id) ? "selected" : "" }}>{{ $item->book_name }}</option>
    @else
    <option value="{{ $item->book_id }}">{{ $item->book_name }}</option>
    @endif
@endforeach