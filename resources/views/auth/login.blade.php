@extends('layouts.app')

@section('content')
<div class="card" id="login-card">
        <header class="card-header">
          <p class="card-header-title">
            Login
          </p>
        </header>
        <div class="card-content">
            <form action="{{ route('login') }}" method="POST">
              @csrf 
              <div class="field">
                <label for="username">Username</label>
                <div class="control">
                    <input id="username" type="username" class="input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
              </div>
              <div class="field">
                <label for="username">Password</label>
                <div class="control">
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <footer class="card-footer">
                <button class="button is-primary" type="submit">Login</button>
            </footer>
        </form>
      </div>
@endsection
