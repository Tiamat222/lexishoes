@extends('layouts.admin-layouts.app')
@section('title', 'Создание нового заказчика')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Создание нового заказчика', 'breadcrumb' => 'create-customer'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top: 5px;">
              <i class="fas fa-user"></i> Новый заказчик
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.customers.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:130px;">
                <i class="fa fa-trash"></i> Корзина ({{ $softDeletedCount }})
              </a>
            </div>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="callout callout-warning" style="background:#F5E1B9; margin-top:8px;">
              <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
              - Все поля, отмеченные <span class="required-field">*</span>, обязательны к заполнению.<br>
              - Минимальная длина пароля - {{ get_setting('pwd_length') }} символов
            </div>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Данные заказчика</h3>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                          <form action="{{ route('admin.customers.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Имя<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name" value="" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Фамилия<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name" value="" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Тел.<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Дополнительный тел.</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="dop_phone" id="dop_phone" value="">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Адрес доставки</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="address">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Комментарий</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="comment">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Пароль<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-dark" id="save-button">
                        <i class="fas fa-save" style="font-size: 40px;"></i><br>  Сохранить
                      </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@push('customers')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ url('admin-template/dist/js/input-mask.js') }}"></script>
<script> 
  $(document).ready(function(){   
    $("#email").inputmask("email");
    $('#phone').inputmask("+38(999) 999-99-99");
    $('#dop_phone').inputmask("+38(999) 999-99-99");
  });
</script>
@endpush
@endsection