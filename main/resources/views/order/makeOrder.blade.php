@extends('layouts.master')
@section('extraStyle')    
    <link href="{{ asset('css/detail-restaurant-tabs.css') }}" rel="stylesheet">
    <style>
        main::after {
        content: "";
        background: url("/images/bg.png");
        opacity: 0.3;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
        }
        .nav-pills .nav-link.active{
            color: #000;
        }
    </style>
@endsection    
@section('content')
    <!-- side bar -->
    @include('balde_components.navs.side-bar')                       
    <!-- top nav bar -->
    @include('balde_components.navs.nav-bar-v2')
    
    <main class="w-full mt-16  relative  " >
        <!-- details -->
        <form method="post" action="setOrder" class="container flex flex-col lg:flex-row py-10">
            @csrf
            {{-- form inputs --}}
                <div class="flex-1  lg:mr-5">
                    {{-- Personal Details --}}
                        <div class="w-full rounded mb-3 shadow-lg">
                            <header class="w-full bg-green text-black text-xl rounded-t-sm py-4 px-3 font-bold text-left">
                            {{__('Personal Details')}}
                            </header>
                            <div class="bg-gray-50 dark:bg-gray-800 grid grid-cols-6 gap-6  p-4 rounded-b-sm" >
                                <!-- First name -->
                                    <div class="col-span-6  ">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            {{__('Full name')}}
                                        </label>
                                        <input 
                                                type="text" 
                                                name="first_name" 
                                                id="first_name"
                                                required 
                                                readonly
                                                value="{{auth()->user()->name}}"
                                                class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded bg-gray-100 text-gray-500" 
                                            >
                                    </div>
                                <!-- email -->
                                    <div class="col-span-6 md:col-span-3">
                                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                {{__('Email address')}}
                                            </label>
                                            <input 
                                                type="email" 
                                                name="email" 
                                                id="email" 
                                                required 
                                                readonly
                                                value="{{auth()->user()->email}}"
                                                class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded bg-gray-100 text-gray-500" 
                                            >
                                    </div>
                                <!-- phone -->
                                    @if(isset($customFields["phone"]))
                                        <div class="col-span-6 md:col-span-3   ">
                                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-white"> 
                                                {{__('Phone number')}}
                                            </label>
                                            <input 
                                                type="text" 
                                                name="phone" 
                                                id="phone" 
                                                autocomplete="phone" 
                                                placeholder="{{$customFields["phone"]["view"]}}"
                                                required  
                                                readonly
                                                value="@if(old('phone')){{ old('phone')}}@else{{$customFields["phone"]["value"]}}@endif"   
                                                class="mt-1 p-2 outline-none bg-gray-100 text-gray-500 block w-full shadow-sm sm:text-sm rounded  @error('phone') form-control is-invalid  @enderror"    
                                            >
                                            @error('phone')
                                                <div class="text-red-500 text-sm ">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="phone_type" value="default">
                                    @else
                                        <div class="col-span-6 md:col-span-3   ">
                                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-white"> 
                                                {{__('Phone number')}}
                                            </label>
                                            <input 
                                                type="text" 
                                                name="phone" 
                                                id="phone" 
                                                autocomplete="phone" 
                                                placeholder="{{__('Phone number')}} ..."
                                                required  
                                                value="{{ old('phone') }}"   
                                                class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded  @error('phone') form-control is-invalid  @enderror"    
                                            >
                                            @error('phone')
                                                <div class="text-red-500 text-sm ">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="phone_type" value="costume">
                                    @endif
                                
                                {{-- address --}}
                                    <div id="address" class="col-span-6 grid grid-cols-6 gap-6 " >
                                            @if (isset($customFields["address"]))
                                                <div class="col-span-5">
                                                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                        {{__('Delivery Addres')}} 
                                                    </label>
                                                        <select id="address" name="address" required class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded"  >
                                                            @foreach ($customFields["address"] as $address)
                                                                <option value="{{$address["value"]}}" selected >{{$address["view"]}}</option>
                                                            @endforeach                                        
                                                        </select>
                                                </div>
                                                <div class="col-span-1 flex flex-row items-center justify-center ">
                                                    <button class=" text-xs md:text-base py-1.5 bg-green text-white rounded  w-24 mt-4 px-2" type="button" onclick="setNewAddress()"> 
                                                        {{__('Btn Add new Addres')}}  
                                                    </button>
                                                </div>
                                                <input type="hidden" name="address_type" value="default">
                                            @else
                                                <div class="col-span-6 md:col-span-4">
                                                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                        {{__('Delivery Addres')}} 
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="address" 
                                                        id="address"  
                                                        placeholder="...." 
                                                        autocomplete="address"
                                                        required
                                                        value="{{ old('address') }}" 
                                                        class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded  @error('address') form-control is-invalid  @enderror "
                                                    >
                                                    @error('address')
                                                        <div class="text-red-500 text-sm ">{{ $message }}</div>
                                                    @enderror
                                                </div>   
                                                <div class="col-span-6 md:col-span-2">
                                                    <label for="street_address" class="block text-sm font-medium text-gray-700 dark:text-white">
                                                        {{__('Delivery Addres description')}}  
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="delivery_address_description" 
                                                        id="delivery_address_description" 
                                                        autocomplete="delivery_address_description"  
                                                        placeholder="example : Home"
                                                        required 
                                                        value="{{ old('street_address') }}" 
                                                        class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded  @error('delivery_address_description') form-control is-invalid  @enderror " 
                                                    >
                                                    @error('delivery_address_description')
                                                            <div class="text-red-500 text-sm ">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="address_type" value="costume">
                                            @endif
                                    </div>
                                {{-- hint --}}
                                    <div class="col-span-6">
                                        <label for="hint" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            {{__("Hint")}}
                                        </label>
                                        <textarea name="hint" id="hint" cols="10" rows="4" 
                                            style="border: 1px solid #eee" class="mt-1 p-3 outline-none block w-full shadow-md sm:text-sm rounded" >
                                            {{old("hint")}}
                                        </textarea>
                                    </div>                                
                            </div>
                        </div>
                    {{-- Payment Method --}}
                        <div class="w-full rounded my-3 shadow-lg">
                            <header class="w-full bg-green text-black text-xl rounded-t-sm py-4 px-3 font-bold text-left">
                                {{__('Payment Method')}}
                            </header>
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-b-sm">
                                <ul id="payment-tabs" class="nav nav-pills mb-3 flex flex-col md:flex-row" id="pills-tab" role="tablist">
                                    <li class="nav-item flex-1 text-md" role="presentation">
                                        <a class="nav-link active flex justify-between items-center dark:text-white" onclick="setMethod('cash')" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                            {{__('Pay with Cash')}}
                                            <i class="fas fa-wallet text-lg"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item flex-1 text-md" role="presentation">
                                        <a class="nav-link flex justify-between items-center dark:text-white" onclick="setMethod('paypal')" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                            {{__('Pay with Paypal')}}
                                            <i class="fab fa-cc-paypal text-lg"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item flex-1 text-md" role="presentation">
                                        <a class="nav-link flex justify-between items-center dark:text-white" onclick="setMethod('card')" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                            {{__('Pay with Credit card')}}
                                            <i class="far fa-credit-card text-lg"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <p class=" text-gray-900 dark:text-white text-3xl my-7">
                                            {{__('Pay with Cash description')}}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <p class=" text-gray-900 dark:text-white text-3xl my-7">
                                            {{__('Comming soon')}}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <p class=" text-gray-900 dark:text-white text-3xl my-7">
                                            {{__('Comming soon')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            {{-- Order Summary --}}
                <div class="w-full lg:w-1/3 rounded ">
                    <!-- order liste & prices -->
                    <div class=" w-full border-2 bg-gray-50 rounded border-gray-300 dark:border-gray-500 dark:bg-gray-800 border-dotted">
                        <div class="text-center border-b-2 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-500 border-dotted py-3">
                            <p class="text-2xl font-bold dark:text-white">{{__('Order Summary')}}</p>
                            <p id="restaurant_name" class="text-gray-900 dark:text-gray-200 font-medium "></p>
                        </div>
                        <div class="py-3 px-4 flex flex-col">  
                            <!-- details -->
                            <!-- Type of  Delivery -->
                            <div class="flex flex-row justify-between my-2">
                                <div class="text-black dark:text-white font-normal">{{__('Order Type')}}</div>
                                <div id="orderType" class="text-black dark:text-white font-bold"></div>
                            </div>   
                            <hr class="text-gray-400 dark:text-gray-100 my-2">
                            <!-- orders -->
                            <div id="orders" class="dark:text-white"></div>       
                            <!-- taxes -->
                            <div class="flex flex-row justify-between my-2">
                                <div class="text-black dark:text-white font-normal">{{__('Subtotal')}}</div>
                                <div id="subtotal" class="text-black font-bold dark:text-white"></div>
                            </div>
                            <div class="flex flex-row justify-between my-2">
                                <div class="text-black dark:text-white font-normal">{{__('Tax')}}</div>
                                <div id="tax" class="text-black dark:text-white font-bold "></div>
                            </div>
                            <div  class="flex flex-row justify-between my-2">
                                <div class="text-black dark:text-white font-normal">{{__('Delivery fee')}}</div>
                                <div id="delivery_fee" class="text-black dark:text-white font-bold "></div>
                            </div>
                            <!-- total -->
                            <div class="flex flex-row justify-between my-2 text-red-600 text-xl font-semibold">
                                <div class="">{{__('Total')}}</div>
                                <div id="total" class=""></div>
                            </div>                       
                            <!-- button -->
                            <div class="my-3">
                                <input type="hidden" name="order" id="order">
                                <input type="hidden" name="payment_method" id="payment_method">
                                <input type="hidden" name="orderType" id="orderTypeInput">
                                <button type="submit" class="form-control mb-3 p-2 border-none bg-green text-black font-semibold rounded">
                                    {{__('Make your Order')}}
                                </button>
                                <p class="text-center text-gray-600 dark:text-white text-sm font-light">
                                    {{__('Or Call Us at')}}<b id="restaurant_phone" class="font-semibold" ></b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </form>        
	</main>
    @include('balde_components.footer')
@endsection

@section('extraJs')
        <script>
            axios.get(`/api/getDefaultCurrency`)
            .then(response =>{setDefaultCurrency(response.data);})
            .catch((err) => {console.log(err);})
            axios.get(`/api/getCurrencyRight`)
            .then(response => setCurrencyRight(response.data != false))
            .catch((err) => {console.log(err);}) 
        </script>
@endsection
    <script type="application/javascript">    
        var order =JSON.parse(localStorage.getItem('order'));
        
        if (!order ||
            !["TakeAway", "Delivery"].includes(order.orderType) ||            
            order.orders === null ||
            order.orders.length === 0 ||
            order.orderType === null ||
            order.restaurant === null ||
            order.delivery_fee === null
        ){
            localStorage.removeItem("order");
            location.href=location.origin+"/notFound";
        }
        var tax=order.restaurant.admin_commission;   
        var total = order.total ;
        var default_currency=null;
        var currency_right=null;
        function wait(){setTimeout(function(){
            (default_currency != null || currency_right != null) ?showData() :wait();},5);
        }
        wait();
        showData=()=>{
            if (default_currency === null || currency_right === null) {wait();}
            else{
                document.getElementById("tax").textContent=tax+"%";  
                if(order.orderType !== "TakeAway"){
                    document.getElementById("delivery_fee").textContent=showPrice(order.delivery_fee); 
                }else{
                    document.getElementById("delivery_fee").textContent='free';
                    total=order.total-order.delivery_fee;
                    document.getElementById("address").innerHTML=``;
                }
                document.getElementById("total").textContent=showPrice(total+(total*tax)/100);
                document.getElementById("orderType").textContent=order.orderType;
                document.getElementById("subtotal").textContent=showPrice(order.total-order.delivery_fee);
                document.getElementById("restaurant_name").textContent=order.restaurant.name;
                document.getElementById("restaurant_phone").textContent=order.restaurant.phone;
                if(document.getElementById('orders').innerHTML === ""){
                    order.orders.forEach(element=>{
                        document.getElementById('orders').innerHTML +=`
                            <div class="flex flex-row justify-between my-2.5">
                                <div class="text-black dark:text-white font-normal">
                                    ${element.numberOfMeals} x ${element.food_name}
                                </div>
                                <div class="text-black dark:text-white font-bold ">
                                    ${showPrice(element.price)}
                                </div>
                            </div>`
                        ;
                    });
                }
                document.getElementById("order").setAttribute("value",JSON.stringify(order));
                document.getElementById("payment_method").setAttribute("value","cash");
                document.getElementById("orderTypeInput").setAttribute("value",order.orderType);
            }
        } 
        showPrice=(price = 0)=>{
            if(currency_right != false){
                return price.toFixed(2) +" "+default_currency
            }
            return default_currency+" "+price.toFixed(2) 
        }       
        setMethod=methode=>{
            document.getElementById("payment_method").setAttribute("value",methode);
            console.log(document.getElementById("payment_method"));
        }  
        setNewAddress=()=>{
            document.getElementById("address").innerHTML=`
            <div class="col-span-6 md:col-span-4">
                                                    <label for="city" class="block text-sm font-medium text-gray-700">
                                                        {{__('Delivery Addres')}} 
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="address" 
                                                        id="address"  
                                                        placeholder="...." 
                                                        autocomplete="address"
                                                        required
                                                        value="{{ old('address') }}" 
                                                        class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded  @error('address') form-control is-invalid  @enderror "
                                                    >
                                                    @error('address')
                                                        <div class="text-red-500 text-sm ">{{ $message }}</div>
                                                    @enderror
                                                </div>   
                                                <div class="col-span-6 md:col-span-2">
                                                    <label for="street_address" class="block text-sm font-medium text-gray-700">
                                                        {{__('Delivery Addres description')}}  
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        name="delivery_address_description" 
                                                        id="delivery_address_description" 
                                                        autocomplete="delivery_address_description"  
                                                        placeholder="example : Home"
                                                        required 
                                                        value="{{ old('street_address') }}" 
                                                        class="mt-1 p-2 outline-none  block w-full shadow-sm sm:text-sm rounded  @error('delivery_address_description') form-control is-invalid  @enderror " 
                                                    >
                                                    @error('delivery_address_description')
                                                            <div class="text-red-500 text-sm ">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="address_type" value="costume">
            
            `;
        }
        setDefaultCurrency=currency=>{default_currency=currency;}
        setCurrencyRight=isRight=>{currency_right=isRight;} 
    </script>