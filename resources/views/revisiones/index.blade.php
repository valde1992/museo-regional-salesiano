@extends('layouts.layout')

@include('layouts.app')

@section('titulo', ' - Listado de revisiones')

@section('head')

	@include('layouts.librerias')

@endsection

@section('content')
	<div class="col-md-offset-1 col-md-10">
		<ol class="breadcrumb">
	        <li><a href="{{ url('/') }}">Inicio</a></li>
	        <li class="active">Revisiones</a></li>
	    </ol>
		<h3>Revisiones</h3>
		<a href="{{url('/revisiones/create')}}" class="btn btn-primary">
			<i class="glyphicon glyphicon-plus"></i> Nueva revisión
		</a>
		<hr>
		<table class="table table-condensed table-striped table-hover">
			<thead>
				<tr>
					<th>
						Usuario
					</th>
					<th>
						Pieza
					</th>
					<th>
						Fecha
					</th>
					<th>
						Estado de conservación
					</th>
					<th>
						Ubicación
					</th>
					<th>
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($revisiones as $revision)
				<tr>
					<td>
						{{ $revision->usuario_revision }}
					</td>
					<td>
						{{ $revision->pieza->descripcion }}
					</td>
					<td>
						{{ Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y') }}
					</td>
					<td>
						{{ $revision->estado_conservacion }}
					</td>
					<td>
						{{ $revision->ubicacion }}
					</td>
					<td>
						<div class="btn-group">
							<a href="{{ route('revisiones.show', $revision->id) }}" class="btn btn-inverse" title="Ver"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
	                        <a href="{{ route('revisiones.edit', $revision->id) }}" class="btn btn-inverse" title="Editar"><i class="glyphicon glyphicon-edit"></i> Editar</a>

	                        <?= Former::open()
	                        ->class('btn-group')
	                        ->method('delete')
	                        ->route('revisiones.destroy', $revision->id) ?>

	                        {{ csrf_field() }}

	                        <?= Former::button()
	                        ->type('submit')
	                        ->value('<i class="glyphicon glyphicon-trash"></i> Eliminar')
	                        ->class('btn btn-danger') ?>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection