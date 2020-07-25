<form action=" /motivation/{{ $motivation->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" name="title" class="form-control" autofocus autocomplete="off" required
            placeholder="Masukkan Nama" value="{{ old('title')??  $motivation->title }}">

        @error('title')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="img">Gambar</label>
        <input type="file" name="img" id="inputData" class="form-control" accept="image/*">
        @if ($motivation->img)
        <div class="overflow-auto" style="height:300px;">
            <img id="output" src="{{ asset($motivation->takeImg) }}" />
        </div>
        @endif

        @error('img')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="tag">Tag</label>

        <select name="tag_id[]" id="tag" class="form-control js-example-basic-multiple" multiple>
            <optgroup label="Tag Lama">
                @foreach ($motivation->tags as $tag)
                <option disabled {{ old('tag_id') == $tag->id ?'selected' : '' }} value="{{ $tag->id }}">
                    {{ $tag->title }}
                </option>
                @endforeach
            </optgroup>

            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">
                {{ $tag->title }}
            </option>
            @endforeach
        </select>

        @error('tag_id')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="my-editor2" class="form-control" required
            placeholder="Masukkan Deskripsi">{{ old('description')?? $motivation->description }}</textarea>

        @if ($errors->has('description'))
        <p class="alert alert-danger">{{ $errors->first('description') }}</p>
        @endif
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
    </div>
</form>

{{-- Ck Edior With FIle Manager --}}
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

    CKEDITOR.replace('my-editor2', options);
</script>

{{-- View Image --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.js"
    integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous">
</script>

<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        $('#output').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    }
    $("#inputData").change(function() {
    readURL(this);
    });
</script>

{{-- Select Multiple --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>