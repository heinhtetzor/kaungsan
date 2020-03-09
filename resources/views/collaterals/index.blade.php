@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="columns">
            <div class="column">
                <a class="button is-danger" href={{ route('collaterals.create') }}>
                    <span style="margin-right: 6px;" class="fas fa-plus-circle"></span>
                    Create New
                </a>
            </div>
            {{-- search by id --}}
            <div class="column">
                <form action="{{ route('collaterals.searchById') }}" method="GET">
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" type="text" name="id" placeholder="Enter Reference ID">
                        </div>
                        <div class="control">
                            <button class="button is-info">
                            Search
                            </button>
                        </div>
                    </div>
                    @if($errors->has('searchIdError'))
                        <p class="help is-danger">{{ $errors->first('searchIdError') }}</p>
                    @endif
                </form>
            </div>
            {{-- search by customer name --}}
            <div class="column">
                <form action="{{ route('collaterals.searchByCustomerName') }}" method="GET">
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" type="text" name="name" placeholder="Enter Customer Name">
                        </div>
                        <div class="control">
                            <button class="button is-info">
                            Search
                            </button>
                        </div>
                    </div>
                    @if($errors->has('searchCustomerNameError'))
                    <p class="help is-danger">{{ $errors->first('searchCustomerNameError') }}</p>
                    @endif
                </form>
            </div>
        </div>

        <br>
        @isset($msg)
        <p class="has-text-danger">Search Results for : <i>{{ $msg }}</i></strong></p>
        @endisset
        <table class="table" id="collaterals-table">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th class="text-center">Material</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Start Date</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collaterals as $c)
                <tr>
                    <td>
                        <a class="button is-info" href="{{ route('collaterals.show', $c->id) }}">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    </td>
                    <td>{{ $c->id }}</td>
                    <td>
                        @if($c->expired_date < now())
                        <span class="tag is-danger">
                            Expired
                        </span>
                        @else
                        <span class="tag is-success">
                            {{ $c->getStatusText($c->status, $c->expired_date) }}
                        </span>
                        @endif
                    </td>
                    <td>{{ $c->customer_name }}</td>
                    <td>{{ $c->material_name }}</td>
                    <td>{{ $c->customer_phone }}</td>
                    <td><strong>{{ $c->amount }}</strong> ကျပ် </td>
                    <td>
                        {{ $c->getCreatedAtDiffForHumans($c->created_at) }}<br>
                        <span class="tag is-link">
                            {{ $c->created_at }}
                        </span>
                    </td>
                    <td>
                        {{ $c->getExpiredDateDiffForHumans($c->expired_date) }}<br>
                        <span class="tag is-warning">
                            {{ $c->expired_date->toFormattedDateString() }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collaterals->links() }}
    </div>
@endsection
