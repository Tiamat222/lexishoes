@extends('layouts.admin-layouts.app')
@section('title', 'Просмотр поставщика')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Просмотр поставщика</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('show-supplier') }}
          </div>
        </div>
      </div>
    </div> 
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="margin-top: 9px;">
                <i class="fa fa-list-alt" aria-hidden="true"></i> Поставщик "{{ $supplier->name }}"
              </h3>
              <div style="float:right;">
                <a href="{{ route('admin.catalog.suppliers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина">
                  <i class="fa fa-trash"> </i>
                  Корзина
                </a>
                <a href="{{ route('admin.catalog.suppliers.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить нового поставщика">
                  <i class="fas fa-plus"></i>
                  Добавить поставщика
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12 order-2 order-md-1">
                  <div class="row">
                    <div class="col-12">
                      <p><h3>Общие данные</h3></p>
                        <p style="margin-top: 10px;">
                          <strong>Название поставщика:</strong> {{ $supplier->name }}<br>
                          <strong>Комментарий:</strong> {{ $supplier->description }}<br>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="padding:10px;">
              <div class="col-12 table-responsive">
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