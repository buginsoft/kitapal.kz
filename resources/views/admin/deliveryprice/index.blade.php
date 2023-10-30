@extends('admin.layouts.table')
@section('table_title','Цены')
@section('breadcrumb','Цены доставки')

@section('table')
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">Тип</th>
            <th>Описание</th>
            <th>Цена</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($all as $item)
            <tr>
                <td>{{ $item->type }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <input id="price{{ $item->id }}" style="width:80px;"
                           class="form-control" value="{{ $item->price }}">
                </td>
                <td>
                    <button id="id{{ $item->id }}" class="btn btn-primary" onclick="savePriceBtn(this.id)">
                        Сохранить
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        function savePriceBtn(id){
            let price = $("#price"+id.substr(2)).val();
            $.ajax({
                type: "PUT",
                url: "/admin/delivery_price/"+id.substr(2),
                data: {
                    'price':price
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            });
        }
    </script>
@endsection
