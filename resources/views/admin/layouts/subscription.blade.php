@php
    $subscriptions = App\Models\Subscription::all();
@endphp
    <option selected>Выберите</option>
@foreach ($subscriptions as $item)
    <option value="{{ $item->subscription_id }}">{{ $item->sub_name_ru }}</option>
@endforeach