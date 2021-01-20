<style>
    input[type=file] {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<div>
    <h1 class="font-bold text-cool-gray-900 text-2xl mb-6">Input Data Hotel Anda</h1>
    <hr class="divide-cool-gray-900 mb-6">
    <form class="grid grid-cols-2 gap-y-4 mt-4 px-4 text-gray-700" action="{{ route('dashboard.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <h1 class="text-xl font-bold">Name :</h1>
        <input type="text" name="name" class="form-input shadow-sm" placeholder="Nama" required autocomplete="name">
        @error('name')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Description :</h1>
        <textarea name="description" cols="30" rows="3" class="form-input shadow-sm" placeholder="Desc" required autocomplete="desc"></textarea>
        @error('description')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Images :</h1>
        <input type="file" accept="image/x-png,image/gif,image/jpeg" name="images" class="form-input shadow-sm">
        @error('images')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Address :</h1>
        <input type="text" name="address" class="form-input shadow-sm overflow-hidden" placeholder="Address" required autocomplete="address-level1">
        @error('address')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Phone :</h1>
        <input type="number" name="phone" class="form-input shadow-sm" placeholder="Phone" required autocomplete="phone">
        @error('phone')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Email :</h1>
        <input type="tel" name="email" class="form-input my-2 shadow-sm" placeholder="Email" required autocomplete="email">
        @error('email')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <h1 class="text-lg font-bold">Coordinate :</h1>
        <div class="flex">
            <input type="text" name="latitude" class="w-1/2 form-input mr-2 shadow-sm" placeholder="Latitude" required>
            @error('email')
            <p class="text-red-500 text-xs italic mt-4">
                {{ $message }}
            </p>
            @enderror
            
            <input type="text" name="longitude" class="w-1/2 form-input ml-2 shadow-sm" placeholder="Longitude" required>
            @error('email')
            <p class="text-red-500 text-xs italic mt-4">
                {{ $message }}
            </p>
            @enderror
        </div>
        
        <button type="submit" class="p-4 my-2 bg-green-500 hover:bg-green-700 text-white rounded-md shadow-sm transition duration-300 ease-in-out col-span-2">Submit</button>
    </form>
</div>