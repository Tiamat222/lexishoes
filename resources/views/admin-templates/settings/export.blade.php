@extends('layouts.admin-layouts.app')
@section('title', 'Экспорт')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Экспорт</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('export') }}
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
            <h3 class="card-title" style="margin-top: 5px;">
              <i class="fas fa-file-export"></i> Экспорт
            </h3>
          </div>
            <div class="card-body">
              @include('admin-templates.info-messages')
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-info">
                    <div class="card-header" style="background-color:#6c757d;">
                      <h3 class="card-title">Раздел</h3>
                    </div>
                    <form method="post" action="{{ route('admin.settings.export.unload') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="form-group">
                        <label for="inputStatus">Выберите раздел для экспорта</label>
                        <select class="form-control custom-select" name="table">
                        <option value="categories">Категории</option>
                        <option value="suppliers">Поставщики</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-info">
                    <div class="card-header" style="background-color:#6c757d;">
                      <h3 class="card-title">Расширение</h3>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="inputStatus">Выберите расширение файла</label>
                        <select class="form-control custom-select" name="extension">
                        <option value="xls">.xls</option>
                        <option value="ods">.ods</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-dark" id="save-button">
                <i class="fas fa-file-export" style="font-size:40px;"></i><br>  Экспорт
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection