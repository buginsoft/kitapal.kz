@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
          <a>Роль Пользователей</a>
        </h3>
      </div>
    </div>
    <div class="row white-bg">
      <div class="col-md-12">
        <div class="box-body">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block">
                <div class="box-body d-flex align-items-center">
                  <div class="form-group col-lg-3">
                    <label>Название(ru)</label>
                    <input type="text" class="form-control" name="role_name_ru" />
                  </div>
                  <div class="form-group col-lg-3">
                    <label>Название(kz)</label>
                    <input type="text" class="form-control" name="role_name_kz" />
                  </div>
                  <div class="form-group col-lg-3">
                    <label>Название(en)</label>
                    <input type="text" class="form-control" name="role_name_en" />
                  </div>
                  <div class="form-group col-lg-3 m-b-0">
                    <button id="send" class="btn btn-primary">Сохранить</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="showed" class="table table-bordered table-striped">
              <thead>
                <tr style="border: 1px">
                  <th style="width: 30px">№</th>
                  <th>Название(ru)</th>
                  <th>Название(kz)</th>
                  <th>Название(en)</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($role as $value)
                <tr>
                  <td>{{ $value->role_id }}</td>
                  <td>{{ $value->role_name_ru }}</td>
                  <td>{{ $value->role_name_kz }}</td>
                  <td>{{ $value->role_name_en }}</td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->role_id }}','role')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
  $('#send').click(function () {
    $.post("/admin/role", {
      role_name_ru: $('input[name=role_name_ru]').val(),
      role_name_kz: $('input[name=role_name_kz]').val(),
      role_name_en: $('input[name=role_name_en]').val(),
      _token: '{{csrf_token()}}'
    }, function (response) {
      $('tbody').append(
        "<tr><td>" + response.role_id + "</td>" +
        "<td>" + response.role_name_ru + "</td>" +
        "<td>" + response.role_name_kz + "</td>" +
        "<td>" + response.role_name_en + "</td>" +
        "<td><a href=\"javascript:void(0)\" onclick=\"remove(this,'" + response.role_id + "','role')\"><i class=\"fas fa-trash\"></i></a></td></tr>"
      );
    });
  });
</script>
@endsection