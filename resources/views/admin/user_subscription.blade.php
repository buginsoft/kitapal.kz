@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
          <a>Подписанные пользователи</a>
        </h3>
      </div>
    </div>
    <div class="row white-bg">
      <div class="col-md-12">
        <div class="box-body">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block">
                <form class="box-body d-flex align-items-center" action="/admin/user_subscriptions" method="post">
                  @csrf
                  <div class="form-group col-lg-4">
                    <label>ID(поиск по Email)</label>

                    <input class="form-control country" type="text" data-min-length="1"
                           list="country" name="user_id" required>
                    <datalist class="selectpicker" id="country">
                      @include('admin.layouts.users')
                    </datalist>
                  </div>
                  <div class="form-group col-lg-4">
                    <label>Название(kz)</label>
                    <select name="subscription_id" class="form-control">
                      @include('admin.layouts.subscription')
                    </select>
                  </div>
                  <div class="form-group col-lg-4 m-b-0">
                    <button id="send" class="btn btn-primary">Сохранить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="showed" class="table table-bordered table-striped">
              <thead>
                <tr style="border: 1px">
                  <th style="width: 30px">№</th>
                  <th>Email</th>
                  <th>Подписка</th>
                  <th>Цена</th>
                  <th>Дата окончания</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($subscriptions as $key=>$value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->email }}</td>
                  <td>{{ $value->sub_name_ru }}</td>
                  <td>{{ $value->sub_cost }}</td>
                  <td>{{ $value->us_final_date }}</td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->us_id }}','user_subscriptions')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  <td><a href="/admin/user_subscriptions/{{ $value->us_id }}/edit"><i class="fas fa-pen"></i></a></td>
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
@endsection