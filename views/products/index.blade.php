<div class="grid md:grid-cols-4 gap-4">
    <div class="flex flex-col gap-2">
        <div class="mx-auto container">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">{{ $category->name }}</h1>
            <article class="prose dark:prose-invert">
                {!! $category->description !!}
            </article>
        </div>
        <div class="flex flex-col bg-background-secondary hover:bg-background-secondary/80 border border-neutral p-4 rounded-xl shadow-lg">
            @foreach ($categories as $ccategory)
                <!-- List all categories simple under each other -->
                <a href="{{ route('category.show', ['category' => $ccategory->slug]) }}" wire:navigate
                    @if ($category->id == $ccategory->id) class="font-bold" @endif>
                    {{ $ccategory->name }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col gap-6 col-span-3">
        @if (count($childCategories) >= 1)
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 h-fit">
                @foreach ($childCategories as $childCategory)
                    <div class="flex flex-col bg-background-secondary hover:bg-background-secondary/80 border border-neutral p-4 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                        @if(theme('small_images', false))
                            <div class="flex gap-x-3 items-center">
                        @endif
                        @if ($childCategory->image)
                            <img src="{{ Storage::url($childCategory->image) }}" alt="{{ $childCategory->name }}"
                                class="rounded-md {{ theme('small_images', false) ? 'w-14 h-fit' : 'w-full object-cover object-center' }}">
                        @endif
                        <h2 class="text-xl font-bold text-primary">{{ $childCategory->name }}</h2>
                        @if(theme('small_images', false))
                            </div>
                        @endif
                        @if(theme('show_category_description', true))
                            <article class="mt-2 prose dark:prose-invert">
                                {!! $childCategory->description !!}
                            </article>
                        @endif
                        <a href="{{ route('category.show', ['category' => $childCategory->slug]) }}" wire:navigate class="mt-2">
                            <x-button.primary>
                                {{ __('general.view') }}
                            </x-button.primary>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 h-fit">
            @foreach ($products as $product)
                <div class="flex flex-col bg-background-secondary hover:bg-background-secondary/80 border border-neutral p-4 rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                    <div class="flex gap-4 mb-4">
                        <div class="flex flex-col items-center gap-2 flex-shrink-0">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                    class="rounded-md w-14 h-14 object-cover object-center">
                            @endif
                        </div>
                        <div class="flex flex-col justify-start text-left flex-grow">
                            <h2 class="text-xl font-bold text-primary">{{ $product->name }}</h2>
                            <h3 class="text-lg font-semibold mb-2 text-secondary">
                                {{ $product->price() }}
                            </h3>
                        </div>
                    </div>
                    @if (($product->stock > 0 || !$product->stock) && $product->price()->available && theme('direct_checkout', false))
                        <a href="{{ route('products.checkout', ['category' => $category, 'product' => $product->slug]) }}"
                            wire:navigate class="w-full">
                            <x-button.primary class="w-full">{{ __('product.add_to_cart') }}</x-button.primary>
                        </a>
                    @else
                        <a href="{{ route('products.show', ['category' => $product->category, 'product' => $product->slug]) }}"
                            wire:navigate class="w-full">
                            <x-button.primary class="w-full">
                                {{ __('general.view') }}
                            </x-button.primary>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
