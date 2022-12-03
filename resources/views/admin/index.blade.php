<x-app-layout>
    <x-search>
        <x-nav-link :href="route('admins.create')">
            {{ __('New User') }}
        </x-nav-link>
    </x-search>
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

                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Created By
                                        <x-sort-link sortKey="created_user_name" />
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
                                    <td scope="row" class="py-4 px-6">
                                        {{ $user->created_user_name ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex float-right gap-3 items-center">
                                            <a href="{{ route('admins.edit', $user->id) }}"
                                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                                Edit
                                            </a>


                                            <form method="POST" action="{{ route('admins.destroy', $user->id) }}"
                                                onsubmit="return confirm('Are you sure delete?');">
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
                                <p>Empty Users</p>
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
