@extends('layouts.app')

@section('headscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@endsection

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">Let's start something new</h1>

        <form
            method="post"
            action="/projects"
        >
            @include('projects._form',['project' => new \App\Project(),'buttonText' => 'Create Project'])
        </form>
    </div>

@endsection
