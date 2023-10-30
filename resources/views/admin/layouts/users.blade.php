@php
    $user = App\Models\User::all();
@endphp
@foreach ($user as $item)
    <option value="{{ $item->user_id }}" label="{{ $item->email }}"></option>
@endforeach