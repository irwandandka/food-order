@extends('layouts.app')
@section('content')
    <div class="container">
        @livewire('form', ['data' => $data ?? null])
    </div>
@endsection