<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.reservations.create')}}"
                class="px-2 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Reservation</a>
            </div>
             {{-- table --}}
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Reference Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reserved Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Table
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Guest Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$reservation->reference_number}}
                            </th>
                            <td class="px-6 py-4">
                                {{$reservation->first_name}} {{$reservation->last_name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->email}}
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->phone_number}}
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->res_date}}
                            </td>
                            <td class="px-6 py-4">
                                @if ($reservation->table)                                
                                    {{$reservation->table->name}}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{$reservation->guest_number}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                        <form
                                            class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                            method="POST"
                                            action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                            </td>
                        </tr>
                        
                    @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
