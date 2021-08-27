@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Filmes</h1>

    @include('layouts.message')

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary mt-2">Lista de Filmes</h6>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{route('movies.list')}}">Adicionar Filme</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="display table table-striped table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID TMDB</th>
                            <th>Filme</th>
                            <th>Data de Lançamento</th>
                            <th>Assistindo</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            var datatable = $('#datatable').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                responsive: true,
                initComplete: function () {
                    $('#datatable').parent().removeClass('col-xs-12').addClass('col-12');
                },
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
                },

                "pageLength": 10,

                "ajax": {
                    url: '{{route('movies.datatable')}}',
                    dataType: 'JSON',
                    type: 'POST',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization');
                    },
                    data: function (d) {
                        d._token = "{{csrf_token()}}"
                    },
                },
                columns: [
                    {data: 'tmdb_id', name: 'tmdb_id'},
                    {data: 'title', name: 'title'},
                    {data: 'release_date', name: 'release_date'},
                    {data: 'watched', name: 'watched'},
                    {data: 'actions', name: 'actions'},
                ],
                "drawCallback": function () {
                }
            });
            function deleteMovie(movie){
                Swal.fire({
                    title: 'Tem certeza que deseja deletar esse filme?',
                    showCancelButton: true,
                    confirmButtonText: `Confimar`,
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        movie.parents('form').submit();
                    }
                })
            }
        </script>
    @endpush
@endsection
