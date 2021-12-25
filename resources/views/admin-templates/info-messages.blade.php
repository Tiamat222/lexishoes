@if($message = Session::get('warning_message'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Внимание!</h5>
    {{ $message }}
</div>
@endif
@if($message = Session::get('error_message'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Внимание!</h5>
    {{ $message }}
</div>
@endif
@if($message = Session::get('success_message'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="fas fa-fw fa-check-circle"></i> Успех!</h5>
    {{ $message }}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Внимание!</h5>
    @foreach($errors->all() as $error)
        {{ $error }}</br>
    @endforeach
</div>
@endif