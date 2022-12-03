<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class=" overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <x-flash-message />
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="col-span-1">
                                        <div class="text-lg font-bold">
                                            Role Info
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Name
                                                <span class="text-red-700 ml-2 text-xs">
                                                    (Required)
                                                </span>
                                            </label>
                                            <input required type="text" name="name" autocomplete="given-name"
                                                value="{{ old('name', $role->name) }}"
                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        </div>
                                        <div class="mt-3">
                                            <label class="block text-sm font-semibold ">
                                                Permissions
                                            </label>
                                            <ul>
                                                @foreach ($permissons as $permission)
                                                    <li>
                                                        <label class="flex items-center gap-2 mb-1">
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->id }}"
                                                                {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}
                                                                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500   shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                                            <p>
                                                                {{ $permission->name }}
                                                            </p>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 sm:px-6">
                                <x-button class="capitalize">Update Roles</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
