@extends('admin.layouts.table')
@section('table_title','Количество покупок книг')
@section('breadcrumb','Статистика')
@section('page_level_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('table')
    <form>
        <input type="hidden" name="type" value="{{request()->type}}">
        <div class="input-group">
            <input type="text" placeholder="название" name="book_name" value="{{request()->book_name}}">
            <input type="text" class="form-control" id="reportrange" name="date" autocomplete="off" />
        </div>
        <input type="hidden" id="start_date" name="from" value="{{request()->from}}">
        <input type="hidden" id="end_date" name="to"  value="{{request()->to}}">

        <button  type="submit">Показать</button>
    </form>
    <table id="showed" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Название</th>
            <th>Количество</th>
            <th>Средняя цена чека</th>
            <th>Нынешняя цена</th>
            <th>Общая цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $key=>$value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $value->book_name }}</td>
                <td>{{ $value->total }}</td>
                <td>{{ $value->total_sum/$value->total }}</td>
                @if(request()->type == 'paper')
                    <td>{{ $value->paperbook_price }}</td>
                @elseif(request()->type == 'ebook')
                    <td>{{ $value->ebook_price }}</td>
                @else
                    <td>{{ $value->audio_price }}</td>
                @endif
                <td>{{ $value->total_sum }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$books->appends(request()->input())->links()}}
@endsection
@section('page_level_js')
    <script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {

            @if(isset(request()->from))
            var start = moment("{{request()->from}}", 'YYYY-MM-DD');
            @else
            var start = moment().subtract(29, 'days');
            @endif

            @if(isset(request()->to))
            var end = moment("{{request()->to}}", 'YYYY-MM-DD');
            @else
            var end = moment();
            @endif

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                autoApply: true,
                startDate: start,
                endDate: end,
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                    'Прошедший месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    "applyLabel": "Применить",
                    "cancelLabel": "Отмена",
                    "customRangeLabel": "Другой",
                    "daysOfWeek": [
                        "Вс",
                        "По",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ]
                },
            }, cb);

            cb(start, end);

            $(document).ready(function() {
                $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    var drp = $('#reportrange').data('daterangepicker');
                    $('#start_date').val(drp.startDate.format('YYYY-MM-DD'));
                    $('#end_date').val(drp.endDate.format('YYYY-MM-DD'));
                });
            });
        });
    </script>
@endsection
