@extends('layouts.layout')

@section('titulo', ' - Listado de clasificaciones')

@section('head')

	@include('layouts.librerias')

@endsection

@section('navbar')

	@include('layouts.app')
	
	@section('content')
	<ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Clasificaciones</a></li>
    </ol>
	<h3>Clasificaciones</h3>
	<a href="{{url('/clasificaciones/create')}}" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i> Cargar clasificación
	</a>
	<hr>
	<table class="table table-condensed table-striped table-hover">
		<thead>
			<tr>
				<th>
					Descripción
				</th>
				<th>
					Fondo
				</th>
				<th>
					Cargado por
				</th>
				<th>
					Fecha de carga
				</th>
				<th>
					Acciones
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clasificaciones as $clasificacion)
			<tr>
				<td>
					{{ $clasificacion->descripcion }}
				</td>
				<td>
					{{ $clasificacion->fondo->descripcion }}
				</td>
				<td>
					{{ $clasificacion->user->name }}
				</td>
				<td>
					{{ Carbon\Carbon::parse($clasificacion->fecha_carga)->format('d/m/Y') }}
				</td>
				<td>
					<div class="btn-group">
						<a href="{{ route('clasificaciones.show', $clasificacion->id) }}" class="btn btn-inverse" title="Ver"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                        <a href="{{ route('clasificaciones.edit', $clasificacion->id) }}" class="btn btn-inverse" title="Editar"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        @role(('admin'))
	                        <?= Former::open()
	                        ->class('btn-group')
	                        ->method('delete')
	                        ->route('clasificaciones.destroy', $clasificacion->id) ?>

	                        {{ csrf_field() }}

	                        <?= Former::button()
	                        ->type('submit')
	                        ->value('<i class="glyphicon glyphicon-trash"></i> Eliminar')
	                        ->class('btn btn-danger') ?>
	                    @endrole
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@if(session('success'))
		@include('layouts.flash')
	@endif
	
	@endsection
@endsection