@extends('layouts.admin-layouts.app')
@section('title', 'Список страниц')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Список страниц', 'breadcrumb' => 'pages'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:7px;">
              <i class="fa fa-file" aria-hidden="true"></i> Страницы
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.catalog.pages.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить новую страницу">
                <i class="fas fa-plus"></i> Добавить страницу
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-sm-12">
                @if(isset($pages) && count($pages) > 0)
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr role="row">                  
                      <th class="th-middle">ID</th>
                      <th class="th-middle">Название статьи</th>
                      <th class="th-middle">Slug</th>
                      <th class="th-middle">Текст статьи</th>
                      <th class="th-middle">Статус</th>
                      <th class="th-middle" style="width:100px;">Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pages as $page)
                    <tr role="row" class="odd">
                      <td class="th-middle">{{ $page->id }}</td>
                      <td class="th-middle"><a href="{{ route('admin.catalog.pages.edit', $page->id) }}" title="{{ $page->title }}">{{ $page->title }}</a></td>
                      <td class="th-middle">{{ $page->slug }}</td>
                      <td class="th-middle">{{ strip_tags(Str::limit($page->text, 150, $end='...')) }}</td>
                      <td class="th-middle">{!! ($page->status === 1) ? '<i class="fa fa-check" aria-hidden="true" style="color: #95cc6b;"></i>' : '<i class="fa fa-times" aria-hidden="true" style="color:#ff5450"></i>' !!}</td>
                      <td class="th-middle" style="width:80px;padding-left:18px;">
                        <a class="btn btn-block btn-secondary btn-sm in-list-edit" href="{{ route('admin.catalog.pages.edit', $page->id) }}" title="Редактировать страницу">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.catalog.pages.destroy', $page->id) }}" method="POST">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button type="submit" class="btn btn-block btn-secondary btn-sm in-list-del" title="Удалить страницу">
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
                  Страницы отсутствуют в базе данных
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                  {{ $pages->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
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