@extends('layouts.master')
@section('extraStyle')
    <link href="{{ asset('/main/public/css/checkbox-radio-input.css') }}" rel="stylesheet">
@endsection
@section('content')
    {{-- side bar --}}
        @include('balde_components.navs.side-bar')
    {{-- top nav bar --}}
        @include('balde_components.navs.nav-bar-v2')
    {{-- main page content --}}
        <main class="w-full mt-16" >
            {{-- main header --}}
                <header class="py-3  w-full md:h-24  bg-gray-100 dark:bg-gray-700">
                    <div class="container flex flex-col md:flex-row md:justify-between items-center ">
                            <div class="hidden md:block">
                                <div class="text-black dark:text-white text-sm py-1 ">
                                    <a href="/" class="hover:text-gray-800 dark:text-gray-100 hover:no-underline">
                                        {{__("Home")}}
                                    </a> &nbsp; > &nbsp;
                                    <a href="/foods" class="text-green hover:text-green-400 hover:no-underline">
                                        {{__("Foods")}}
                                    </a>
                                </div>
                                <p class="text-black dark:text-white font-medium text-lg py-1">
                                    {{__('Search for restaurants or foods')}}
                                </p>
                            </div>

                            <form action="/search" method="get"  class=" w-full h-12 md:w-2/5 md:h-4/6 bg-white flex flex-row rounded ">
                                {{-- @csrf --}}
                                <input id="search" type="search"  name="search"
                                    class="flex-1 bg-white outline-none p-3  rounded-l-sm"
                                    placeholder="{{__('Search for restaurants or foods')}} ..."
                                    autocomplete="off"
                                    required
                                >
                                <button type="submit" class="w-14 bg-green rounded-r-sm text-black"><i class="fas fa-search"></i></button>
                            </form>
                    </div>
                </header>

            {{-- header description --}}
                <div class="container w-full flex flex-col pt-4 ">
                    <span class="w-40 h-1 bg-green"></span>
                    <div class="flex items-center justify-between">
                        <h2 class="text-black dark:text-white font-bold text-4xl pt-3 pb-2">
                            {{__("Foods")}}
                        </h2>
                        <a id="foods" href="#foods" class="nav-link text-black align-middle text-center bg-green rounded-3xl py-2 px-4 leading-6">
                            {{__("Total")}} {{$total}}
                        </a>
                    </div>
                </div>
            {{-- food boxes --}}
            @include('balde_components.foods')
            {{-- pagination --}}
                <nav aria-label="Page navigation example" class="py-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if ($foods->onFirstPage()) disabled @endif">
                            <a class="page-link text-black hover:text-green-400" href="{{$foods->previousPageUrl()}}" tabindex="-1" aria-disabled="true">
                                {{__("Previous")}}
                            </a>
                        </li>
                        <li class="page-item ">
                            <p class="page-link cursor-default text-black hover:text-gray-600">
                                {{__("Page")}} {{$foods->currentPage()}}  {{__("of")}} {{$foods->lastPage()}}
                            </p>
                        </li>

                        <li class="page-item  @if ($foods->currentPage() === $foods->lastPage()) disabled @endif">
                            <a class="page-link text-black hover:text-green " href="{{$foods->nextPageUrl()}}">
                                {{__("Next")}}
                            </a>
                        </li>
                    </ul>
                </nav>
        </main>
    {{-- footer--}}
        @include('balde_components.footer')
@endsection

@section('extraJs')
    <script type="application/javascript">
        function goToFood(restaurant_id){
            location.href=window.location.origin+'/restaurant/'+restaurant_id+'#foods';
        }
    </script>
@endsection

