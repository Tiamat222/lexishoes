@extends('layouts.admin-layouts.app')
@section('title', 'Активность на сайте')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Активность на сайте', 'breadcrumb' => 'activity'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:9px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Активность
            </h3>
            @if(isset($adminsLogins) && count($adminsLogins) > 0)
            <form action="{{ route('admin.settings.admins.feeds') }}" method="POST">
            {{ csrf_field() }}
              <div class="col-sm-2" style="float:left;margin-left:10px;">
                <div class="form-group" style="margin-bottom:0rem;">
                  <select class="form-control" name="id">
                    <option value="">Весь список</option>
                    @foreach($adminsLogins as $key => $value)
                    <option value="{{ $key }}" {{ ($key == $adminId) ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-block btn-default" style="float:left;width:100px;">Показать</button>
            </form>
            @endif
            <div style="float:right;margin-top:5px;">
              <a href="{{ route('admin.settings.admins.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:130px;">
                <i class="fa fa-trash"></i> Корзина ({{ $adminsInTrash }})
              </a>
              <a href="{{ route('admin.settings.admins.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить администратора" style="width:230px;">
                <i class="fas fa-plus"></i> Добавить администратора
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(isset($feeds) && count($feeds) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Логин админа</th>
                      <th class="th-middle">Тип фида</th>
                      <th class="th-middle">ID фида</th>
                      <th class="th-middle">Модель</th>
                      <th class="th-middle">Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($feeds as $feed)
                      <tr role="row" class="odd">
                        <td class="th-middle">{{ $feed->id }}</td>
                        <td class="th-middle">{{ $feed->admin_login }}</td>
                        <td class="th-middle">{{ $feed->type }}</td>
                        <td class="th-middle">{{ $feed->feedable_id }}</td>
                        <td class="th-middle">{{ $feed->feedable_type }}</td>
                        <td class="th-middle">{{ $feed->created_at }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <div class="callout callout-warning">
                  <h5><i class="icon fas fa-info"></i> Внимание!</h5>
                  Фиды отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $feeds->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection