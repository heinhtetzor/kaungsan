@extends('layouts.app')

@section('content')
<div class="card">
        <header class="card-header">
          <p class="card-header-title">
            Register a new user
          </p>
        </header>
        <div class="card-content">
            <form action="{{ route('register') }}" method="POST">
              @csrf 
              <div class="field">
                <label for="fullname">Full name</label>
                <div class="control">
                    <input id="name" type="name" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="username" autofocus>
                </div>
              </div>
              <div class="field">
                <label for="fullname">Email Address</label>
                <div class="control">
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" placeholder="Optional" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                </div>
              <div class="field">
                <label for="fullname">Username</label>
                <div class="control">
                    <input id="username" type="username" class="input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                </div>
              </div>
              <div class="field">
                <label for="username">Password</label>
                <div class="control">
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="field">
                  <div class="control">
                      <label for="password_confirmation">Confirm Password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>
            </div>
            <footer class="card-footer">
                <button class="button is-primary" type="submit">Submit</button>
            </footer>
        </form>
      </div>
@endsection
