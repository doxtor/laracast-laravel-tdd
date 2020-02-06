@extends('layouts.app')
@section('headscript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
@endsection

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-abu-tulisan text-sm font-normal">
                <a href="/projects" class="text-abu-tulisan text-sm font-normal no-underline">My Project</a> / {{ $project->title }}
            </p>
            <a class="button-biru" href="{{ $project->path() . '/edit/' }}">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-abu-tulisan font-normal mb-3">Task</h2>
                    {{-- tasks --}}
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="post" action="{{ $task->path() }}">
                                @csrf
                                @method('PATCH')
                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-300' : '' }}">
                                    <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? "checked" : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form method="post" action="{{ $project->path() . '/tasks' }}">
                            @csrf
                            <input placeholder="Add a new task..." class="w-full" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-abu-tulisan font-normal">General Notes</h2>

                    {{-- General Notes --}}
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea class="card w-full mb-4 text-black"
                                  name="notes"
                                  style="min-height: 200px;"
                                  placeholder="Anything special you want to make note?">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                    @if($errors->any())
                        <div class="field mt-6">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red-600">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
                @include('projects.activity.card')
            </div>
        </div>
    </main>


@endsection

