<div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="loginModal">
        <div class="row modal-heading">
          <div class="col-sm-8 col-sm-offset-2">
            <h2 class="modal-title" id="modal-login-form-title">Login to Your Account</h2>
          </div>
          <div class="col-sm-2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        </div>

        {!! Form::open(array('url' => 'login', 'id'=>'loginFormId')) !!}
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
              {{$errors->first()}}
            </div>
          @endif

          <div class="form-group col-sm-8 col-sm-offset-2">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" autofocus required>
          </div>
          <div class="form-group col-sm-8 col-sm-offset-2">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
          </div>
          <button type="submit" class="btn btn-default" id="login-submit">Login</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>