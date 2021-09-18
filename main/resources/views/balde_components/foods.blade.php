<section class="container py-4 w-full flex flex-col lg:flex-row ">
    <div class="w-full mt-3">
        <div class="grid gap-5 grid-cols-1 md:grid-cols-2 ">
            @forelse ($foods as $food)
                <div  onclick="goToFood({{ $food->restaurant->id }})" class="cursor-pointer box h-44 w-full flex" >
                    <div class="h-full w-1/3">
                        @if ($food->thumbnail($food->id) != "")
                            <img src="{{$food->thumbnail($food->id)}}" alt="food image" class="h-full w-full rounded-l-md object-cover">
                        @else
                            <img src='/images/food-placeholder.jpeg' alt="food image" class="h-full w-full rounded-l-md object-cover">
                        @endif
                    </div>
                    <div class="flex-1 relative flex flex-col justify-between bg-gray-50 rounded-r-md px-4 pt-4 pb-3">
                        <div class="flex w-full justify-between align-items-start">
                            <div>
                                <span class="text-gray-800 ">
                                    {{$food->category->name}}
                                </span>
                                <h2 class="text-black text-2xl font-bold ">
                                    {{$food->name}}
                                </h2>
                                <p class="text-gray-400 text-sm">{{$food->restaurant->name}}</p>
                                <p class="text-gray-400 text-xs">{{$food->restaurant->address}}</p>
                            </div>
                            @if ($food->rate)
                                <div class="bg-gray-200 py-1 px-2 rounded">
                                    <span class="text-gray-700 font-semibold">
                                        {{$food->rate}}
                                    </span>
                                    <i class="text-gold fas fa-star"></i>
                                </div>
                            @endif
                            
                        </div>

                        <div class="flex w-full justify-between align-items-baseline">
                            <div class="flex flex-row items-center">
                                <p class="text-green text-base font-bold sm py-1 px-2">
                                    {!! getPrice($food->getPrice()) !!}
                                </p>
                                @if ($food->discount_price !=0)
                                    <span class="bg-red-600 text-black rounded text-sm py-1 px-2">
                                        -{{number_format(100-($food->discount_price * 100 / $food->price),0)}} %
                                    </span>
                                @endif
                            </div>
                            <div class="text-sm">
                                <span class="px-1 @if (!$food->restaurant->available_for_delivery || $food->restaurant->closed) line-through text-gray-400 @else text-gray-600 @endif" >
                                    {{__("Delivery")}}
                                    <i class="fas fa-motorcycle"></i>
                                </span>

                                <span class="px-1 @if ($food->restaurant->closed) line-through text-gray-400 @else text-gray-600 @endif" >
                                    {{__("Take away")}}
                                    <i class="fas fa-shopping-basket"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                    <div class="text-center font-bold text-3xl col-span-4 h-24 flex flex-row justify-center items-center">
                        {{__('No food is found')}}
                    </div>
            @endforelse
        </div>
    </div>
</section>
