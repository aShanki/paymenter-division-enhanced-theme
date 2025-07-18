<div class="flex flex-col @if ($product->image) md:grid grid-cols-2 gap-16 bg-background-secondary hover:bg-background-secondary/80 border border-neutral p-6 rounded-xl shadow-xl @endif">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="flex flex-col">
        @if ($product->stock === 0)
            <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded bg-red-900 text-red-300 w-fit mb-3">
                {{ __('product.out_of_stock', ['product' => $product->name]) }}
            </span>
        @elseif($product->stock > 0)
            <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded bg-green-900 text-green-300 w-fit mb-3">
                {{ __('product.in_stock') }}
            </span>
        @endif
        <div class="flex flex-row justify-between">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">{{ $product->name }}</h2>
                <h3 class="text-2xl font-semibold text-primary mt-2">
                    {{ $product->price() }}
                </h3>
            </div>
        </div>
        <div class="my-4">
            <article class="prose dark:prose-invert max-w-none leading-relaxed text-left">
                <div x-data="{ expanded: false }" class="relative">
                    <div x-show="!expanded" class="overflow-hidden relative" style="max-height: 15rem;">
                        {!! $product->description !!}
                        <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-gray-900 to-transparent"></div>
                    </div>
                    <div x-show="expanded">
                        {!! $product->description !!}
                    </div>
                    <button 
                        @click="expanded = !expanded" 
                        class="text-primary hover:text-primary/80 text-sm font-medium mt-2 transition-colors"
                        x-text="expanded ? 'Show less' : 'Read more'"
                    ></button>
                </div>
            </article>
        </div>
    </div>
    @if ($product->image)
        <div class="flex flex-col">
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                class="w-full h-96 object-contain object-center rounded-md">
            
            @if ($product->stock !== 0 && $product->price()->available)
                <a href="{{ route('products.checkout', ['category' => $category, 'product' => $product->slug]) }}"
                    wire:navigate class="mt-4">
                    <x-button.primary class="w-full">{{ __('product.add_to_cart') }}</x-button.primary>
                </a>
            @endif
        </div>
    @endif
</div>
