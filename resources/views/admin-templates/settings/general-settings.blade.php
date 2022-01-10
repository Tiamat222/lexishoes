@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Настройки сайта</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('general-settings') }}
          </div>
        </div>
      </div>
    </div>
  </section>
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
          - Meta-поля не обязательны к заполнению, но для лучшего ранжирования в выдаче поисковых систем их лучше заполнить.
          Также не рекомендуется выходить за рамки допустимой длины (она указана возле каждого поля).<br>
          - Также настоятельно рекомендуется загрузить логотип магазина (в противном случае будет выведена стандартная картинка-заглушка).
        </div>
      <div class="row">
        <div class="col-md-6">
          <form class="form-horizontal" method="POST" action="{{ route('admin.settings.generalSettings.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Title магазина</label>
            <div class="input-group mb-3">
              <input type="hidden" name="target" value="general_settings">
              <input type="text" class="form-control" name="store_title" value="{{ $settingsList['store_title'] }}">
            </div>                            
          </div>
          <div class="form-group">
            <label>Alias админ-панели</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="admin_page" value="{{ $settingsList['admin_page'] }}">
            </div>    
          </div>
          <div class="form-group">
            <label>Email администратора</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="admin_email" value="{{ $settingsList['admin_email'] }}">
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
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="store_logo">
              <label class="custom-file-label" for="customFile" data-browse="Выберите файл"></label>
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
  </section>
</div>
@endsection