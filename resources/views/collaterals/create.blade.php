@extends('layouts.app')

@section('content')
<section class="hero is-danger">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Create New Collateral
      </h1>
      <h2 class="subtitle">
        Fill in the form.
        <a href="{{ route('collaterals.index') }}"><u>See all collaterals</u></a>
        </h2>
    </div>
  </div>
</section>
<!-- Collateral Form Box -->
<div class="box">
    <form action="{{ route('collaterals.store') }}" method="POST">
        @csrf
        <!-- hidden user id -->
        <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
        <!-- Customer Information -->
        <h1 class="title">Customer Information</h1>
        <div class="columns">
            <div class="column is-one-thirds">
                <div class="field">
                    <div class="control">
                        <label for="customer_name">Customer Name</label>
                    <input autofocus autocomplete="off" name="customer_name" type="text" value="{{ old('customer_name') }}" class="input" placeholder="Enter Customer Name" required>
                    </div>
                </div>
            </div>
            <div class="column is-one-thirds">
                <div class="field">
                    <div class="control">
                        <label for="customer_phone">Phone Number</label>
                        <input autocomplete="off" name="customer_phone" type="tel" class="input" placeholder="Eg-09777771544">
                    </div>
                </div>
            </div>
            <div class="column is-one-thirds">
                <div class="field">
                    <div class="control">
                        <label for="customer_address">Address</label>
                        <input type="text" class="input" name="customer_address" placeholder="e.g. Insein">
                    </div>
                </div>
            </div>
        </div>
        <!-- Customer info ends -->
        <hr>
        <!-- Collateral info starts -->
        <h1 class="title">Collateral Information</h1>
        <div class="columns">
            <div class="column is-4">
                <div class="field">
                    <div class="control">
                        <label for="material_name">Material Name</label>
                        <input type="text" class="input" name="material_name" placeholder="eg. Gold Chain">
                    </div>
                </div>
            </div>
            <div class="column is-2">
                <div class="field">
                    <div class="control">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="input" name="quantity" placeholder="" min="0">
                    </div>
                </div>
            </div>
        </div>
        <!-- Weight info -->
        <label for="">Weight</label>
        <div class="columns">
            <div class="column is-one-fifths">
                <div class="field has-addons">
                    <p class="control">
                        <input name="kyat" type="number" class="input" min="0">
                    </p>
                    <p class="control"> 
                        <a class="button">
                            ကျပ်
                        </a>
                    </p>
                </div>
            </div>
            <div class="column is-one-fifths">
                <div class="field has-addons">
                    <p class="control">
                        <input name="pel" type="number" class="input" min="0">
                    </p>
                    <p class="control"> 
                        <a class="button">
                            ပဲ
                        </a>
                    </p>
                </div>
            </div>
            <div class="column is-one-fifths">
                <div class="field has-addons">
                    <p class="control">
                        <input name="yway" type="number" class="input" min="0">
                    </p>
                    <p class="control"> 
                        <a class="button">
                            ရွေး
                        </a>
                    </p>
                </div>
            </div>
            <div class="column is-one-fifths">
                <div class="field has-addons">
                    <p class="control">
                        <input name="chan" type="number" class="input" min="0">
                    </p>
                    <p class="control"> 
                        <a class="button">
                            ခြမ်း
                        </a>
                    </p>
                </div>
            </div>
            <div class="column is-one-fifths">
                <div class="field has-addons">
                    <p class="control">
                        <input name="sate" type="number" class="input" min="0">
                    </p>
                    <p class="control"> 
                        <button class="button">
                            စိတ်
                        </button>
                    </p>
                </div>
            </div>
        </div>
        <!-- is gem included -->
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label for="gem_included">Is Gem included?</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="gem_included" value="1">
                                Yes
                            </label>
                        <label class="radio">
                        <input type="radio" name="gem_included" value="0">
                                No
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <!-- amount --> 
        <div class="columns">
            <div class="column is-2">
                <div class="field">
                    <div class="control">
                        <label for="amount">Amount</label>
                        <input name="amount" type="text" class="input" placeholder="12345">
                    </div>
                </div>
            </div>
            <div class="column is-2">
                <label for="amount">Rate</label>
                <div class="field has-addons">
                        <p class="control">
                            <div class="select">
                                <select required name="rate">
                                    <option value="">Select Rate</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </p>
                        <p class="control">
                            <a class="button">
                                %
                            </a>
                        </p>
                </div>
            </div>
            <div class="column is-2">
                <label for="amount">*Expires in</label>
                <div class="field has-addons">
                        <p class="control">
                            <input name="expired_date" type="number" class="input" value="5" min="0">
                        </p>
                        <p class="control">
                            <a class="button">
                                လ
                            </a>
                        </p>
                </div>
            </div>
        </div>
        <!-- rate -->
        <p class="has-text-info">Check your inputs and submit.</p><br>
        <!-- submit -->
        <button class="button is-primary" type="submit">Submit</button>
    </form>
</div>
@endsection