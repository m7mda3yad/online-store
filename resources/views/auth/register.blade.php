@extends('layouts.auth')

@section('content')

<div class="card-body login-card-body" >
    <p class="login-box-msg">Sign Up</p>
    <form action="{{route('register')}}" method="post">
      @csrf
      <br>
      <div class="input-group">
        <label class="col-3">name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
      <div class="input-group-append">
        <div class="input-group-text">
          @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
      </div>
    </div>


    <br>
    <div class="input-group">
        <label class="col-3">phone</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required >
      <div class="input-group-append">
        <div class="input-group-text">

          @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
      </div>
    </div>

    <br>
    <div class="input-group">
        <label class="col-3">address</label>
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required >
      <div class="input-group-append">
        <div class="input-group-text">
          @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
      </div>
    </div>



    <br>
      <div class="input-group">
        <label class="col-3">email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >
        <div class="input-group-append">
          <div class="input-group-text">
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
          </div>
        </div>
      </div>


      <br>
      <div class="input-group">
        <label class="col-3">password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required >
        <div class="input-group-append">
          <div class="input-group-text">
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
          </div>
        </div>
      </div>
      <br>
      <div class="input-group">
        <label class="col-3">password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required >
        <div class="input-group-append">
          <div class="input-group-text">
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">{{ __('register') }}</button>
          </div>
      </div>
    </form>

      <a class="btn btn-link" href="{{ route('login') }}">
          {{ __('login') }}
      </a>

  </p>
</div>
@endsection
