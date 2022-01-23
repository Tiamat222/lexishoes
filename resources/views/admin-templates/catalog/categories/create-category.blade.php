@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Добавить категорию</h1>
        </div>
        <div class="col-sm-6">
          <div class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('create-category') }}
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
            <h3 class="card-title" style="margin-top: 12px;">
              <i class="fa fa-plus" aria-hidden="true"></i> Новая категория
            </h3>
            <div style="float:right;margin-bottom:5px;">
              <a href="" class="btn btn-block btn-default btn-sm a-trash" title="Корзина" style="width: 200px;;">
                <i class="fas fa-minus-circle"></i>
                Отключенные категории
              </a>
              <a href="" class="btn btn-block btn-default btn-sm a-trash" title="Корзина">
                <i class="fa fa-trash"> </i>
                Корзина
              </a>
            </div>
          </div>
            <div class="card-body">
              @include('admin-templates.info-messages')
              <div class="callout callout-warning" style="background:#F5E1B9">
                <h5><i class="icon fas fa-info"></i> Обратите внимание!</h5>
                - Название категории. Обязательно к заполнению. Должно быть уникальным. В названии категории запрещено использовать следующие символы: @^&*:`~'><\"<br>
                - Slug. Обязательно к заполнению. Slug категории должен быть уникальным. Допускаются только буквы латинского алфавита, цифры и дефис ("-"). 
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-info">
                    <div class="card-header" style="background-color:#6c757d;">
                      <h3 class="card-title">Основное</h3>
                    </div>
                    <form method="post" action="{{ route('admin.catalog.categories.store') }}" enctype="multipart/form-data" id="add-category-form">
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="is_active" checked>
                          <label for="customCheckbox2" class="custom-control-label">Статус категории (по умолчанию вкл.)</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label"><strong>Название категории</strong>*</label>
                        </div>
                        <input type="text" id="input-name" name="name" class="form-control categoty-name" required>
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label class="control-label"><strong>Slug</strong>*</label>
                        </div>
                        <input type="text" id="input-slug" name="slug" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="inputDescription"><strong>Описание категории</strong></label>
                        <textarea id="inputDescription" class="form-control" rows="4" name="description"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="inputStatus"><strong>Родительская категория</strong></label>
                        <ul class="checktree">
                          @foreach ($categories as $category)
                            <li><input type="radio" name="category_id" value="{{ $category->id }}"> {{ $category->name }}
                              <ul>
                                @foreach ($category->childrenCategories as $childCategory)
                                  @include('admin-templates.catalog.categories.child-categories', ['child_category' => $childCategory])
                                @endforeach
                              </ul>
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
                      <h3 class="card-title">Cover категории</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputFile"><strong>Загрузка изображения</strong></label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="category_image">
                              <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="card card-info">
                    <div class="card-header" style="background-color:#6c757d;">
                      <h3 class="card-title">SEO</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="required">
                          <label><strong>Мета-заголовок</strong></label>
                        </div>
                        <input type="text" id="meta-title" name="meta_title" class="form-control">
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label><strong>Мета описание</strong></label>
                        </div>
                        <input type="text" id="meta-description" name="meta_description" class="form-control">
                      </div>
                      <div class="form-group">
                        <div class="required">
                          <label><strong>Мета ключевые слова</strong></label>
                        </div>
                        <input type="text" id="meta-keywords" name="meta_keywords" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-dark" id="save-button">
                <i class="fas fa-save" style="font-size: 60px;"></i><br>  Сохранить
              </button>
              <a href="" class="btn btn-dark second" style="float:right;">
                <i class="fas fa-window-close" style="font-size: 60px;"></i><br>  Отмена
              </a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>
@push('category')
<script src="{{ url('admin-template/dist/js/pages/admin/category.js') }}"></script>
@endpush
@endsection