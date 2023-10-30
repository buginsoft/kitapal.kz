@extends('admin.layouts.layout')
<style>
    .form__button{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn{
        box-shadow:unset !important;
    }
</style>
@yield('page_level_css')
@section('content')
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-10">
                                <div class="form__button">
                                    <h4>@yield('table_title')</h4>
                                    @yield('add_button')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            @yield('table')
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        jQuery.each(["put", "delete"], function (i, method) {
            jQuery[method] = function (url, data, callback, type) {
                if (jQuery.isFunction(data)) {
                    type = type || callback;
                    callback = data;
                    data = undefined;
                }

                return jQuery.ajax({
                    url: url,
                    type: method,
                    dataType: type,
                    data: data,
                    success: callback
                });
            };
        });

        function remove(ob, id, model) {
            var answ = confirm("Вы действительно хотите удалить?");
            if (answ) {
                $.delete("/admin/" + model + "/" + id, {
                    _token: '{{ csrf_token() }}'
                }, function (result) {
                    if(result.error){
                        alert(result.error);
                    }
                    else {
                        $(ob).closest('tr').remove();
                    }
                });
            }
        }
    </script>
    @yield('page_level_js')
@endsection

