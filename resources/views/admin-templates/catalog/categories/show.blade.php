@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Просмотр категории</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('show-category') }}
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
                <i class="fa fa-list-alt" aria-hidden="true"></i> Категория "{{ $category->name }}"
              </h3>
              <div style="float:right;">
                <a href="" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width: 200px;;">
                  <i class="fas fa-minus-circle"></i>
                  Отключенные категории
                </a>
                <a href="{{ route('admin.catalog.categories.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина">
                  <i class="fa fa-trash"> </i>
                  Корзина
                </a>
                <a href="{{ route('admin.catalog.categories.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить новую категорию">
                  <i class="fas fa-plus"></i>
                  Добавить категорию
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                  <div class="row">
                    <div class="col-6">
                      <p><h3>SEO</h3></p>
                        <p style="margin-top: 10px;">
                          <strong>Meta-заголовок:</strong> {{ $category->meta_title }}<br>
                          <strong>Meta-описание:</strong> {{ $category->meta_description }}<br>
                          <strong>Meta-ключи:</strong> {{ $category->meta_keywords }}
                        </p>
                        <hr>
                      <p><h3>Изображение категории</h3></p>
                        <p style="margin-top: 10px;">
                          <div id="category-img">
                            @if($category->category_image)
                              <img src="{{ asset($category->category_image) }}"/>
                            @else
                              Изображение отсутствует
                            @endif
                          </div>
                        </p>
                        <hr>
                      <p><h3>Статус категории</h3></p>
                        @if($category->is_active == 1)
                          <span style="color:green">Категория активна</span>
                        @else
                        <span style="color:red">Категория неактивна</span>
                        @endif
                        <hr>
                      <p><h3>Дата создания</h3></p>
                        <p>{{ $category->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-6">
                      <p><h3>Описание категории</h3></p>
                        <div style="padding:5px 5px 5px 5px;">
                        {!! $category->description !!}
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                  <p><h3>Древо категорий</h3></p>
                  <nav class="primaryNav">
                    <ul>
                      @for($i=0; $i <= count($categoriesTree)-1; $i++)
                        @if($i == 0)
                          <li>
                          <a href="">{{ $categoriesTree[$i] }}</a>
                        @elseif($i == 1)
                          <ul>
                          <li><a href="">{{ $categoriesTree[$i] }}</a></li>
                        @elseif($i == count($categoriesTree)-1)
                          <li><a href="">{{ $categoriesTree[$i] }}</a></li>
                            </ul>
                          </li>
                        @else
                          <li><a href="">{{ $categoriesTree[$i] }}</a></li>
                        @endif
                      @endfor
                    </ul>
                  </nav>
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