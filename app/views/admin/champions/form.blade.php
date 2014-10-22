<table class="table table-striped">
	<tr>
		<td width="200"><strong>Free to play</strong></td>
		<td>{{ Form::checkbox('f2p') }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Sale</strong></td>
		<td>{{ Form::checkbox('sale') }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Free to play</strong></td>
		<td>{{ Form::text('sale_price') }}</td>
	</tr>
</table>