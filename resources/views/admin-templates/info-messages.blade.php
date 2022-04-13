@if($message = Session::get('warning_message'))
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-exclamation-triangle"></i> Внимание!</h5>
  {{ $message }}
</div>
@endif
@if($message = Session::get('error_message'))
<div class="alert callout callout-danger" style="background:#FF8080;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-ban"></i>Ошибка!</h5>
    @if(is_array($message) && count($message) >= 1)
      @foreach($message as $errorMessage)
        - {{ $errorMessage }}<br>
      @endforeach
    @else 
      {{ $message }}
    @endif
</div>
@endif
@if($message = Session::get('success_message'))
<div class="alert callout callout-success" style="background:#85BF73;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-check"></i> Успех!</h5>
  {{ $message }}         
</div>
@endif
@if($errors->any())
<div class="alert callout callout-danger" style="background:#FF8080;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h5><i class="icon fas fa-ban"></i>Ошибка!</h5>
    @foreach($errors->all() as $error)
        - {{ $error }}</br>
    @endforeach
</div>
@endif