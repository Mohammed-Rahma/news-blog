<!-- لتعريف الاتتربيوت استخدمت داخل الكمبوننت دايركتف اسمه ات بروبس تحتوي على ارري لاسماء الاتتربيوتس الي انا بدي اقبلها  -->

@props([
'id' , 'name' , 'value'=>'' , 'type'=>'text' , 'label'
])

<div class="mb-3">
    <label for="{{$name}}">{{$label}}</label>       
    <input type="{{$type}}" step="0.1" min="0" class="form-control @error($name) is-invalid @enderror " id="{{$id}}" value="{{old( $name , $value )}}" name="{{$name}}" placeholder="{{$label}}">
    @error($name)
    <p class="text-danger">{{$message}}</p>
    @enderror

</div>