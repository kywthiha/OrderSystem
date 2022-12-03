<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class=" overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <x-flash-message />
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="col-span-1">
                                        <div class="text-lg font-bold">
                                            User Info
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Name
                                                <span class="text-red-700 ml-2 text-xs">
                                                    (Required)
                                                </span>
                                            </label>
                                            <input required type="text" name="name" autocomplete="given-name"
                                                value="{{ old('name', '') }}"
                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Email
                                                <span class="text-red-700 ml-2 text-xs">
                                                    (Required)
                                                </span>
                                            </label>
                                            <input required type="email" name="email" value="{{ old('email', '') }}"
                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Password
                                                <span class="text-red-700 ml-2 text-xs">
                                                    (Required)
                                                </span>
                                            </label>
                                            <input required type="password" name="password"
                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>

                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Confirm Password
                                                <span class="text-red-700 ml-2 text-xs">
                                                    (Required)
                                                </span>
                                            </label>
                                            <input required type="password" name="password_confirmation"
                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Roles
                                            </label>
                                            <ul>
                                                @foreach ($roles as $role)
                                                    <li class="mb-2">
                                                        <label class="flex items-center gap-2 mb-1">
                                                            <input type="checkbox" name="roles[]"
                                                                value="{{ $role->id }}"
                                                                {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500   shadow-sm sm:text-sm border-gray-300 rounded-md" />
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
                                </div>
                            </div>
                            <div class="px-4 py-3 sm:px-6">
                                <x-button class="capitalize">Add User</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
