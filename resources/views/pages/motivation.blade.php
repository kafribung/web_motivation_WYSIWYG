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
        <div class="col-sm-8">
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

                    <div class="d-flex justify-content-between text-secondary">
                        <small>{{ $motivation->user->name }}</small>
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

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h1>Sapi</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque eos qui officia illum, sed
                        nobis
                        distinctio similique iure a inventore consectetur voluptates architecto voluptatum molestias
                        eligendi ducimus fuga in veritatis? Atque nihil corporis facere itaque aliquid deleniti quia
                        nemo, voluptatibus repellendus. Similique, debitis accusamus vel mollitia voluptatem eos
                        consequuntur cumque expedita, aspernatur pariatur, fuga dolorum aperiam iure natus nisi!
                        Animi
                        quidem ipsam, laboriosam fuga officiis vitae itaque asperiores illo optio voluptates officia
                        facere molestiae aliquam. Eius autem ex consequatur non deserunt veritatis molestiae,
                        dolores
                        unde, eaque vitae optio eum. At veniam dolor quam quasi quo eum iure amet eius omnis?</p>
                </div>
            </div>
        </div>
    </div>



    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ $motivations->links() }}
            {{-- {{ $motivations->links('pagination::simple-bootstrap-4') }} --}}
        </div>
    </div>
</div>

@endsection