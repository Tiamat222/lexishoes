@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Логи</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('log') }}
          </ol>
        </div>
      </div>
    </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              @include('admin-templates.info-messages')
              @foreach($logs as $key => $value)
                <div class="col-md-12">
                  <div class="card card-primary">
                    <div class="card-body">
                      <div class="form-group">
                        <p>Имя файла {{ $key }}</p>
                        <textarea style="width:100%; height:400px; border:1px solid grey; border-radius:5px;">{{ $value }}</textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <a href="{{ route('admin.settings.log.clear', $key) }}" class="btn btn-secondary">Очистить {{ $key }}</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection