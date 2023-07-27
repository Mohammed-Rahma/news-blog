<div class="mb-3">
    <label for="{{$id}}">{{$label}}</label>
    <textarea class="form-control @error($name) is-invalid @enderror" id="{{$name}}" name="{{$name}}" placeholder="{{$label}}" rows="3">{{old($name , $value)}}</textarea>
    <x-form.error name="{{ $name }}" />
</div>
