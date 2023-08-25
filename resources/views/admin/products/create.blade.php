@extends('layouts.admin')

@section('content')
<h2 class="mb-4">{{$title}}</h2>

<div class="alert alert-success" id="success_msg" style="display: none;">Successfully Created!</div>


<form id="offerForm" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form')
</form>

@endsection('content')

@section('scripts')
<script>
    $(document).on('click', '#submit', function(e) {
        e.preventDefault();

        var formData = new FormData($('#offerForm')[0]);

        $.ajax({
            type: 'post',
            url: "{{route('products.store')}}",
            data: formData,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            // {
            //     '_token': "{{csrf_token()}}",
            //     'name': $("input[name='name']").val(),
            //     'slug': $("input[name='slug']").val(),
            //     'category_id': $("input[name='category_id']").val(),
            //     'description': $("input[name='description']").val(),
            //     'short_description': $("input[name='short_description']").val(),
            //     'price': $("input[name='price']").val(),
            //     'compare_price': $("input[name='compare_price']").val(),
            //     'image': $("input[name='image']").val(),
            //     'status': $("input[name='status']").val(),
            //     'gallery': $("input[name='gallery']").val(),
            // },
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