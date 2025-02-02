<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product categories') }}
        </h2>
    </x-slot>

    <div class="px-12 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Product</a>
        </div>
    </div>

    <div class="py-12">
        
            @foreach ($product_categories as $category)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
                    <div class="overflow-hidden bg-white sm:rounded-lg p-6 mb-3 grid grid-cols-2">
                        <div>
                        <h2 class="text-2xl font-bold">{{ $category->name }}</h2>
                        <p class="text-lg text-gray-600">{{ $category->description }}</p>
                        </div>
                        <div>
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-1/4">
                        </div>                    
                    </div>                
                    <a href="{{ route('categories.show', $category) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show</a>
                    <a href="{{ route('categories.edit', $category) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                </div>
            @endforeach

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $product_categories->links() }}
            </div>
            
    </div>
    
</x-app-layout>
