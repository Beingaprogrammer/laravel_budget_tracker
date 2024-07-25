@extends('layouts/app')
@section('content')
<div class="container">
    <h1>Monthly Report for {{ $month }}</h1>
    <form action="{{ route('transactions.monthlyReport') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="month">Select Month</label>
            <input type="month" name="month" id="month" class="form-control" value="{{ $month }}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">View Report</button>
    </form>
    <h3>Total Income: {{ $totalIncome }}</h3>
    <h3>Total Expenses: {{ $totalExpenses }}</h3>
    <h3>Balance: {{ $balance }}</h3>
    <ul class="list-group mt-3">
        @foreach($transactions as $transaction)
            <li class="list-group-item">
                {{ $transaction->description }} - {{ $transaction->amount }} - {{ $transaction->type }} - {{ $transaction->date }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
