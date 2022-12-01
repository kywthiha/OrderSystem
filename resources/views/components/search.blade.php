<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form class="w-full flex md:ml-0 flex-wrap sm:flex-nowrap sm:px-6 px-2 py-2 items-center gap-4"
                method="GET">
                <label htmlFor="search-field" class="sr-only">
                    Search
                </label>
                <div class="relative w-full sm:w-60 ">
                    <input name="q" value="{{ request()->get('q') }}" type="search"
                        class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-full" />
                </div>
                @foreach (request()->except('q') as $key => $value)
                    @if (is_array($value))
                        @foreach ($value as $key1 => $value1)
                            <input name="{{ $key }}[{{ $key1 }}]" value="{{ $value1 }}"
                                type="hidden" />
                        @endforeach
                    @else
                        <input name="{{ $key }}" value="{{ $value }}" type="hidden" />
                    @endif
                @endforeach

                <div
                    class="sm:flex-1 hidden sm:flex w-full sm:w-auto flex-wrap sm:flex-nowrap justify-end items-center">
                    {{ $slot }}
                </div>
            </form>
        </div>

    </div>
</div>
