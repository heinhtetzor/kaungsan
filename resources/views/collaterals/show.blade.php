@extends('layouts.app')
@section('content')
<div>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                @if($collateral->getStatusText() == 'Expired')
                <span class="tag is-danger">Expired</span>
                @elseif($collateral->getStatusText() == 'Active')
                <span class="tag is-success">Active</span>
                @elseif($collateral->getStatusText() == 'Withdrawn')
                <span class="tag is-primary">Withdrawn</span>
                @endif
                <span>
                    ReferenceID : {{ $collateral->id }}
                </span>
                <a href="{{ route ('collaterals.index') }}" class="card-header-icon" aria-label="more options">
                    <span class="icon">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </span>
                </a>

                {{-- <span style="margin-left: 530px">Reference ID - {{ $collateral->id }}</span> --}}
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                <div class="columns">
                    <div class="column is-half">
                        <h2 class="title">{{ $collateral->customer_name }}</h2>
                        <table class="table is-hoverable">
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td class="has-text-left">{{ $collateral->customer_phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td class="has-text-left">{{ $collateral->customer_address }}</td>
                            </tr>
                            <tr>
                                <td><strong>Start Date</strong></td>
                                <td class="has-text-left">{{ $collateral->created_at }}</td>
                            </tr>
                            <tr>
                                <td><strong>Expiry Date</strong></td>
                                <td class="has-text-left">{{ $collateral->expired_date->toFormattedDateString() }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="column is-half">
                        <h1 class="title">{{ $collateral->material_name }}</h1>
                        <table class="table is-hoverable">
                            <tr>
                                <td><strong>Quantity</strong></td>
                                <td class="has-text-right">{{ $collateral->quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Weight</strong></td>
                                <td class="has-text-right">
                                    {{ $collateral->kyat }}
                                    {{ $collateral->pel }}
                                    {{ $collateral->yway }}
                                    {{ $collateral->chat }}
                                    {{ $collateral->sate }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gem</strong></td>
                                <td class="has-text-right">{{ $collateral->gem_included }}</td>
                            </tr>
                            <tr>
                                <td><strong>Amount</strong></td>
                                <td class="has-text-right">{{ $collateral->amount }} - ကျပ်</td>
                            </tr>
                            <tr>
                                <td><strong>Rate</strong></td>
                                <td class="has-text-right">{{ $collateral->rate }} % (<span id="chargeAmount">{{ $collateral->calculateRate($collateral->rate, $collateral->amount) }}</span> ကျပ်)</td>
                            </tr>
                            <tr>
                                <td><strong>Duration</strong></td>
                                <td class="has-text-right">{{ $collateral->getDuration() }}</td>
                            </tr>
                            <tr>
                                <td><strong>Subtotal</strong></td>
                                <td class="has-text-right">{{ $collateral->getSubtotal() }} ကျပ်</td>
                            </tr>
                            <tr>
                                <td><strong>Paid Interest</strong></td>
                                <td class="has-text-right has-text-black has-text-weight-bold"right>{{ $collateral->collateral_interests->sum('paid_amount') }} ကျပ်</td>
                            </tr>
                            <tr class="has-background-info has-text-white has-text-weight-bold">
                                <td>Total Bill</td>
                                <td class="has-text-right"right>{{ $collateral->getTotalBill() }}</td>
                            </tr>
                        </table>
                    </div>    
                </div>
                <div class="interests-section">
                    @isset($success)
                    <article class="message is-success">
                        <div class="message-body">
                            Interest Record successfully deleted.
                        </div>
                    </article>
                    @endif
                    <h2 class="has-text-centered">Paid Interests</h2>
                    @if(count($collateral->collateral_interests) > 0)
                    <table class="table is-hoverable">
                        <thead>
                            <tr>
                                <th width="33%" class="has-text-right">Date</td>
                                <th width="33%" class="has-text-centered">Paid Interest Amount</th>
                                <th width="33%">Month</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collateral->collateral_interests as $item)
                                <tr>
                                    <td width="33%" class="has-text-right">{{ $item->createdAt }}</td>
                                    <td width="33%" class="has-text-centered">{{ $item->paid_amount }} ကျပ်</td>
                                    <td width="33%">{{ $item->paid_month }} month</td>
                                    <td class="has-text-right">
                                            <a class="button is-primary" href="{{ route('collaterals.showCollateralInterest', $item->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="has-text-left">
                                        <form action="{{ route('collaterals.destroyCollateralInterest', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        {{-- <input type="hidden" name="id" value="{{ $item->id }}"> --}}
                                            <button class="button is-danger" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else 
                    <article class="message is-danger">
                        <div class="message-body">
                            NO PAYMENT HAS BEEN MADE YET!
                        </div>
                    </article>
                    @endif
                </div>
            </div>
            @if($collateral->status == 0)
            <footer class="card-footer">
                <a href="#" id="withdrawModalBtn" class="card-footer-item button is-primary">Withdraw</a>
                <a id="payInterestModalBtn" href="#" class="card-footer-item button is-danger">Pay Interest</a>
            </footer>
            @endif
        </div>
</div>
{{-- withdraw modal --}}
<div class="modal" id="withdrawModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirmation</p>
                <button class="delete hideModal" aria-label="close"></button>
            </header>
            <form action="{{ route('collaterals.withdrawCollateral', $collateral->id) }}" method="POST">
                @csrf
                @method('PUT')
            <section class="modal-card-body">
                <h2>Are you sure?</h2>
                </section>
                <footer class="modal-card-foot">
                    <button type="button" class="button hideModal">Cancel</button>
                    <button type="submit" class="button is-success">Confrim</button>
                </footer>
            </form>
        </div>
    </div>
{{-- pay interest modal --}}
<div class="modal" id="payInterestModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Add Interest Record</p>
            <button class="delete hideModal" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <form action="{{ route('collaterals.addInterest') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="collateral_id" value="{{ $collateral->id }}">
                <div class="columns">
                    <div class="column is-half">
                        <div class="field has-addons">
                            <label for="paid_month">Pay Interest for</label>
                            <p class="control">
                                <input id="paid_month" type="number" class="input" name="paid_month" min="0">
                            </p>
                            <p class="control"> 
                                <a class="button">
                                    Month
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="column is-half">
                        <div class="field has-addons">
                                <label for="paid_amount">Charge</label>
                                <p class="control">
                                    <input id="paid_amount" type="number" class="input has-text-right" name="paid_amount" min="0">
                                </p>
                                <p class="control"> 
                                    <a class="button">
                                        ကျပ်
                                    </a>
                                </p>
                            </div>
                        </div>
                </div>
                
            </section>
            <footer class="modal-card-foot">
                <button type="button" class="button hideModal">Cancel</button>
                <button type="submit" class="button is-success">Confrim</button>
            </footer>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(()=>{
        $('#payInterestModalBtn').click(()=>{
            activatePayInterestModal();
        })
        $('#withdrawModalBtn').click(()=>{
            activateWithdrawModal();
        })
        $('.hideModal').click(()=>{
            deactivateModal();
        })
        $('#paid_month').on('keyup', (e)=>{
            var chargeAmount = $('#chargeAmount').text();
            $('#paid_amount').val(chargeAmount * e.target.value);
        })
    })
    function activatePayInterestModal(){
        $('#payInterestModal').addClass('is-active');
        $('#paid_month').focus();
    }
    function activateWithdrawModal(){
        $('#withdrawModal').addClass('is-active');
    }
    function deactivateModal(){
        $('#payInterestModal').removeClass('is-active');
    }
</script>
@endsection