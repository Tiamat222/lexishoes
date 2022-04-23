@extends('layouts.admin-layouts.app')
@section('title', 'Редактирование администратора ' . $admin->login )
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Редактирование администратора ' . $admin->login, 'breadcrumb' => 'edit-admin'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top: 7px;">
              <i class="fa fa-plus" aria-hidden="true"></i> Редактирование администратора
            </h3>
            <div style="float:right;">
              <a href="{{ route('admin.settings.admins.activity') }}" class="btn btn-block btn-default btn-sm a-trash" title="Активность на сайте" style="width:170px;">
                <i class="fas fa-tasks"></i> Активность на сайте
              </a>
              <a href="{{ route('admin.settings.admins.trash') }}" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width:130px;">
                <i class="fa fa-trash"></i> Корзина ({{ $adminsInTrash }})
              </a>
              <a href="{{ route('admin.settings.admins.create') }}" class="btn btn-block btn-default btn-sm a-plus" title="Добавить администратора" style="width:230px;">
                <i class="fas fa-plus"></i> Добавить администратора
              </a>
            </div>
          </div>
          <form method="post" action="{{ route('admin.settings.admins.update', $admin->id) }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="callout callout-warning" style="background:#F5E1B9">
              <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
              - Все поля, отмеченные <span class="required-field">*</span>, обязательны к заполнению<br>
              - Длина логина от 3 до 20 символов
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card card-info">
                  <div class="card-header" style="background-color:#6c757d;">
                    <h3 class="card-title">Данные администратора</h3>
                  </div>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="status" {{ ($admin->status == 1) ? 'checked' : '' }}>
                          <label class="custom-control-label" for="customSwitch3">Статус</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label">Логин<span class="required-field">*</span></label>
                        </div>
                        <input type="text" name="login" id="login" class="form-control categoty-name" value="{{ $admin->login }}" required>
                        <input type="hidden" name="permissions" id="admin-permissions">
                        <input type="hidden" name="id" id="id" value="{{ $admin->id }}">
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label">Email<span class="required-field">*</span></label>
                        </div>
                        <input type="text" id="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label">Тел.<span class="required-field">*</span></label>
                        </div>
                        <input type="text" id="phone" name="telephone" class="form-control" value="{{ $admin->telephone }}" required>
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label">Новый пароль</label>
                        </div>
                        <input type="password" class="form-control" name="newPwd" id="newPwd">
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label">Подтвердите пароль</label>
                        </div>
                        <input type="password" class="form-control" name="confirmPwd" id="confirmPwd">
                      </div>
                      <hr>
                      <div class="col-sm-6" style="float:left;">
                        <div class="form-group">
                          <label>Права доступа</label>
                          <select class="form-control">
                            @foreach($permissions as $key => $value)
                              <option id="{{ $key }}" value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                          </select>
                          <button type="button" id="add-permission" class="btn btn-block btn-default" style="width:100px;margin-top:5px;">Добавить</button>
                        </div>
                      </div>
                      <div class="col-sm-6 selected" style="float:left;">
                        <ul class="admin-perms">
                          @foreach($adminPermissions as $key => $value)
                          <li style="list-style-type: none;" id="li-{{ $key }}">{{ $value }}
                            <a href="#" class="close" aria-label="Close" onclick="destroyElem({{ $key }}); event.preventDefault();">
                              <span aria-hidden="true">x</span>               
                            </a>
                          </li>
                          @endforeach              
                        </ul>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-info">
                  <div class="card-header" style="background-color:#6c757d;">
                    <h3 class="card-title">Аватар администратора</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputFile">Загрузка изображения</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile" name="avatar" lang="ru">
                          <label class="custom-file-label" for="customFile"></label>
                        </div>
                      </div>
                        @if($admin->avatar)
                        <div id="upload-img-edit">
                          <img src="{{ asset(show_avatar($admin->avatar)) }}" style="margin-top:10px;"/>
                        </div>
                        @endif
                    </div>
                  </div>
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
  </section>
</div>
@push('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ url('admin-template/dist/js/input-mask.js') }}"></script>
<script src="{{ url('admin-template/dist/js/pages/admin/admin-profile.js') }}"></script>
<script src="{{ url('admin-template/dist/js/pages/admin/admin-settings.js') }}"></script>
<script> 
  $(document).ready(function(){   
    $("#email").inputmask("email");
    $('#phone').inputmask("+38(999) 999-99-99");
  });
</script>
@endpush
@endsection