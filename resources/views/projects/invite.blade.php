<div class="card flex flex-col mt-3">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-biru-padding pl-4 mb-3">
        Invite a User
    </h3>

    <form action="{{ $project->path() .'/invitations' }}" method="post">
        @method('post')
        @csrf
        <div class="mb-3">
            <input type="email" name="email" id="email" class="border border-gray-400 rounded w-full py-1 px-1" placeholder="Email address">
        </div>
        <button type="submit" class="button-biru">Invite</button>
    </form>

    @include('errors', ['bag' => 'invitations'])

</div>
