@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="button is-danger" href={{ route('collaterals.create') }}>Create New</a>
        <br>
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
                            {{ $c->expired_date }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $collaterals->links() }}
    </div>
@endsection