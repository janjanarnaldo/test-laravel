@extends('layouts.main')

@section('content')
<?php $val = session('val'); ?>

<section class="orders section-spacing text-center" id="orders">
  <div class="container">
    
    <div class="col-md-offset-1 col-md-10 text-left">
      @if (session('success'))
        <span class="alert alert-success">{{ session('success') }}</span>
      @endif

      @if (session('error'))
        <ul class="alert alert-warning">
          <li><h4>Errors:</h4></li>
          @foreach(session('error') as $err)
            <li><b>{{$err}}<b></li>
          @endforeach
        </ul>
      @endif
    </div>

    <br>

    <div class="col-md-offset-1 col-md-10">
      <header class="section-header">
        <h2>Order Form</h2>
      </header>
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
            {!!Form::open(array('url' => 'order', 'id'=>'order-form', 'class'=>'form-horizontal text-center'))!!}
              <br>
              @foreach($fields as $field)
                <div class="form-group">
                  <div class="col-md-6 text-left">
                    <label>{{$field->label}} *</label><br>
                    <p class="note">{{$field->note}}</p>
                  </div>
                  <div class="col-md-6">
                    @if($field->type == 'radio')
                      Yes <input type="radio" class="{{$field->class}}" name="{{$field->name}}" value="yes" 
                            <?php 
                              if(isset($val[$field->name])){
                                  if($val[$field->name] == "yes"){
                                    echo 'checked';
                                  }
                              }
                            ?>
                            required>
                      No <input type="radio" class="{{$field->class}}" name="{{$field->name}}" 
                            <?php 
                              if(isset($val[$field->name])){
                                  if($val[$field->name] == "no"){
                                    echo 'checked';
                                  }
                              }
                            ?>
                            value="no">
                    @elseif($field->type == "choices")
                      @foreach($field->choices as $key => $value)
                          {{$value}} <input type="radio" class="{{$field->class}}" name="{{$field->name}}" value="{{$value}}" 
                            <?php 
                              if(isset($val[$field->name])){
                                  if($val[$field->name] == $value){
                                    echo 'checked';
                                  }
                              }
                            ?>
                            required>
                      @endforeach
                    @elseif($field->type == 'textarea')
                      <textarea type="{{$field->type}}" class="form-control {{$field->class}}" name="{{$field->name}}" id="{{$field->name}}"></textarea>
                    @else
                      <input type="{{$field->type}}" value="{{$values[$field->name] or ''}}" class="form-control {{$field->class}}" name="{{$field->name}}" id="{{$field->name}}" required>
                    @endif
                  </div>
                </div>
              @endforeach

              @if(Session::get('franchisee')->country == 'Australia')
                <div class="form-group">
                  <div class="col-md-6 text-left">
                    <h4><a href="http://www.cashflowit.com.au/online-application-form/" target="_blank">Apply for Finance</a></h4>
                  </div>
                </div>
              @endif

                <input type="hidden" name="address" value="{{$franchisee->location}}">
                <input type="hidden" name="country" value="{{$franchisee->country}}">
                <input type="hidden" name="studio_name" value="{{$franchisee->name}}">
                <input type="hidden" name="email" value="{{Session::get('user')['email']}}">

                <div class="form-group">
                  <div class="col-md-12 text-center">
                    <input type="submit" class="btn btn-default" id="btn-order-submit" value="Save">
                    {{-- <input type="reset" class="btn btn-default btn-cancel" value="Reset"> --}}
                  </div>
                </div>
        		{!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .btn-cancel{
    color: #ed1c24;
    background: #fff;
  }

</style>

<style>
  .btn-cancel{
    color: #ed1c24;
    background: #fff;
  }

</style>

@endsection

@push('scripts')
{!!Html::script('js/pages/orders.js')!!}
@endpush