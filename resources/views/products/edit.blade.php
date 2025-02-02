<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div class="mb-3">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description" value="{{ $product->description }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div class="mb-3">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div class="mb-3">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="text" name="stock" id="stock" value="{{ $product->stock }}" class="form-input
                    rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div class="mb-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <input type="submit" value="Update Product" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </form>
        </div>
    </div>

    
    
</x-app-layout>
