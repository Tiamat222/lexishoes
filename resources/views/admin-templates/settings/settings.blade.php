@extends('layouts.admin-layouts.app')
@section('title', 'Настройки магазина')
@section('content')
<div class="content-wrapper">
  @include('layouts.admin-layouts.content-header', ['h1' => 'Системная информация', 'breadcrumb' => 'general-settings'])
  <section class="content">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
        <i class="fas fa-cogs"></i> Общие настройки магазина
      </h3>
    </div>
    <div class="card-body">
        @include('admin-templates.info-messages')
        <div class="callout callout-warning" style="background:#F5E1B9">
          <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
          - Настоятельно рекомендуется загрузить логотип магазина (в противном случае будет выведена стандартная картинка-заглушка).<br>
          - Поле 'Email администратора' обязательно к заполнению.
        </div>
      <div class="row">
        <div class="col-md-6">
          <form class="form-horizontal" method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Title магазина</label>
            <div class="input-group mb-3">
              <input type="hidden" name="target" value="general_settings">
              <input type="text" class="form-control" name="store_title" value="{{ $settingsList['store_title'] }}">
            </div>                            
          </div>
          <div class="form-group">
            <label>Email администратора<span class="required-field">*</span></label>
            <div class="input-group mb-3">
              <input type="text" id="email" class="form-control" name="admin_email" value="{{ $settingsList['admin_email'] }}" required>
            </div>
          </div>
          <div class="form-group">
            <label>Язык магазина</label>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" id="customRadio1" name="site_language" value="rus" {{ ($settingsList['site_language'] == 'rus') ? 'checked' : '' }}>
              <label for="customRadio1" class="custom-control-label" style="font-weight: 500;">Русский</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" id="customRadio2" name="site_language" value="ua" {{ ($settingsList['site_language'] == 'ua') ? 'checked' : '' }}>
              <label for="customRadio2" class="custom-control-label" style="font-weight: 500;">Украинский</label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Логотип магазина</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" name="store_logo" lang="ru">
                  <label class="custom-file-label" for="customFile" data-browse="Выберите файл"></label>
                </div>
              </div>
              @if($settingsList['store_logo'] !== '')
              <div style="width:100px;margin-top:10px;">
                <img src="{{ url($settingsList['store_logo']) }}">
              </div>
              @endif
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-dark" id="save-button">
      <i class="fas fa-save"></i><br>  Сохранить
    </button>
    </form>
    </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
        <i class="fas fa-cogs"></i> Настройки админки
      </h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <form class="form-horizontal" method="POST" action="{{ route('admin.settings.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Кол-во элементов на странице</label>
            <div class="input-group mb-3">
              <input type="hidden" name="target" value="admin_settings">
              <input type="text" class="form-control" name="items_per_page" value="{{ $settingsList['items_per_page'] }}">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-dark" id="save-button">
      <i class="fas fa-save"></i><br>  Сохранить
    </button>
    </form>
    </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
        <i class="fas fa-cogs"></i> Настройки пользователей
      </h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <form class="form-horizontal" method="POST" action="{{ route('admin.settings.store') }}">
          {{csrf_field()}}
          <div class="form-group">
            <label>Длина пароля (не менее 6-ти символов)</label>
            <div class="input-group mb-3">
              <input type="hidden" name="target" value="user_settings">
              <input type="text" class="form-control" name="pwd_length" value="{{ $settingsList['pwd_length'] }}">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-dark" id="save-button">
      <i class="fas fa-save"></i><br>  Сохранить
    </button>
    </form>
    </div>
    </div>
  </section>
</div>
@push('settings')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ url('admin-template/dist/js/input-mask.js') }}"></script>
<script>
  $(document).ready(function(){
    $("#email").inputmask("email");
  });
</script>
@endpush
@endsection