@extends('layouts.app')

@section('headscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@endsection

@section('content')
    <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>
    <form
        method="post"
        action="{{ $project->path() }}"
        class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow"
    >
        @method('PATCH')
        @include('projects._form',['buttonText' => 'Update Project'])
    </form>
@endsection
