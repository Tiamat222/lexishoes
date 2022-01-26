@extends('layouts.admin-layouts.app')
@section('title', 'Корзина')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Корзина</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('trash-suppliers') }}
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="float:left;margin-top:3px;">
              <i class="fas fa-trash"></i> Список поставщиков в корзине
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.catalog.suppliers.create') }}" class="btn btn-block btn-default btn-sm" style="width:180px;float:left;" title="Добавить нового поставщика">
                <i class="fas fa-plus" style="color:#666666;"></i>
                Добавить поставщика
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(count($softDeletedSuppliers) > 0)
                <div class="btn-group" style="margin-bottom:10px;">
                  <button type="button" name="delete-all" id="delete-all" class="btn btn-default btn-xs">удалить</button>
                  <button type="button" name="restore-all" id="restore-all" class="btn btn-default btn-xs">восстановить</button>
                </div>
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">    
                      <th class="th-middle"><input type="checkbox" id="mass-actions"></th>
                      <th class="th-middle" style="width:100px;">ID</th>
                      <th class="th-middle">Поставщик</th>
                      <th class="th-middle">Комментарий</th>
                      <th class="th-middle" style="width:100px;">Кол-во товаров</th>
                      <th class="th-middle">Дата создания</th>
                      <th class="th-middle" style="width:130px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($softDeletedSuppliers as $supplier)
                    <tr role="row" class="odd">
                      <td class="th-middle"><input type="checkbox" name="mass" value="{{ $supplier->id }}"></td>
                      <td class="th-middle">{{ $supplier->id }}</td>
                      <td class="th-middle">{{ $supplier->name }}</td>
                      <td class="th-middle">{{ $supplier->description }}</td>
                      <td class="th-middle">0</td>
                      <td class="th-middle">{{ $supplier->created_at->format('d/m/Y') }}</td>
                      <td class="th-middle">
                        <a class="btn btn-secondary btn-sm" style="float:left;width:30px;margin-right:5px;" href="{{ route('admin.catalog.suppliers.edit', $supplier->id) }}" title="Редактировать">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-secondary btn-sm" style="float:left;width:30px;margin-right:5px;" href="{{ route('admin.catalog.suppliers.restore', $supplier->id) }}" title="Восстановить">
                          <i class="fas fa-trash-restore"></i>
                        </a>
                        <form action="{{ route('admin.catalog.suppliers.destroy', $supplier->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-secondary btn-sm" style="float:left;width:30px;" href="" title="Удалить навсегда">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else 
                <div class="callout callout-warning" style="background:#F5E1B9">
                  <h5><i class="icon fas fa-info"></i> Внимание!</h5>
                  Поставщики отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $softDeletedSuppliers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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