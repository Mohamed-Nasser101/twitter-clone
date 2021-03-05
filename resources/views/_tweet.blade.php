<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }} ">
    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile', $tweet->user ) }}">
            <img
            src="{{ $tweet->user->avatar }}"
            alt=""
            class="rounded-full mr-2" width="40" height="40">
        </a>
    </div>

    <div style="width: 100%">
        <div class="flex justify-between">
            <a class="font-bold mb-2" href="{{ route('profile', $tweet->user ) }}">
                {{ $tweet->user->name }}</a>

            @can('delete', $tweet)

                <div class="mr-4">
                    <form action="{{ route('tweet.delete',$tweet) }}" method="POST"> @csrf @method('delete')
                    <button type="submit"
                    class="bg-red-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded-full shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">
                    delete</button></form>
                </div>
                
            @endcan

        </div>
        <p class="text-sm">
            {{ $tweet->body }}
        </p>

        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth

    </div>
</div>
