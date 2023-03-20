<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.categories.create')}}"
                class="px-2 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Category</a>
            </div>
            <div>
                 @if (session('message'))
                    <div class="alert bg-green-200 p-3 my-2 rounded">
                        {{session('message')}}
                    </div>
                @endif
            </div>

            {{-- table --}}
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            
                            <td class="px-6 py-4">
                                {{$category->name}}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($category->image) }}" class="w-20 h-20 rounded-lg" />                                
                            </td>
                            <td class="px-6 py-4">
                                {{$category->description}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="bg-green-500 hover:bg-green-700 text-white px-3 py-2 mr-2 rounded">Edit</a>
                                    <form action="{{route('admin.categories.destroy', $category->id)}}" method="post"
                                        class="px-3 py-2 text-white bg-red-500 hover:bg-red-700 rounded" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method("DELETE")
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
