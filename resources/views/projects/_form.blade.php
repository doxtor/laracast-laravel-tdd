
@csrf
<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Title</label>
    <div class="control">
        <input
            class="input bg-transparent border border-abu-terang rounded p-2 text-xs w-full"
            type="text"
            name="title"
            id="title"
            required
            value="{{ $project->title }}"
        >
    </div>
</div>

<div class="field">
    <label class="label" for="Description">Description</label>
    <div class="control">
        <textarea
            class="textarea"
            name="description"
            id="description"
            required
            cols="30" rows="10"
        >{{ $project->description }}</textarea>
    </div>
</div>
<div class="field">
    <div class="control">
        <button class="button-biru mr-2" type="submit">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}" class="items-center align-text-bottom">Cancel</a>
    </div>
</div>

@if($errors->any())
    <div class="field mt-6">
            @foreach($errors->all() as $error)
                <li class="text-sm text-red-600">{{ $error }}</li>
            @endforeach
    </div>
@endif
