<h2 class="headline_no_border">Account angaben</h2>
<table class="table table-striped">
    <tr>
        <td width="200"><strong>E-Mail</strong></td>
        <td>{{ Form::text('email', Input::old('email'),  array('class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td width="200"><strong>Password</strong></td>
        <td>{{ Form::password('password', array('class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td width="200"><strong>Password wiederholen</strong></td>
        <td>{{ Form::password('password_confirmation', array('class' => 'form-control')) }}</td>
    </tr>
</table>
<br/>
<h2 class="headline_no_border">Summoner Informationen</h2>
<table class="table table-striped">
    <tr>
        <td width="200"><strong>Summoner Name</strong></td>
        @if(Auth::check() && Auth::user()->summoner)
            <td>{{ Form::text('summoner_name', Auth::user()->summoner->name,  array('class' => 'form-control')) }}</td>
        @else
            <td>{{ Form::text('summoner_name', Input::old('summoner_name'),  array('class' => 'form-control')) }}</td>
        @endif
    </tr>
    <tr>
        <td width="200"><strong>Server Region</strong></td>
        <td>
            <select name="region" class="form-control">
                <option value="euw">EU-West</option>
                <option value="na">Nordamerika</option>
            </select>
    </tr>
    <tr>
        <td width="200"><strong>Beschreibung</strong></td>
        <td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control')) }}</td>
    </tr>
</table>
