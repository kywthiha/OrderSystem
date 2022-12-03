<x-app-layout>
    <x-search></x-search>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        ID
                                        <x-sort-link sortKey="id" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Name
                                        <x-sort-link sortKey="name" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Email
                                        <x-sort-link sortKey="email" />
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Created At
                                        <x-sort-link sortKey="created_at" />
                                    </div>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Activate
                                        <x-sort-link sortKey="email" />
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6 text-right">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="py-4 px-6">
                                        #{{ $user->id }}
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        {{ $user->name }}
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        {{ $user->email }}
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        {{ $user->created_at }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-3 items-center">
                                            <form method="POST" action="{{ route('users.update', $user) }}">
                                                @csrf
                                                @method('PUT')
                                                <input value="0" type="hidden" name="is_activate">
                                                <input onchange="this.form.submit()" value="1" type="checkbox"
                                                    name="is_activate" {{ $user->is_activate ? 'checked' : '' }}>


                                            </form>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex float-right gap-3 items-center">
                                            <form method="POST" onsubmit="return confirm('Are you sure delete?');"
                                                action="{{ route('users.destroy', $user) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center underline text-red-800 px-4 py-2 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                    <div class="py-6">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
