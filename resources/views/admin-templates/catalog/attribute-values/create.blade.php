@extends('layouts.admin-layouts.app')
@section('title', 'Новое значение атрибута')
@section('content')
<div class="content-wrapper">
  @include('layouts.admin-layouts.content-header', ['h1' => 'Новое значение атрибута', 'breadcrumb' => 'create-attribute-value'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top: 3px;">
              <i class="fa fa-plus" aria-hidden="true"></i> Новое значение
            </h3>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="callout callout-warning" style="background:#F5E1B9">
              <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
              - Поля "Атрибут" и "Значение" обязательны к заполнению.<br>
              - Минимальная длина названия атрибута - 2 символа.
            </div>
            <div class="card card-info">
              <div class="card-header" style="background-color:#6c757d;">
                <h3 class="card-title">Значение атрибута</h3>
              </div>
              <form action="{{ route('admin.catalog.attribute-values.store') }}" method="post">
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label"><strong>Атрибут</strong>*</label>
                        <select class="form-control select2 select2-hidden-accessible" name="attribute" id="attribute-value">
                          @if(count($allAttributes) > 0)
                            <option selected="selected" value="none">-</option>
                            @foreach($allAttributes as $attribute)
                              <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                          @endif
                        </select>
                        <input type="hidden" id="attribute-type" name="attribute-type" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label"><strong>Значение</strong>*</label>
                        </div>
                        <input type="text" id="input-name" name="name" class="form-control" data-colorpicker-id="1" data-original-title="" required>
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
@push('attribute-values')
<script src="{{ url('admin-template/dist/js/pages/admin/attribute-values.js') }}"></script>
<script src="{{ url('admin-template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('admin-template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endpush
@endsection