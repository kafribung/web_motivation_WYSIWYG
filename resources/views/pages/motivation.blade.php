@extends('layouts.app')

@section('title', 'Motivasi | Tulis Motivasi Untuk Orang Lain, Motivasi Membuat Hidup Menjadi Berarti')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center mb-3">
            @if (session('msg'))
            <p class="alert alert-info">{{ session('msg') }}</p>
            @endif

            @if (session('msg') == 'Mantap')
            <script>
                location.reload();
            </script>

            <p>{{ session('msg') }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center mb-3">
            <h3><span class="badge badge-info">All</span> Motivasi </h3>
        </div>
    </div>

    <div class="row">
        @forelse ($motivations as $motivation)
        <div class="col-sm-6">
            <div class="card mb-4">
                @if($motivation->img)
                <a href="/motivation/{{ $motivation->slug }}">
                    <img class="card-img-top" src="{{ asset($motivation->takeImg) }}"
                        title="Gambar {{ $motivation->title }}"
                        style="height: 320px; object-fit: cover; object-position:center">
                </a>
                @endif
                <div class="card-body">
                    @foreach ($motivation->tags as $tag)
                    <a href="/tag/{{ $tag->slug  }}" class="badge badge-info mb-1">{{ $tag->title }}</a>
                    @endforeach
                    <h4 class="card-title mb-1">
                        <a href="/motivation/{{ $motivation->slug }}" class="text-dark">{{ $motivation->title }}</a>
                    </h4>
                    <p class="card-text mb-2">
                        {!! Str::limit($motivation->description, 200, '....') !!}
                    </p>

                    {{-- Fitur Like --}}
                    @if (Auth::check())
                    <div>
                        <button class="btn {{ $motivation->isLike()? 'btn-danger unlike' : 'btn-light like'}} btn-sm"
                            data-model="{{ $motivation->id }}" data-type="1">
                            <i class="fa fa-heart-o"></i>
                        </button>
                        <small class="count">{{ $motivation->likes()->count() }}</small>
                        <p class="warning d-none text-danger">Tidak bisa like diri sendiri</p>
                    </div>
                    <hr>
                    @endif
                    <div class="d-flex justify-content-between text-secondary">
                        <small>{{ $motivation->user->username }}</small>
                        <small>{{ $motivation->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-sm-8">
            <h5>Data Belum Ada</h5>
        </div>
        @endforelse
    </div>



    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ $motivations->links() }}
            {{-- {{ $motivations->links('pagination::simple-bootstrap-4') }} --}}
        </div>
    </div>
</div>

@push('after_script')
<script>
    // Like
    $(document).on('click', '.like', function(){
        let _this = $(this);

        let _url  = '/like/' + _this.attr('data-model') + '/' + _this.attr('data-type');
        console.log(_url);

        $.get(_url, function(data){
            if (data == "0") {
                _this.nextAll(".warning").removeClass("d-none").delay(800).fadeOut(1000);
                console.log('0');
            } else {
                _this.addClass('btn-danger unlike').removeClass('btn-light like');

                let increment = _this.nextAll('.count');
                increment.html(parseInt(increment.html()) +  1);
            }
        });
    });
    // Unlike
    $(document).on('click', '.unlike', function() {
        let _this = $(this);
        let _url = '/unlike/' + _this.attr('data-model') + '/' + _this.attr('data-type');
        console.log(_url);

        $.get(_url, function(data){
            _this.addClass('btn-light like').removeClass('btn-danger unlike');

            let decrement = _this.nextAll('.count');
            decrement.html(parseInt(decrement.html()) - 1 );
        });
    });
</script>
@endpush

@endsection