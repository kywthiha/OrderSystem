<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <x-flash-message />
                        <div class="text-lg font-bold">
                            User Info
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center p-2 gap-4">
                                <div>Name:</div>
                                <div>
                                    {{ $admin->name }}
                                </div>
                            </div>
                            <div class="flex p-2 gap-4">
                                <div>Roles:</div>
                                <div>
                                    <ul>
                                        @foreach ($admin->roles as $role)
                                            <li class="mb-2">
                                                <label class="flex items-center gap-2 mb-1">
                                                    <p>
                                                        {{ $role->name }}
                                                    </p>

                                                </label>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($role->permissions as $permission)
                                                        <span
                                                            class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $permission->name ?? '-' }}</span>
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>

                            </div>

                            <div class="flex items-center p-2 gap-4">
                                <div>Created At:</div>
                                <div>
                                    {{ $admin->created_at ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Created By:</div>
                                <div>
                                    {{ $admin->created_by->name ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Updated At:</div>
                                <div>
                                    {{ $admin->updated_at ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Updated By:</div>
                                <div>
                                    {{ $admin->updated_by->name ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 flex gap-5">
                        <div class="flex float-right gap-3 items-center">
                            <a href="{{ route('admins.index') }}"
                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                Back </a>
                            <a href="{{ route('admins.edit', $admin) }}"
                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
