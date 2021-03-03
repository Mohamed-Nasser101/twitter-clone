@if (auth()->user()->isNot($user))
<form method="POST" action="{{ route('followThis', $user) }}">
    @csrf
    <button
        type="submit"
        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs">
        {{ auth()->user()->following($user) ? 'Unfollow' : 'Follow Me' }}
    </button>
</form>
@endif
