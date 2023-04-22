<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto ">
    
        <h1>Thank you for reservation.</h1>
        <p>Your reference number is: <b>{{$res->reference_number}}</b></p>
        <a href="/" type="button"
                class="mt-10 px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full md:w-auto hover:bg-green-500 focus:outline-none">
                Back to Home
        </a>
    </div>
    
</x-guest-layout>