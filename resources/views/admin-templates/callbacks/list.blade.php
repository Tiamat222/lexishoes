@extends('layouts.admin-layouts.app')
@section('title', 'Список обратных звонков')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Список обратных звонков', 'breadcrumb' => 'callbacks'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;">
              <i class="fas fa-reply"></i> Обратные звонки
            </h3>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(isset($callbacks) && count($callbacks) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Имя</th>
                      <th class="th-middle">Номер телефона</th>
                      <th class="th-middle">Комментарий</th>
                      <th class="th-middle">Дата</th>
                      <th class="th-middle">Статус</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($callbacks as $callback)
                    <tr role="row" class="odd">
                      <td class="th-middle">{{ $callback->id }}</td>
                      <td class="th-middle"><a href="{{ route('admin.callbacks.edit', $callback->id) }}">{{ $callback->name }}</a></td>
                      <td class="th-middle">{{ $callback->phone }}</td>
                      <td class="th-middle">{{ Str::limit($callback->comment, 150) }}</td>
                      <td class="th-middle">{{ $callback->created_at }}</td>
                      <td class="th-middle">
                        @if($callback->status === 1)
                          <span class="processed">Обработанный</span>
                        @else
                          <span class="raw">Новый</span>
                        @endif
                      </td>
                      <td class="th-middle" style="width:100px;padding-left:16px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.callbacks.edit', $callback->id) }}" title="Редактировать обратный звонок">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.callbacks.destroy', $callback->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить обратный звонок">
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
                  Обратные звонки отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $callbacks->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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