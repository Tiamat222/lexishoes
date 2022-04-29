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
                <form action="" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-dark" id="save-button">
              <i class="fas fa-save" style="font-size: 40px;"></i><br>  Сохранить
            </button>
          </form>
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