@extends('layouts.admin-layouts.app')
@section('title', 'Список значений атрибута "' . $attributeName . '"')
@section('content')
<div class="content-wrapper">
  @include('layouts.admin-layouts.content-header', ['h1' => 'Список значений атрибута "' . $attributeName . '"', 'breadcrumb' => 'attribute-values'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:7px;">
              <i class="fa fa-industry" aria-hidden="true"></i> Значения атрибута "{{ $attributeName}}"
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
            <div class="row">
              <div class="col-sm-12">
                @if(count($attributeValues) > 0)
                <table class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle" style="width:50px;">ID</th>
                      <th class="th-middle">Значения</th>
                      <th class="th-middle">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attributeValues as $value)
                    <tr role="row" class="odd">
                      <td class="th-middle" style="width:50px;">{{ $value->id }}</td>
                      <td class="th-middle">
                        @if($attributeName == 'Цвет верха' || $attributeName == 'Цвет подошвы')
                          <a href="{{ route('admin.catalog.attribute-values.edit', $value->id) }}" title="Редактировать атрибут">
                              <div style="width:40px;height:40px;margin:0 auto;background-color:{{ $value->value }}"></div>
                          </a>
                        @else
                          <a href="{{ route('admin.catalog.attribute-values.edit', $value->id) }}" title="Редактировать значение атрибута">
                            {{ $value->value }}
                          </a>
                        @endif
                      </td>
                      <td style="width:80px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.attribute-values.edit', $value->id) }}" title="Редактировать значение атрибута">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.catalog.attribute-values.destroy', $value->id) }}" method="POST">
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
                  У атрибута "{{ $attributeName}}" отсутствуют значения
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $attributeValues->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div id="page-cover"></div>
@endsection
