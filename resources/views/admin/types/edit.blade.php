@extends('layouts.admin')

@section('content')
    <h1>Edit the selected type</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
@endsection
