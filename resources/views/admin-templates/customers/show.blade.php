@extends('layouts.admin-layouts.app')
@section('title', 'Детали заказчика')
@section('content')
<div class="content-wrapper">
  @include('layouts.admin-layouts.content-header', ['h1' => 'Детали заказчика', 'breadcrumb' => 'show-customer'])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="margin-top:7px;">
                <i class="fa fa-list-alt" aria-hidden="true"></i> Данные
              </h3>
              <div style="float:right;">
                <a href="{{ route('admin.customers.email', $customer->id) }}" class="btn btn-block btn-default btn-sm a-trash" title="Отправить на email" style="width:180px;">
                  <i class="fa fa-envelope"></i> На email (заказчику)
                </a>
                <a href="#" onclick="window.print()" class="btn btn-block btn-default btn-sm a-trash" title="На печать" style="width:100px;">
                  <i class="fa fa-print"></i> На печать
                </a>
                <a href="{{ route('admin.customers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:120px;">
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
                <div class="col-12 col-md-12 order-2 order-md-1">
                  <div class="row">
                    <div class="col-12">
                        <h3>Заказчик "{{ $customer->first_name . ' ' . $customer->last_name }}"</h3>
                        <p style="margin-top: 10px;">
                          <strong>Имя:</strong> {{ $customer->first_name }}<br>
                          <strong>Фамилия:</strong> {{ $customer->last_name }}<br>
                          <strong>Email:</strong> {{ $customer->email }}<br>
                          <strong>Телефон:</strong> {{ $customer->phone }}<br>
                          <strong>Адрес доставки:</strong> {{ $customer->address }}<br>
                          <strong>Комментарий:</strong> {{ $customer->comment }}<br>
                          <strong>Статус:</strong> {!! ($customer->status === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}
                        </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="padding:10px;">
              <div class="col-12 table-responsive">
                <h3>Заказы</h3>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Call of Duty</td>
                      <td>455-981-221</td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td>$64.50</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Need for Speed IV</td>
                      <td>247-925-726</td>
                      <td>Wes Anderson umami biodiesel</td>
                      <td>$50.00</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Monsters DVD</td>
                      <td>735-845-642</td>
                      <td>Terry Richardson helvetica tousled street art master</td>
                      <td>$10.70</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Grown Ups Blue Ray</td>
                      <td>422-568-642</td>
                      <td>Tousled lomo letterpress</td>
                      <td>$25.99</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection