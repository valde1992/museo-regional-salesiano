@include('layouts.app')

@extends('layouts.layout')

@section('titulo', ' - ' . $fondo->descripcion)

@section('head')

	@include('layouts.librerias')

@endsection

@section('content')
	<div class="col-md-offset-1 col-md-10">
		<ol class="breadcrumb">
	        <li><a href="{{ url('/') }}">Inicio</a></li>
	        <li><a href="{{ route('fondos.index') }}">Fondos</a></li>
	        <li class="active">Fondo {{ $fondo->id }}</li>
	    </ol>
	    <div class="page-header text-center">
	        <h3>
	            Fondo {{ $fondo->id }}<small>.</small>
	        </h3>
	    </div>
	    <?= Former::open()
    	->method('patch')
    	->route('fondos.update', $fondo->id) ?>

	        <?= Former::textarea('descripcion')
	        ->label('Descripción')
	        ->placeholder($fondo->descripcion)
	        ->readonly() ?>

	        <?= Former::text('usuario')
	        ->label('Cargado por')
	        ->placeholder( $fondo->user->name )
	        ->readonly() ?>

	        <?= Former::date('fondo_carga')
	        ->label('Fecha de carga')
	        ->placeholder($fondo->fondo_carga)
	        ->readonly() ?>

	        <div class="form-group">
	            <div class="col-lg-offset-2 col-sm-offset-4 col-lg-10 col-sm-8">
	                <a href="{{ route('fondos.index') }}" class="btn btn-default"> 		<i class="glyphicon glyphicon-chevron-left"></i> Volver
	                </a>
	                <a href="{{ route('fondos.edit', $fondo->id) }}" class="btn btn-primary pull-right"> 
	                	Editar <i class="glyphicon glyphicon-edit"></i>
	                </a>
	            </div>
	        </div>

	    <?= Former::close() ?>
	</div>
@stop