@extends('layouts.admin-layouts.app')
@section('title', 'Корзина')
@section('content')
<div class="content-wrapper">
  @include('layouts.admin-layouts.content-header', ['h1' => 'Корзина', 'breadcrumb' => 'trash-customers'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="float:left;margin-top:7px;">
              <i class="fas fa-trash"></i> Корзина
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.customers.create') }}" class="btn btn-block btn-default btn-sm" style="width:180px;float:left;" title="Добавить нового поставщика">
                <i class="fas fa-plus" style="color:#666666;"></i>
                Добавить поставщика
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
                      <th class="th-middle">Адрес</th>
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
                      <td class="th-middle">-</td>
                      <td class="th-middle">{!! ($customer->status === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}</td>
                      <td class="th-middle" style="width:90px;">
                        <a class="btn btn-secondary btn-sm" style="float:left;width:30px;margin:0px 5px 0px 5px;" href="{{ route('admin.customers.restore', $customer->id) }}" title="Восстановить">
                          <i class="fas fa-trash-restore"></i>
                        </a>
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-secondary btn-sm" style="float:left;width:30px;" title="Удалить навсегда">
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