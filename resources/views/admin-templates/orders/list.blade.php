@extends('layouts.admin-layouts.app')
@section('title', 'Список заказов')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Список заказов', 'breadcrumb' => 'orders'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:6px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Заказы
            </h3>
            <div style="float:right;">
              <a href="" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:130px;">
                <i class="fa fa-trash"></i> Корзина ()
              </a>
              <a href="" class="btn btn-block btn-default btn-sm a-plus" title="Добавить заказ">
                <i class="fas fa-plus"></i> Добавить заказ
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(isset($orders) && count($orders) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle"># заказа</th>
                      <th class="th-middle">Заказчик</th>
                      <th class="th-middle">Комментарий</th>
                      <th class="th-middle">Итоговая цена</th>
                      <th class="th-middle">Статус заказа</th>
                      <th class="th-middle">Дата заказа</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr role="row" class="odd">
                      <td class="th-middle" style="width:40px;">{{ $order->id }}</td>
                      <td class="th-middle" style="width:40px;">{{ $order->order_id }}</td>
                      <td class="th-middle">
                          @foreach($order->customers as $customer)
                            {{ $customer->first_name . ' ' . $customer->last_name }}
                          @endforeach
                      </td>
                      <td class="th-middle">

                      </td>
                      <td class="th-middle" style="width:100px;">{{ $order->total_price }}</td>
                      <td class="th-middle" style="width:250px;">
                        @if($order->status === 0)
                          <span class="new-order">Новый заказ</span>
                        @endif
                      </td>
                      <td class="th-middle" style="width:200px;">{{ $order->created_at }}</td>
                      <td class="th-middle" style="width:100px;padding-left:18px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.orders.edit', $order->id) }}" title="Детали заказа">
                          <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить заказ">
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
                  Заказы отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $orders->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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