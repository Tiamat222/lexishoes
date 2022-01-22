@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Список категорий</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('categories') }}
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
            <h3 class="card-title" style="margin-top: 9px;">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Категории
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
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">
                        ID
                      </th>
                      <th class="th-middle">
                        Категория
                      </th>
                      <th class="th-middle" style="width:450px;">
                        Описание
                      </th>
                      <th class="th-middle" style="width:250px;">
                        Кол-во товаров в категории
                      </th>
                      <th class="th-middle">
                        Родительская категория
                      </th>
                      <th class="th-middle">
                        Дата создания
                      </th>
                      <th class="th-middle">
                        Статус
                      </th>
                      <th class="th-middle">
                        Cover категории
                      </th>
                      <th class="th-middle" style="width:100px;">
                        Действия
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allCategories as $category)
                    <tr role="row" class="odd">
                      <td class="th-middle">{{ $category->id }}</td>
                      <td class="th-middle"><a href="{{ route('admin.catalog.categories.show', $category->id) }}" title="">{{ $category->name }}</a></td>
                      <td class="th-middle">{{ html_entity_decode(strip_tags(Str::limit($category->description, 150))) }}</td>
                      <td class="th-middle">0</td>
                      <td class="th-middle">{{ (isset($category->parent->name)) ? $category->parent->name : '-' }}</td>
                      <td class="th-middle">{{ $category->created_at->format('d/m/Y') }}</td>
                      <td class="th-middle">{!! ($category->is_active === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}</td>
                      <td class="cell-align">
                        <div style="text-align:center;">
                          @if($category->category_image)
                            <img src="{{ asset($category->category_image) }}"/>
                          @endif
                        </div>
                      </td>
                      <td class="th-middle" style="width:130px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.categories.show', $category->id) }}" title="Просмотреть данные">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.categories.edit', $category->id) }}" title="Редактировать">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.catalog.categories.delete', $category->id) }}" method="POST">
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
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    {{ $allCategories->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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