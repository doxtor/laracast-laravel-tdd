<div class="card mt-3">
    <ul class="ml-3 list-none text-sm">
        @foreach ( $project->activity as $activity )
            <li class="{{ $loop->last ? '' : 'mb-1'  }}">
                @include("projects.activity.{$activity->description}")
                {{ $activity->created_at->diffForHumans(null, true) }}
            </li>
        @endforeach
    </ul>
</div>
