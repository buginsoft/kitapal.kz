@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
          <a>Текст</a>
        </h3>
      </div>
      <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/text/create" class="btn btn-success">Добавить</a>
      </div>
    </div>
    <div class="row white-bg">
      <div class="col-md-12">
        <div class="box-body">
          <div class="table-responsive">
            <table id="showed" class="table table-bordered table-striped">
              <thead>
                <tr style="border: 1px">
                  <th style="width: 30px">№</th>
                  <th>Текст(ru)</th>
                  <th>Текст(kz)</th>
                  <th>Текст(en)</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($text as $value)
                <tr>
                  <td>{{ $value->text_id }}</td>
                  <td>{{ $value->text_ru }}</td>
                  <td>{{ $value->text_kz }}</td>
                  <td>{{ $value->text_en }}</td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->text_id }}','text')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  <td><a href="/admin/text/{{ $value->text_id }}/edit"><i class="fas fa-pen"></i></a></td>
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