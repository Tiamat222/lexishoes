@extends('layouts.admin-layouts.app')
@section('title', 'Список поставщиков')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Список поставщиков</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('suppliers') }}
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
            <h3 class="card-title" style="margin-top:7px;">
              <i class="fa fa-industry" aria-hidden="true"></i> Поставщики
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.catalog.suppliers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина">
                <i class="fa fa-trash"> {{ $suppliersInTrash }}</i>
                Корзина
              </a>
              <a href="{{ route('admin.catalog.suppliers.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить нового поставщика">
                <i class="fas fa-plus"></i>
                Добавить поставщика
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(count($suppliers) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Поставщик</th>
                      <th class="th-middle">Комментарий</th>
                      <th class="th-middle" style="width:150px;">Кол-во товаров</th>
                      <th class="th-middle">Дата создания</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($suppliers as $supplier)
                    <tr role="row" class="odd">
                      <td class="th-middle" style="width:50px;">{{ $supplier->id }}</td>
                      <td class="th-middle" style="width:250px;"><a href="{{ route('admin.catalog.suppliers.edit', $supplier->id) }}" title="Редактировать">{{ $supplier->name }}</a></td>
                      <td class="th-middle">{{ $supplier->description }}</td>
                      <td class="th-middle" style="width:50px;">0</td>
                      <td class="th-middle" style="width:150px;">{{ $supplier->created_at->format('d/m/Y') }}</td>
                      <td class="th-middle" style="width:130px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.suppliers.show', $supplier->id) }}" title="Просмотреть данные">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.suppliers.edit', $supplier->id) }}" title="Редактировать">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.catalog.suppliers.delete', $supplier->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить">
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
                  Поставщики отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $suppliers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div id="page-cover"></div>
@endsection
