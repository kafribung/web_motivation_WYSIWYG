@extends('layouts.app')

@section('title', 'Lihat Motivasi | Tulis Motivasi Untuk Orang Lain, Motivasi Membuat Hidup Menjadi Berarti')

@section('content')
<div class="container">

    <div class="row card">
        <div class="col-sm-10 offset-sm-1">
            <div class="mb-4">
                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                <div class="card-body">
                    <h1 class="card-title mb-1">
                        <a href="/motivation/{{ $motivation->slug }}" class="text-dark">{{ $motivation->title }}</a>
                    </h1>
                    @foreach ($motivation->tags as $tag)
                    <a href="" class="badge badge-info">{{ $tag->title }}</a>
                    @endforeach

                    <small class="text-secondary">{{ $motivation->created_at->format('d-M-Y') }}</small>

                    <div class="media my-2">
                        <img src="{{ $motivation->user->gravatar() }}" alt="" class="mr-3 rounded-circle" width="40">

                        <div class="media-body">
                            <small class="d-block">{{ $motivation->user->username }}</small>
                            <small>{{ '@' . $motivation->user->username }}</small>
                        </div>
                    </div>

                    <p class="card-text mb-2">
                        {!! $motivation->description !!}
                    </p>
                </div>

                {{-- @if ($motivation->author())
                <h6 class="font-italic">Auth Cara Lama</h6>
                @endif --}}

                <div class="card-footer">
                    {{-- Autorization Policy --}}
                    @can('update', $motivation)
                    <a data-remote="/motivation/{{ $motivation->slug }}/edit" data-title="{{ $motivation->title }}"
                        data-toggle="modal" data-target="#exampleModal""
                    class=" btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    @endcan

                    @can('delete', $motivation)
                    <a onclick="deleteData({{ $motivation->id }})" class="btn btn-danger btn-sm"><i
                            class="fa fa-trash"></i></a>
                    @endcan
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ---
            </div>
        </div>
    </div>
</div>

@push('after_script')
{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    // CSRF TOKEN ALA AJAX
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        function deleteData(id) {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $.ajax({
                        url : "/motivation/"+ id,
                        type : "POST",
                        data : {'_method' : 'DELETE' , '_token' : '{{  csrf_token() }}'},
                        success: function(){
                            swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                            ),
                            window.location.href = "/motivation";
                            // location.reload();
                        },
                        error : function(){
                            swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error')
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                    )
                }
            })
        }
</script>
{{-- Modal --}}
<script>
    jQuery(document).ready(function($) {
        $('#exampleModal').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget);
            var modal  = $(this);
            modal.find('.modal-body').load(button.data("remote"));
            modal.find('.modal-title').html(button.data("title"));
        });
    });
</script>
@endpush
@endsection