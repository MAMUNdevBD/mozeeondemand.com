<div class=" w-full  relative flex justify-center " style="height: 65vh;">
    <img src="/images/banner.jpg" alt="banner" class="absolute w-full h-full  object-cover opacity-70 z-0">
    <div class="w-full h-full bg-black"></div>
    <div class="z-10 container  absolute top-1/4 w-11/12  md:w-2/3 flex flex-col  text-center   h-96 ">
            <h2 class="text-2xl font-bold text-white py-3  "> 
                At Mozee on demand we aim to meet your delivery needs and is our pleasure to serve you!
            </h2>
            <p class="hidden md:block text-white font-light pt-2 pb-5 text-xl"> 
            Mozee thru our selection titles and make leisure time for your self by allowing  our team members to help 
            </p>
            <form   class="bg-white h-14 p-2 rounded flex flex-row" action="/search" method="get">
                <input 
                    class="border-white px-2 rounded outline-white flex-1 border-r-2 "
                    name="search"
                    type="search"
                    id="search"
                    placeholder="{{__("Search for restaurants or foods")}} ..."
                    required
                    autocomplete="off"
                >
                <button class="w-10 text-green" type="submit"> <i class="fas fa-search"></i></button>
            </form>
    </div>
</div>

