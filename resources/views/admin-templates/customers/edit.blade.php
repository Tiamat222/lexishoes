@extends('layouts.admin-layouts.app')
@section('title', 'Редактирование заказчика ' . $customer->first_name . ' ' . $customer->last_name)
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Редактирование заказчика ' . $customer->first_name . ' ' . $customer->last_name, 'breadcrumb' => 'edit-customer'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top: 5px;">
              <i class="fas fa-user"></i> Редактирование заказчика
            </h3>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Данные заказчика</h3>
                    </div>
                    <div class="card-body">
                      <div class="callout callout-warning" style="background:#F5E1B9; margin-top:8px;">
                        <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
                        - Все поля, отмеченные <span class="required-field">*</span> обязательны к заполнению.<br>
                        - Минимальная длина пароля - {{ get_setting('pwd_length') }} символов
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                          <form action="{{ route('admin.customers.update', $customer->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Имя<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Фамилия<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name" value="{{ $customer->last_name }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Email<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Тел.<span class="required-field">*</span></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $customer->phone }}" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Дополнительный тел.</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="dop_phone" id="dop_phone" value="{{ $customer->dop_phone }}">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Адрес доставки</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="{{ $customer->address }}">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Комментарий</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="comment" value="{{ $customer->comment }}">
                                <input type="hidden" name="id" value="{{ $customer->id }}">
                              </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Пароль</label>
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
@push('admin-profile')
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