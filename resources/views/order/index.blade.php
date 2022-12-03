<x-app-layout>
    <x-search>

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
                                        Customer Name
                                        <x-sort-link sortKey="user_name" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Item Count
                                        <x-sort-link sortKey="items_count" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Total Amount
                                        <x-sort-link sortKey="total_amount" />
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6 text-left ">
                                    <div class="flex">
                                        Created At
                                        <x-sort-link sortKey="created_at" />
                                    </div>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="py-4 px-6">
                                        <a href="{{ route('orders.show', $order) }}" class="underline">
                                            #{{ $order->id }}
                                        </a>
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        {{ $order->user_name ?? '' }}
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        @numberFormat($order->items_count ?? 0)
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        @numberFormat($order->total_amount ?? 0) MMK
                                    </td>
                                    <td scope="row" class="py-4 px-6">
                                        {{ $order->created_at }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse


                        </tbody>
                    </table>
                    <div class="py-6">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
