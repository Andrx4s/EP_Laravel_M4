<div class="mb-3">
    <label for="input{{ $input['name'] }}" class="form-label">{{ $input['label'] }}</label>
    <input type="text"
           class="form-control @error($input['name']) is-invalid @enderror"
           id="input{{ $input['name'] }}"
           name="{{ $input['name'] }}"
           aria-describedby="input{{$input['name']}}Validation"
           value="{{old($input['name'], '')}}">
    @error($input['name'])
        <div id="inputLoginValidation"
             class="invalid-feedback">
            {{$message}} </div>
    @enderror
</div>
