@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Tulis Motivasi</h3>

                    <form action="{{ Route('motivation.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" name="title" class="form-control" autofocus autocomplete="off" required
                                placeholder="Masukkan Nama" value="{{ old('title') }}">

                            @error('title')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img">Gambar</label>
                            <input type="file" name="img" id="inputData" class="form-control" accept="image/*">
                            <div class="overflow-auto" style="height:300px;">
                                <img id="output" />
                            </div>

                            @error('img')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select name="tag_id[]" id="tag" class="form-control js-example-basic-multiple" multiple>
                                @foreach ($tags as $tag)
                                <option {{ old('tag_id') == $tag->id ?'selected' : '' }} value="{{ $tag->id }}">
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
                            <textarea name="description" id="my-editor" class="form-control" required
                                placeholder="Masukkan Deskripsi">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                            <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after_script')
{{-- View Image --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.js"
    integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
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

{{-- Ck Edior With FIle Manager --}}
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

    CKEDITOR.replace('my-editor', options);
</script>

@endpush
@endsection