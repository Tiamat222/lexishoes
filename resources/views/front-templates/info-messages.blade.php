@if($message = Session::get('warning_message'))
<div class="bs-callout bs-callout-warning">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <h4><i class="fa fa-warning" aria-hidden="true"></i> Внимание!</h4>
  <p>{{ $message }}</p>
</div>
@endif
@if($message = Session::get('error_message'))
<div class="bs-callout bs-callout-danger">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ошибка!</h4>
  <p>
    @if(is_array($message) && count($message) >= 1)
      @foreach($message as $errorMessage)
        - {{ $errorMessage }}<br>
      @endforeach
    @else 
      {{ $message }}
    @endif
  </p>
</div>
@endif
@if($message = Session::get('success_message'))
<div class="bs-callout bs-callout-success">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <h4><i class="fa fa-check" aria-hidden="true"></i> Успех!</h4>
  <p>{{ $message }}</p>
</div>
@endif
@if($errors->any())
<div class="bs-callout bs-callout-danger">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ошибка!</h4>
  <p>
    @foreach($errors->all() as $error)
      - {{ $error }}</br>
    @endforeach
  </p>
</div>
@endif