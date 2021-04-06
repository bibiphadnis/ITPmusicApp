@extends('layouts.main')

@section('title', 'Admin')

@section('content')
    <form method="post" action="{{ route('auth.update') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="maint">Maintenance Mode</label>
            <input type="hidden" id="maint" name="maint" value="false" />
            <input type="checkbox" id="maint" name="maint" value="true" 
            <?php if ($config->value) echo 'checked="checked"'; ?> >
        </div>
        <input type="submit" value="Save" class="btn btn-primary btn-sm">
    </form>

    <form method="post" action="{{ route('stats') }}">
        @csrf
        <input type="submit" value="Email Stats to Users" class="btn btn-primary btn-sm">
    </form>

   
@endsection