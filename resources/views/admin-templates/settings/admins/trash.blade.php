@extends('layouts.admin-layouts.app')
@section('title', 'Корзина')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Корзина', 'breadcrumb' => 'trash-admins'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:7px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Корзина
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.settings.admins.activity') }}" class="btn btn-block btn-default btn-sm a-trash" title="Активность на сайте" style="width:170px;">
                <i class="fas fa-tasks"></i> Активность на сайте
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
                @if(isset($adminsInTrash) && count($adminsInTrash) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Логин</th>
                      <th class="th-middle">Аватар</th>
                      <th class="th-middle">Email</th>
                      <th class="th-middle">Тел.</th>
                      <th class="th-middle">Последний раз на сайте</th>
                      <th class="th-middle">Статус</th>
                      <th class="th-middle">Дата регистрации</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adminsInTrash as $admin)
                      <tr role="row" class="odd">
                        <td class="th-middle">{{ $admin->id }}</td>
                        <td class="th-middle"><a href="{{ route('admin.settings.admins.edit', $admin->id) }}" title="Редактировать администратора {{ $admin->login }}">{{ $admin->login }}</a></td>
                        <td class="th-middle">
                          @if(isset($admin->avatar))
                            <img src="{{ asset(show_thumb($admin->avatar)) }}">
                          @else
                            <img src="{{ asset('storage/images/default-images/default-avatar-45.jpg') }}">
                          @endif
                        </td>
                        <td class="th-middle">{{ $admin->email }}</td>
                        <td class="th-middle">{{ $admin->telephone }}</td>
                        <td class="th-middle">{{ $admin->last_seen }}</td>
                        <td class="th-middle">{!! ($admin->status === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}</td>
                        <td class="th-middle">{{ $admin->created_at->format('d/m/Y') }}</td>
                        <td class="th-middle" style="width:90px;">
                          <a class="btn btn-secondary btn-sm" style="float:left;width:30px;margin:0px 5px 0px 5px;" href="{{ route('admin.settings.admins.restore', $admin->id) }}" title="Восстановить администратора">
                            <i class="fas fa-trash-restore"></i>
                          </a>
                          <form action="{{ route('admin.settings.admins.destroy', $admin->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить администратора (безвозвратно)">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <div class="callout callout-warning">
                  <h5><i class="icon fas fa-info"></i> Внимание!</h5>
                  В корзине пусто
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $adminsInTrash->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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