@extends('layouts.admin-layouts.app')
@section('title', 'Детали заказа')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Детали заказа #' . $order->order_id, 'breadcrumb' => 'order-details'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:6px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Заказ #{{ $order->order_id }}
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
                <div class="top-order-strip">
                  @if(isset($status))
                    <form action="{{ route('admin.orders.update_status') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $order->id }}">
                      <select class="custom-select select-status" name="status" style="width:200px;float:left;">
                        @foreach($status as $key => $value)
                          <option value="{{ $key }}" {{ ($order->status == $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                      </select>
                      <button type="submit" class="btn btn-block btn-default" style="width:150px;float:left;margin-left:5px;">Обновить статус</button>
                    </form>
                    <a href="#" onclick="window.print()" class="btn btn-block btn-default" style="width:180px;float:left;margin-left:5px;"><i class="fa fa-print"></i> Распечатать заказ</a>
                  @endif
                </div>
              </div>
            </div>
            <div class="row" style="margin-top:10px;">
              <div class="col-md-3">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Заказчик</h3>
                  </div>
                  <div class="card-body box-profile">
                    @if(isset($order->customers) && count($order->customers) == 1)
                      @foreach($order->customers as $customer)
                      <h3 class="profile-username text-center">{{ $customer->first_name . ' ' . $customer->last_name }}</h3>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Email</b> <span class="float-right">{{ $customer->email }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Тел.</b> <span class="float-right">{{ $customer->phone }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Доп тел.</b> <span class="float-right">{{ ($customer->dop_phone) ? $customer->dop_phone : 'Отсутствует' }}</span>
                        </li>
                        <li class="list-group-item">
                          <b>Адрес доставки</b><p>{{ $customer->address }}</p>
                        </li>
                        <li class="list-group-item">
                          <b>Комментарий заказчика</b><p>{{ $customer->comment }}</p>
                        </li>
                      </ul>
                      <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-secondary btn-block"><b>Все данные заказчика</b></a>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Внутренний комментарий к заказу</h3>
                  </div>
                  <div class="card-body box-profile">
                    <form action="{{ route('admin.orders.save_comment', $order->id) }}" method="POST">
                      {{ csrf_field() }}
                      <textarea class="inner-order-comment" name="comment" style="width:100%;border:1px solid #DCDCDA;border-radius:5px;"></textarea>
                      <button type="submit" class="btn btn-block btn-default" style="width:200px;">Добавить комментарий</button>
                    </form>
                    <br>
                    @if(isset($order->comments) && count($order->comments) > 0)
                    <ul class="list-group list-group-unbordered mb-3">
                      @foreach($order->comments as $comment)
                        <li class="list-group-item">
                          <b>{{ $comment->admin_login }} ({{ $comment->created_at }})</b><p>{{ $comment->comment }}</p>
                        </li>
                      @endforeach
                    </ul>
                    @endif
                  </div>
                </div>


              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-dark" id="save-button">
              <i class="fas fa-save" style="font-size: 40px;"></i><br>  Сохранить
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('order')
<script src="{{ url('admin-template/dist/js/pages/admin/order.js') }}"></script>
@endpush
@endsection