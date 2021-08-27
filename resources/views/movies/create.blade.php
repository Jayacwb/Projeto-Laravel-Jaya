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
                    <h6 class="m-0 font-weight-bold text-primary mt-2">Adicionar Filme</h6>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => route('movies.store'), 'method'=>'post')) }}
                    @include('movies.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
