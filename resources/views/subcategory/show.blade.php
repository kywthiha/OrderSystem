<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <x-flash-message />
                        <div class="text-lg font-bold">
                            Sub Category Info
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center p-2 gap-4">
                                <div>Name:</div>
                                <div>
                                    {{ $subcategory->name }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Category:</div>
                                <div>
                                    {{ $subcategory->category->name ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Created At:</div>
                                <div>
                                    {{ $subcategory->created_at ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Created By:</div>
                                <div>
                                    {{ $subcategory->created_by->name ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Updated At:</div>
                                <div>
                                    {{ $subcategory->updated_at ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Updated By:</div>
                                <div>
                                    {{ $subcategory->updated_by->name ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 flex gap-5">
                        <div class="flex float-right gap-3 items-center">
                            <a href="{{ route('subcategories.index') }}"
                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                Back </a>
                            <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
