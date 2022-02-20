@extends('layouts.admin-layouts.app')
@section('title', 'Список атрибутов товаров')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Список атрибутов</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('attributes') }}
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
              <i class="fa fa-industry" aria-hidden="true"></i> Атрибуты
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.catalog.attributes.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить новый атрибут">
                <i class="fas fa-plus"></i>
                Добавить атрибут
              </a>
              <a href="{{ route('admin.catalog.attribute-values.create') }}" class="btn btn-block btn-default btn-sm a-plus" style="margin-left:5px;" title="Добавить значение">
                <i class="fas fa-plus"></i>
                Добавить значение
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
              @if(count($allAttributes) > 0)
              <div class="callout callout-warning" style="background:#F5E1B9">
                <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
                - <strong>При удалении атрибута также будут удалены все его значения (безвозвратно)</strong>
              </div>
              @endif
            <div class="row">
              <div class="col-sm-12">
                @if(count($allAttributes) > 0)
                <table class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle" style="width:70px;">ID</th>
                      <th class="th-middle">Атрибут</th>
                      <th class="th-middle">Кол-во значений</th>
                      <th class="th-middle">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allAttributes as $attribute)
                    <tr role="row" class="odd">
                      <td class="th-middle" style="width:50px;">{{ $attribute->id }}</td>
                      <td class="th-middle"><a href="{{ route('admin.catalog.attributes.edit', $attribute->id) }}" title="Редактировать атрибут">{{ $attribute->name }}</a></td>
                      <td class="th-middle" style="width:100px;">
                        @if($attribute->count !== 0)
                          <a href="{{ route('admin.catalog.attribute-values.valuesList', $attribute->id) }}" title="Список значение">{{ $attribute->count }}</a>
                        @else
                          {{ $attribute->count }}
                        @endif
                      </td>
                      <td style="width:80px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.attributes.edit', $attribute->id) }}" title="Редактировать атрибут">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.catalog.attributes.destroy', $attribute->id) }}" method="POST">
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
                  Атрибуты отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $allAttributes->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('attribute-values')
<script src="{{ url('admin-template/dist/js/pages/admin/attribute.js') }}"></script>
@endpush
@endsection
