<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @error('image')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Image</strong>
                </div>
            </div>
            
        @enderror
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-2 gap-4">
                @csrf
                @method('PUT')
                <div>
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div class="mb-3">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ $product->description }}</textarea>
                    
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
                <div class="mb-3">
                    <label for="product_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="product_category_id" id="product_category_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="Update Product" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm mt-1 mb-5 block w-full">
                    <div class="p-2 bg-gray-100 rounded-md">
                        <img src="/{{ $product->image }}" alt="{{ $product->name }}" class="w-1/4">
                    </div>                 
                </div>
            </form>
        </div>
    </div>

    
    
</x-app-layout>
