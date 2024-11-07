@extends('layouts.base')

@section('content')
    <x-title color='red'>Create new product</x-title>
    <div class="max-w-2xl mx-auto">
        <form action="{{ route('products.store') }}" method="POST"
            class="flex flex-col space-y-4 p-6 bg-white shadow-md rounded-lg" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="block text-sm font-medium text-gray-700">Product name</label>
                <input type="text" name="name"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-10 focus:outline-indigo-500">
                @error('name')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-32 focus:outline-indigo-500"></textarea>
                @error('description')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-10 focus:outline-indigo-500">
                @error('price')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-10 focus:outline-indigo-500">
                @error('stock')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                <div id="drop-area"
                    class="mt-1 flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-md">
                    <img id="image-preview" class="hidden mb-4 max-h-48 rounded-md" />
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H20V16H8V28H16V36H28V28H36V16H28V8Z" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file-upload"
                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>

                                <input id="file-upload" name="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                    <p id="file-name-display" class="text-sm text-gray-600 mt-2"></p>
                </div>
                @error('image')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-upload');
        const fileNameDisplay = document.getElementById('file-name-display');
        const imagePreview = document.getElementById('image-preview');

        const updateFileNameAndPreview = (files) => {
            if (files.length > 0) {
                const file = files[0];
                fileNameDisplay.textContent = `Selected file: ${file.name}`;

                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                fileNameDisplay.textContent = '';
                imagePreview.classList.add('hidden');
                imagePreview.src = '';
            }
        };

        fileInput.addEventListener('change', (event) => {
            updateFileNameAndPreview(event.target.files);
        });

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('border-indigo-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-indigo-500');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('border-indigo-500');
            const files = event.dataTransfer.files;
            fileInput.files = files;
            updateFileNameAndPreview(files);
        });
    </script>
@endsection
