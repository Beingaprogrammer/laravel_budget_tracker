@extends('layouts/app')
@section('content')
<div class="container">
        <h1>Add Transaction</h1>
        <form action="" method="" id="transactionform" name="transactionform">
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
            <div class="form-group">
            <label for="name">Category Name</label>
            <div class="mb-3">
                <select name="category_name" id="category_name" class="form-control">
                    @if($categories->isNotEmpty())
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif                                                
                </select>
            </div>
        </div>
            <button type="submit" class="btn btn-primary mt-3">Add Transaction</button>
        </form>
    </div>
@endsection
@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">

    $('#transactionform').submit(function(e){
        e.preventDefault();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
          url:'{{route("transactions.store")}}',
          type:"POST",
          data:$('#transactionform').serialize(),
          cache: false,
          success: function(response){
            if (response["status"]  == true){
                console.log(response);
                // $("button[type='submit']").prop('disabled',false);
                window.location.href='{{route("transactions.index")}}';
            } else{
                var errors  = response["errors"];
               
                $(".error").removeClass('invalid-feedback').html('');
                $("input[type='text'], select,input[type='number'] ").removeClass('is-invalid');

                $.each(errors, function(key,value){
                   $(`#${key}`).addClass('is-invalid')
                   .siblings('p')
                   .addClass('invalid-feedback')
                   .html(value);
                });
            }
          },error: function(){
            console.log('something went wrong');
          }
        });
    });

</script>
@endsection