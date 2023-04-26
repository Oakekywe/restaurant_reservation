<x-guest-layout>
    <div class="container w-full px-5 py-6  sm:p-12 md:w-1/2">    
        {{-- table --}}
        <div class="relative overflow-x-auto p-2">
            <p>Your Reservation is: <b>{{ucwords($reservation->status)}}</b></p>
                <form>
                    @csrf
                    <div class="sm:col-span-6 mt-2">
                        <label for="reference_number" class="block mt-3 text-sm font-medium text-gray-700"> Reference Number
                        </label>
                        <div class="mt-1">
                            <input type="text" value="{{$reservation->reference_number}}" readonly
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-2">
                        <label for="email" class="block mt-3 text-sm font-medium text-gray-700"> Email
                        </label>
                        <div class="mt-1">
                            <input type="text" value="{{$reservation->email}}" readonly
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-2">
                        <label for="res_date" class="block mt-3 text-sm font-medium text-gray-700"> Reservation Date
                        </label>
                        <div class="mt-1">
                            <input type="text" value="{{$reservation->res_date}}" readonly
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-2">
                        <label for="table_id" class="block mt-3 text-sm font-medium text-gray-700"> Table
                        </label>
                        <div class="mt-1">
                            <input type="text" value="{{$reservation->table->name}}" readonly
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>
                    <div class="sm:col-span-6 mt-2">
                        <label for="guest_number" class="block mt-3 text-sm font-medium text-gray-700"> Guest Number
                        </label>
                        <div class="mt-1">
                            <input type="text" value="{{$reservation->guest_number}}" readonly
                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                    </div>                    
                </form>
                <a href="/" type="button"
                class="mt-10 px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full md:w-auto hover:bg-green-500 focus:outline-none">
                Back to Home
        </a>
        </div>
    </div>
    
</x-guest-layout>