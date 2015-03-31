@include('Admin.Header')

<h1>Alle autos</h1>

<a href={{ URL::to('Admin', 'AddCar') }}>Create</a>

@if($errors->any())
            {{$errors->first()}}
        @endif

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

				<th><a href={{ URL::to('AdminCars', 'edit', array($auto->id)) }}>Edit</a></th>
				<th>
					<form method="GET" id="AdminCarEditForm">

    					<input type="hidden" name="SelectedCar" value={{ $auto->ID }}>
    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" value="Edit" onclick="this.form.action='{{action('AdminCarsController@edit')}}'">

					</form>
				</th>
				
				<th>
					<form method="POST" id="AdminCarForm">

    					<input type="hidden" name="SelectedCar" value={{ $auto['ID'] }}>
    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" value="Verwijderen" onclick="this.form.action='{{action('AdminCarsController@delete')}}'">

					</form>

				</th>
			</tr>
			@endforeach
		</tbody>
	
	</table>

@else
	There are no cars
@endif

@include('Admin.Footer')