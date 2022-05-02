@extends('layouts.admin-layouts.app')
@section('title', 'Логи магазина')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Логи', 'breadcrumb' => 'information'])
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
                      <textarea class="exclude" style="width:100%;height:400px;border:1px solid #DCDCDA;border-radius:5px;">{{ $value }}</textarea>
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