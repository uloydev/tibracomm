{{-- print all errors including form error --}}
@if ($errors->any())
    <div class="container">
        <div class="relative w-full p-4 text-white bg-red-500 rounded-lg mt-8">
            <button type="button" class="absolute top-0 right-0 mr-4 text-white text-2xl"
                onclick="this.parentElement.style.display='none';">
                &times;
            </button>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
