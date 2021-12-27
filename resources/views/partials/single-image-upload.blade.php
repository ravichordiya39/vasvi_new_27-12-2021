<label class="{{ $required }}">
    {{ $lable_name }}
</label>
<div>
    @if ($image_url)
        <img id="{{ $image_view_name }}" src="{{ $image_url }}" class="single-image-preview" />
    @else
        <img id="{{ $image_view_name }}" src="" class="single-image-preview" style="display: none;" />
    @endif
</div>
<input type="hidden" value="{{ $image_url }}">
<div class="custom-file">
    <input type="file" class="custom-file-input" id="fileImage" name="{{ $input_name }}" accept="image/*"
        onchange="imagePreview(this, '{{ $image_view_name }}', '{{ $image_error_name }}')" {{ $required }} />
    <label class="custom-file-label" for="fileImage">Choose Image</label>
</div>
<p class="text-danger" style="display: none;" id="{{ $image_error_name }}"></p>
