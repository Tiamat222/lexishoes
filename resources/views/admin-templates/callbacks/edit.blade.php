@extends('layouts.admin-layouts.app')
@section('title', 'Просмотр обратного звонка')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Детали обратного звонка', 'breadcrumb' => 'edit-callback'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;">
              <i class="fas fa-pencil-alt"></i> Обратный звонок
            </h3>
          </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row" style="margin-top:10px;">
              <div class="col-md-3">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Данные запроса</h3>
                  </div>
                  <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Имя</b> <span class="float-right">{{ $callback->name }}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Тел.</b> <span class="float-right">{{ $callback->phone }}</span>
                      </li>
                      <li class="list-group-item">
                        <b>Статус</b> 
                        <span class="float-right">
                        <form method="POST" action="{{ route('admin.callbacks.update', $callback->id) }}">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
                          <input type="hidden" name="id" value="{{ $callback->id }}">
                          <div class="form-group">
                            <select class="custom-select" name="status">
                              <option value="0" {{ ($callback->status == 0) ? 'selected' : '' }}>Новый</option>
                              <option value="1" {{ ($callback->status == 1) ? 'selected' : '' }}>Обработанный</option>
                            </select>
                          </div>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Ваш комментарий к обратному звонку</h3>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <div class="post">
                          <textarea style="width: 100%;" name="comment">{{ $callback->comment }}</textarea>
                        </div>
                      </div>
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection