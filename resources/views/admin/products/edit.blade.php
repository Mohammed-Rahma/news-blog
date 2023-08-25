@extends('layouts.admin')

@section('content')

<h2 class="mb-4">{{$title}}</h2>

<div class="alert alert-success" id="#success_msg" style="display: none;">Successfully Updated!</div>

<form id="offerForm" action="{{route('products.update' , $product->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- form method spoofing -->
    @method('put')
    @include('admin.products._form' , [
    'submit'=>'Update'
    ])
</form>
@endsection('content')

<!-- ajax -->
@section('scripts')
<script>
    $(document).on('click', '#submit', function(e) {
        e.preventDefault();

        var formData= new FormData($('#offerForm')[0]);

        $.ajax({
            type: 'post',
            url: "{{route('products.update' , $product->id )}}",
            data: formData,
            enctype:"multipart/form-data",
            processData:false,
            contentType:false,
            cache:false,
            success: function(data) {
                if (data.status == true) {
                    $('#success_msg').show();
                }  
            },
            error: function(reject) {

            }
        });
    });
</script>
@stop
