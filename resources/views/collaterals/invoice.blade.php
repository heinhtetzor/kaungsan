@extends('layouts.app')
@section('content')
<div>
    <h1 id="invoice-title" class="has-text-centered" style="font-size: 100px">KAUNG SAN</h1>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                Invoice Ref : {{ $collateralInterest->id }}
            </p>
            <button class="button is-success" id="printBtn">
                <i class="fas fa-print"></i>
            </button>
        </header>
        <div class="card-content">
            <div class="content">
                <div class="columns">
                    <div class="column is-half">
                        <h2 class="title">{{ $collateralInterest->collateral->customer_name }}</h2>
                        <table class="table is-hoverable">
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td class="has-text-left">{{ $collateralInterest->collateral->customer_phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td class="has-text-left">{{ $collateralInterest->collateral->customer_address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Start Date</strong></td>
                                <td class="has-text-left">{{ $collateralInterest->collateral->created_at }}</td>
                            </tr>
                            <tr>
                                <td><strong>NEW Expiry Date</strong></td>
                                <td class="has-text-left">{{ $collateralInterest->collateral->expired_date->toFormattedDateString() }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="column is-half">
                        <h1 class="title">{{ $collateralInterest->collateral->material_name }}</h1>
                        <table class="table is-hoverable">
                            <tr>
                                <td><strong>Quantity</strong></td>
                                <td class="has-text-right">{{ $collateralInterest->collateral->quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Weight</strong></td>
                                <td class="has-text-right">
                                    {{ $collateralInterest->collateral->kyat }}
                                    {{ $collateralInterest->collateral->pel }}
                                    {{ $collateralInterest->collateral->yway }}
                                    {{ $collateralInterest->collateral->chat }}
                                    {{ $collateralInterest->collateral->sate }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gem</strong></td>
                                <td class="has-text-right">{{ $collateralInterest->collateral->gem_included }}</td>
                            </tr>
                            <tr>
                                <td><strong>Amount</strong></td>
                                <td class="has-text-right">{{ $collateralInterest->collateral->amount }} - ကျပ်</td>
                            </tr>
                            <tr>
                                <td><strong>Rate</strong></td>
                                <td class="has-text-right">{{ $collateralInterest->collateral->rate }} % (<span id="chargeAmount">{{ $collateralInterest->collateral->calculateRate() }}</span> ကျပ်)</td>
                            </tr>
                            <tr class="has-background-info has-text-white has-text-weight-bold">
                                <td>Pay Interest For</td>
                                <td class="has-text-right"right>{{ $collateralInterest->paid_month }} လ</td>
                            </tr>
                            <tr class="has-background-info has-text-white has-text-weight-bold">
                                <td>Bill</td>
                                <td class="has-text-right"right>{{ $collateralInterest->paid_amount }} ကျပ်</td>
                            </tr>
                            <tr class="has-background-success has-text-white has-text-weight-bold">
                                <td>Total Paid Bill</td>
                                <td class="has-text-right"right>{{ $collateralInterest->collateral->getTotalPaidBill() }} ကျပ်</td>
                            </tr>
                        </table>
                        <div>
                        <p class="has-text-info has-background-light">Accepted By - {{ $collateralInterest->user->username }}</p>
                        </div>
                    </div>    
                </div>
            <p id="exceed-warranty-text" class="has-text-centered has-text-danger">Collaterals which exceeded 5 months and above are not guaranteed!</p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(() => {
        $('#printBtn').click(() => {
            window.print(); 
        })
    })
</script>
@endsection