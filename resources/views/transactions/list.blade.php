@extends('layouts/app')
@section('content')
<div class="container">
        <h1>Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add Transaction</a>
        <a href="{{ route('transactions.monthlyReport') }}" class="btn btn-primary">View Monthly Report</a>
        <div class="card-header">
        <form action="" method="get">
            <div class="card-tools">
                <div class="input-group input-group" style="width: 250px;">
                    <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search by category">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->category_name }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm" onclick="deletetransaction({{$transaction->id}})">Delete</a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('customJs')
<script>
	function deletetransaction(id){
		var url = '{{route("transactions.destroy","ID")}}';
		var newUrl = url.replace("ID",id);
		if(confirm("Are you sure you want to delete")){
			$.ajax({
                    type: "delete",
                    url: newUrl,
                    data: {},
					dataType: 'json',
                    cache: false,
					headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $("button[type=submit]").prop('disabled,false');
                        // console.log(response);
                        if (response.status) {
                            window.location.href = '{{ route("transactions.index") }}';
				        }
	                }
	            });
		}
	}
</script>
@endsection