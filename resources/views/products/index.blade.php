<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="px-12 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Product</a>
        </div>
    </div>

    <div class="py-12">
        @foreach ($products as $product)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
                <div class="overflow-hidden bg-white sm:rounded-lg p-6 mb-3 grid grid-cols-2">
                    <div>
                    <h2 class="text-2xl font-bold">{{ $product->name }}</h2>
                    <p class="text-lg text-gray-600">{{ $product->description }}</p>
                    <p class="text-lg text-gray-600">{{ $product->price }}</p>
                    <p class="text-lg text-gray-600">stock {{ $product->stock }}</p>
                    </div>
                    <div>
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-1/4">
                    </div>                    
                </div>                
                <a href="{{ route('products.show', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show</a>
                <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            </div>     

        @endforeach        
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $products->links() }}
            </div>
            
    </div>
    
</x-app-layout>
