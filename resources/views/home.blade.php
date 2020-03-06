@extends('layouts.app')

@section('content')
<section class="hero is-success">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Kaung San
      </h1>
      <h2 class="subtitle">
        Description
      </h2>
    </div>
  </div>
</section>
<div class="columns is-gapless">
  <div class="column is-3">
    <section class="hero is-danger">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            <a style="text-decoration:none; color: white;" href="{{ route('collaterals.index') }}">Collaterals</a>
          </h1>
          <h2 class="subtitle">
            Description
          </h2>
        </div>
      </div>
    </section>
  </div>
  <div class="column is-3">
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Collaterals
          </h1>
          <h2 class="subtitle">
            Description
          </h2>
        </div>
      </div>
    </section>
  </div>
    <div class="column is-3">
    <section class="hero is-warning">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Collaterals
          </h1>
          <h2 class="subtitle">
            Description
          </h2>
        </div>
      </div>
    </section>
    </div>
    <div class="column is-3">
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Collaterals
          </h1>
          <h2 class="subtitle">
            Description
          </h2>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
