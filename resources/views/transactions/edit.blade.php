@extends('layouts/app')
@section('content')
<div class="container">
        <h1>Edit Transaction</h1>
        <form action="" method="" name="transactionupdateform" id="transactionupdateform">
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $transaction->description }}" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>
            </div>
            <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_name" id="category_name" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
            <button type="submit" class="btn btn-primary mt-3">Update Transaction</button>
        </form>
    </div>
@endsection
@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script type="text/javascript">
   $(document).ready(function () {
        /************* Start voucher login ******************/
        $("#transactionupdateform").submit(function (e) {
            e.preventDefault();
            
            $.ajax({
                type: "PUT",
                url: "{{route('transactions.update',$transaction->id)}}",
                data: $('#transactionupdateform').serialize(),
                cache: false,
                success: function (response) {
                    $("button[type=submit]").prop('disabled,false');
                    // console.log(response);
                    if (response["status"] == true) {
                        window.location.href='{{route("transactions.index")}}';
                        
                    } else{
						var errors = response.errors;
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select,input[type='number'] ").removeClass('is-invalid');
        
                        $.each(errors, function(key,value){
                           $(`#${key}`).addClass('is-invalid')
                           .siblings('p')
                           .addClass('invalid-feedback')
                           .html(value);
                        });
                            }
                        }
				
            });
            
	
        });
    });
</script>
@endsection