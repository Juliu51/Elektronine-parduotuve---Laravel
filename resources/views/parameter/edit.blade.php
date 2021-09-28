@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Atnaujinti</div>

            <div class="card-body">
               <form method="POST" action="{{route('parameter.update',$parameter)}}">
                  <div class="form-group">
                      <label>Parametro pavadinimas</label>
                      <input type="text" name="title" value="{{$parameter->title}}" class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Matmens pavadinimas</label>
                      <input type="text" name="data_type" value="{{$parameter->data_type}}" class="form-control">
                      <small class="form-text text-muted">kg,cm,ml..</small>
                  </div>
                  @csrf
                  <button class="btn btn-success" type="submit">Atnaujint</button>
</form>
                     </div>
            </div>
         </div>
      </div>
   </div>
   
</div>
@endsection