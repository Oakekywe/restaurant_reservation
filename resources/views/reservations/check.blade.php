<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto ">
    
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <div>
                    @if (session('error'))
                        <div class="alert text-red-400 p-3 my-2 rounded">
                            {{session('error')}}
                        </div>
                    @endif
                </div>
                <h1>Enter Your Reference Number</h1>                

                <form method="POST" action="{{ route('reservation.check') }}">
                    @csrf
                    <div class="sm:col-span-6 mt-2">
                        <label for="reference_number" class="block mt-3 text-sm font-medium text-gray-700"> Reference Number
                        </label>
                        <div class="mt-1">
                            <input type="text" id="reference_number" name="reference_number"
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('reference_number')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-6 p-4 flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Check</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-guest-layout>