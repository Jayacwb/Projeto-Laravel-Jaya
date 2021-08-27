@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Filmes</h1>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Adicionar de Filme</h6>
                </div>
                <div class="card-body">
                    <div class="form-group col-6">
                        <input type="text" class="form-control search" placeholder="Digite sua busca">
                    </div>
                    <div class="row movies">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(()=>{
                loadMovies($('.search').val());
            });
            function loadMovies(search){

                    $.ajax({
                        url: '{{route('movies.search')}}',
                        dataType: 'JSON',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: {
                            search: search
                        },
                        success: function (response) {
                            if(response.status){
                                $('.movies').html(response.data);
                            }
                        }
                    });
            }
            $('.search').keyup(function (){
                if($(this).val().length >= 3) {
                    loadMovies($(this).val());
                }
            });
        </script>
    @endpush
@endsection
