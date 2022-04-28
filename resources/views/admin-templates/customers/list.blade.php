@extends('layouts.admin-layouts.app')
@section('title', 'Список заказчиков')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Список заказчиков', 'breadcrumb' => 'customers'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Заказчики
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.customers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:130px;">
                <i class="fa fa-trash"></i> Корзина ({{ $softDeletedCount }})
              </a>
              <a href="{{ route('admin.customers.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить клиента">
                <i class="fas fa-plus"></i> Добавить заказчика
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(isset($customers) && count($customers) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Фамилия</th>
                      <th class="th-middle">Имя</th>
                      <th class="th-middle">Email</th>
                      <th class="th-middle">Номер телефона</th>
                      <th class="th-middle">Адрес доставки</th>
                      <th class="th-middle">Комментарий</th>
                      <th class="th-middle">Заказы</th>
                      <th class="th-middle">Статус</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($customers as $customer)
                    <tr role="row" class="odd">
                      <td class="th-middle">{{ $customer->id }}</td>
                      <td class="th-middle">{{ $customer->last_name }}</td>
                      <td class="th-middle">{{ $customer->first_name }}</td>
                      <td class="th-middle">{{ $customer->email }}</td>
                      <td class="th-middle">{{ $customer->phone }}</td>
                      <td class="th-middle">{{ $customer->adress }}</td>
                      <td class="th-middle">{{ $customer->comment }}</td>
                      <td class="th-middle"></td>
                      <td class="th-middle">{!! ($customer->status === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}</td>
                      <td class="th-middle" style="width:130px;padding-left:16px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.customers.show', $customer->id) }}" title="Просмотреть данные">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.customers.edit', $customer->id) }}" title="Редактировать заказчика">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.customers.delete', $customer->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить заказчика">
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
                  Заказчики отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $customers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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