<div class="card flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-biru-padding pl-4 mb-3">
        <a href="{{ $project->path() }}" class="text-black no-underline"> {{ $project->title }}</a>
    </h3>
    <div class="text-abu-tulisan mb-4 flex-1">{{ Str::limit($project->description, 100) }}</div>
    @can('manage', $project)
        <footer>
            <form action="{{ $project->path() }}" method="post" class="text-right">
                @method('delete')
                @csrf
                <button type="submit" class="text-sm">Delete</button>
            </form>
        </footer>
    @endcan
</div>
