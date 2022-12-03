<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <x-flash-message />
                        <div class="text-lg font-bold">
                            Order Info
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center p-2 gap-4">
                                <div>Customer Name:</div>
                                <div>
                                    {{ $order->user->name ?? '-' }}
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Total Amount:</div>
                                <div>
                                    @numberFormat($order->total_amount ?? 0) MMK
                                </div>
                            </div>
                            <div class="flex items-center p-2 gap-4">
                                <div>Item Count:</div>
                                <div>
                                    @numberFormat($order->items->count() ?? 0)
                                </div>
                            </div>

                            <div class="flex items-center p-2 gap-4">
                                <div>Created At:</div>
                                <div>
                                    {{ $order->created_at ?? '-' }}
                                </div>
                            </div>
                            <div class="mt-3">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-left ">
                                                <div class="flex">
                                                    ID

                                                </div>

                                            </th>
                                            <th scope="col" class="py-3 px-6 text-left ">
                                                <div class="flex">
                                                    Item Name
                                                </div>
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-left ">
                                                <div class="flex">
                                                    Qty

                                                </div>

                                            </th>
                                            <th scope="col" class="py-3 px-6 text-left ">
                                                <div class="flex">
                                                    Price

                                                </div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order->items as $item)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td scope="row" class="py-4 px-6">
                                                    <a href="{{ route('items.show', $item) }}" class="underline">
                                                        #{{ $item->id }}
                                                    </a>
                                                </td>
                                                <td scope="row" class="py-4 px-6">
                                                    {{ $item->name ?? '' }}
                                                </td>
                                                <td scope="row" class="py-4 px-6">
                                                    {{ $item->pivot->quantity ?? '-' }}
                                                </td>
                                                <td scope="row" class="py-4 px-6">
                                                    @numberFormat($item->price ?? 0) MMK
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 flex gap-5">
                        <div class="flex float-right gap-3 items-center">
                            <a href="{{ route('orders.index') }}"
                                class="inline-flex underline items-center px-4 py-2 text-sm text-gray-800">
                                Back </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
