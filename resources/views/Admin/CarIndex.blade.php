@include('Header')

<h1>Alle autos</h1>

<a href={{ URL::to('AdminCars', 'Create') }}>Create</a>

@if ($autos->count())
	<table>
		<thead>
			<tr>
				<th>Naam</th>
				<th>Prijs</th>
				<th>Bouwjaar</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
	
		<tbody>
			@foreach($autos as $auto)
			<tr>
				<th>{{ $auto->Naam }}</th>
				<th>{{ $auto->Prijs }}</th>
				<th>{{ $auto->Bouwjaar }}</th>

				<th><a href={{ URL::to('AdminCars', 'Show', array($auto->id)) }}>Show</a></th>
				<th><a href={{ URL::to('AdminCars', 'Edit', array($auto->id)) }}>Edit</a></th>

				
				<th>
					<a href={{ URL::action('AdminCarsController@destroy', array('autos.destroy', $auto->id))}}>Delete</a>

					<form method="POST" action="/AdminCars/Delete/$auto->id" accept-charset="UTF-8">
						<input name="_method" type="hidden" value="DELETE">
						<input name="_token" type="hidden" value="{{ csrf_token() }}">
						<input type="submit" value="Delete">
					</form>

				</th>
			</tr>
			@endforeach
		</tbody>
	
	</table>

@else
	There are no cars
@endif

@include('Footer')