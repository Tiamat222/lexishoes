@extends('layouts.admin-layouts.app')
@section('title', 'Редактирование атрибута ' . '"' . $attribute->name . '"')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Редактирование атрибута '{{ $attribute->name }}'</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('edit-attribute') }}
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
            <h3 class="card-title" style="margin-top: 7px;">
              <i class="fas fa-pencil-alt"></i> Редактирование атрибута
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
              <div class="callout callout-warning" style="background:#F5E1B9">
                <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
                - Поле "Название атрибута" обязательно к заполнению, минимальная длина - 2 символа. 
              </div>
              <div class="card card-info">
                <div class="card-header" style="background-color:#6c757d;">
                  <h3 class="card-title">Название атрибута</h3>
                </div>
                <form action="{{ route('admin.catalog.attributes.update', $attribute->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }} 
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label"><strong>Название атрибута</strong>*</label>
                        </div>
                        <input type="text" id="input-name" name="name" class="form-control categoty-name" value="{{ $attribute->name }}" required>
                        <input type="hidden" name="id" value="{{ $attribute->id }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-dark" id="save-button">
                    <i class="fas fa-save" style="font-size: 40px;"></i><br>  Сохранить
                  </button>
                  <a href="" class="btn btn-dark second" style="float:right;">
                    <i class="fas fa-window-close" style="font-size: 40px;"></i><br>  Отмена
                  </a>
                </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection