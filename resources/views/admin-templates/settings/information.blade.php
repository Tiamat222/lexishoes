@extends('layouts.admin-layouts.app')
@section('content')
<div class="content-wrapper">
@include('layouts.admin-layouts.content-header', ['h1' => 'Системная информация', 'breadcrumb' => 'information'])
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Системная информация
            </h3>
            </div>
          <div class="card-body">
            @include('admin-templates.info-messages')
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="m-0">Информация о сервере</h5>
                  </div>
                  <div class="card-body">
                    @if($dataArray['serverInfo'])
                      @foreach($dataArray['serverInfo'] as $item)
                        <p>{!! $item !!}</p>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="m-0">Информация о магазине</h5>
                  </div>
                  <div class="card-body">
                    @if($dataArray['storeInfo'])
                      @foreach($dataArray['storeInfo'] as $item)
                        <p>{!! $item !!}</p>
                      @endforeach
                    @endif
                  </div>
                </div>
                @if($dataArray['clientAgent'])
                  <div class="card">
                    <div class="card-header">
                      <h5 class="m-0">Информация о магазине</h5>
                    </div>
                    <div class="card-body">
                      <p>{!! $dataArray['clientAgent'] !!}</p>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection