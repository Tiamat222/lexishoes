@extends('layouts.admin-layouts.app')
@section('title', 'Редактирование поставщика')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Редактирование поставщика</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('add-supplier') }}
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
            <h3 class="card-title" style="float:left;margin-top:8px;">
              <i class="fas fa-truck"></i> Редактирование поставщика "{{ $supplier->name }}"
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.catalog.suppliers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина">
                <i class="fa fa-trash"> {{ $suppliersInTrash }}</i>
                Корзина
              </a>
              <a href="{{ route('admin.catalog.suppliers.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить нового поставщика">
                <i class="fas fa-plus"></i>
                Добавить поставщика
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-md-12">
                <div class="callout callout-warning" style="background:#F5E1B9">
                  <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
                  - Поле "Поставщик" обязательно к заполнению (минимальная длина - 2 символа, название поставщика должно быть уникальным).<br>
                  - Комментарий - служебная информация (доступна только администраторам, максимальная длина комментария - 300 символов). 
                  Это поле не обязательно к заполнению, но в него, например, вы можете ввести номера телефонов, адреса и т.д.
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('admin.catalog.suppliers.update', $supplier->id) }}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }} 
                  <div class="form-group row">
                    <input type="hidden" name="id" value="{{ $supplier->id }}">
                    <label class="col-sm-2 col-form-label">Поставщик<span style="color: red;">*</span></label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" value="{{ $supplier->name }}" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Комметарий</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" name="description">{{ $supplier->description }}</textarea>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-dark" id="save-button">
              <i class="fas fa-save"></i><br>  Сохранить
            </button>
            <a href="{{ route('admin.catalog.suppliers.index') }}" class="btn btn-dark second a-close">
              <i class="fas fa-window-close"></i><br>  Отмена
            </a>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
