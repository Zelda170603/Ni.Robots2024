@extends('layouts.adminLY')

@section('content')
    <!-- Main widget -->
    <div class="md:col-span-2 col-span-4">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">$45,385</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Sales this week</h3>
                </div>
                <div class="flex items-center justify-end flex-1 text-base font-medium text-green-500 dark:text-green-400">
                    12.5%
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div id="main-chart"></div>
            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                <div>
                    <button
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        type="button" data-dropdown-toggle="weekly-sales-dropdown">Last 7 days <svg class="w-4 h-4 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="weekly-sales-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-blue-700 sm:text-sm hover:bg-gray-100 dark:text-blue-500 dark:hover:bg-gray-700">
                        Sales Report
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="md:col-span-2 col-span-4">
        <!--Tabs widget -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Statistics this month
                <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg
                        class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd"></path>
                    </svg><span class="sr-only">Show information</span></button>
            </h3>
            <div data-popover id="popover-description" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <div class="p-3 space-y-2">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Statistics</h3>
                    <p>Statistics is a branch of applied mathematics that involves the collection, description, analysis,
                        and inference of conclusions from quantitative data.</p>
                    <a href="#"
                        class="flex items-center font-medium text-primary-600 dark:text-primary-500 dark:hover:text-primary-600 hover:text-primary-700">Read
                        more <svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg></a>
                </div>
                <div data-popper-arrow></div>
            </div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select tab</label>
                <select id="tabs"
                    class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option>Statistics</option>
                    <option>Services</option>
                    <option>FAQ</option>
                </select>
            </div>
            <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400"
                id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                <li class="w-full">
                    <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq"
                        aria-selected="true"
                        class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Top
                        products</button>
                </li>
                <li class="w-full">
                    <button id="about-tab" data-tabs-target="#about" type="button" role="tab"
                        aria-controls="about" aria-selected="false"
                        class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Top
                        Customers</button>
                </li>
            </ul>
            <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img class="flex-shrink-0 w-10 h-10" src="/images/products/iphone.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            iPhone 14 Pro
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                                </path>
                                            </svg>
                                            2.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $445,467
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img class="flex-shrink-0 w-10 h-10" src="/images/products/imac.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            Apple iMac 27"
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                                </path>
                                            </svg>
                                            12.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $256,982
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img class="flex-shrink-0 w-10 h-10" src="/images/products/watch.png"
                                        alt="watch image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            Apple Watch SE
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-red-600 dark:text-red-500">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                                </path>
                                            </svg>
                                            1.35%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $201,869
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img class="flex-shrink-0 w-10 h-10" src="/images/products/ipad.png"
                                        alt="ipad image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            Apple iPad Air
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-green-500 dark:text-green-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                                </path>
                                            </svg>
                                            12.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $103,967
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img class="flex-shrink-0 w-10 h-10" src="/images/products/imac.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            Apple iMac 24"
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-red-600 dark:text-red-500">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                                </path>
                                            </svg>
                                            2%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $98,543
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/images/users/neil-sims.png" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        Neil Sims
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $3320
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/images/users/bonnie-green.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        Bonnie Green
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $2467
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/images/users/michael-gough.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        Michael Gough
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $2235
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/images/users/thomas-lean.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        Thomes Lean
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $1842
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="/images/users/lana-byrd.png" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        Lana Byrd
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    $1044
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                <div>
                    <button
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        type="button" data-dropdown-toggle="stats-dropdown">Last 7 days <svg class="w-4 h-4 ml-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="stats-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-blue-700 sm:text-sm hover:bg-gray-100 dark:text-blue-500 dark:hover:bg-gray-700">
                        Full Report
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-4 grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div
            class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">New products</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                    <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                            </path>
                        </svg>
                        12.5%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="new-products-chart" style="min-height: 155px;">
                <div id="apexchartsrqan7nj7" class="apexcharts-canvas apexchartsrqan7nj7 apexcharts-theme-light"
                    style="width: 219px; height: 140px;"><svg id="SvgjsSvg1908" width="219" height="140"
                        xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                        transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG1910" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 30)">
                            <defs id="SvgjsDefs1909">
                                <linearGradient id="SvgjsLinearGradient1914" x1="0" y1="0"
                                    x2="0" y2="1">
                                    <stop id="SvgjsStop1915" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)"
                                        offset="0"></stop>
                                    <stop id="SvgjsStop1916" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                    <stop id="SvgjsStop1917" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                </linearGradient>
                                <clipPath id="gridRectMaskrqan7nj7">
                                    <rect id="SvgjsRect1919" width="206" height="83" x="-4.5" y="-2.5"
                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <clipPath id="forecastMaskrqan7nj7"></clipPath>
                                <clipPath id="nonForecastMaskrqan7nj7"></clipPath>
                                <clipPath id="gridRectMarkerMaskrqan7nj7">
                                    <rect id="SvgjsRect1920" width="201" height="82" x="-2" y="-2" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                            </defs>
                            <rect id="SvgjsRect1918" width="25.328571428571426" height="78" x="0" y="0"
                                rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                fill="url(#SvgjsLinearGradient1914)" class="apexcharts-xcrosshairs" y2="78"
                                filter="none" fill-opacity="0.9"></rect>
                            <g id="SvgjsG1939" class="apexcharts-xaxis" transform="translate(0, 0)">
                                <g id="SvgjsG1940" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g>
                            </g>
                            <g id="SvgjsG1949" class="apexcharts-grid">
                                <g id="SvgjsG1950" class="apexcharts-gridlines-horizontal" style="display: none;">
                                    <line id="SvgjsLine1952" x1="0" y1="0" x2="197"
                                        y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1953" x1="0" y1="19.5" x2="197"
                                        y2="19.5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1954" x1="0" y1="39" x2="197"
                                        y2="39" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1955" x1="0" y1="58.5" x2="197"
                                        y2="58.5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine1956" x1="0" y1="78" x2="197"
                                        y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                </g>
                                <g id="SvgjsG1951" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                <line id="SvgjsLine1958" x1="0" y1="78" x2="197" y2="78"
                                    stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                <line id="SvgjsLine1957" x1="0" y1="1" x2="0" y2="78"
                                    stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                            </g>
                            <g id="SvgjsG1921" class="apexcharts-bar-series apexcharts-plot-series">
                                <g id="SvgjsG1922" class="apexcharts-series" rel="1" seriesName="Quantity"
                                    data:realIndex="0">
                                    <path id="SvgjsPath1926"
                                        d="M 1.4071428571428584 78L 1.4071428571428584 14.700000000000003Q 1.4071428571428584 11.700000000000003 4.407142857142858 11.700000000000003L 18.735714285714284 11.700000000000003Q 21.735714285714284 11.700000000000003 21.735714285714284 14.700000000000003L 21.735714285714284 14.700000000000003L 21.735714285714284 78L 21.735714285714284 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 1.4071428571428584 78L 1.4071428571428584 14.700000000000003Q 1.4071428571428584 11.700000000000003 4.407142857142858 11.700000000000003L 18.735714285714284 11.700000000000003Q 21.735714285714284 11.700000000000003 21.735714285714284 14.700000000000003L 21.735714285714284 14.700000000000003L 21.735714285714284 78L 21.735714285714284 78z"
                                        pathFrom="M 1.4071428571428584 78L 1.4071428571428584 78L 21.735714285714284 78L 21.735714285714284 78L 21.735714285714284 78L 21.735714285714284 78L 21.735714285714284 78L 1.4071428571428584 78"
                                        cy="11.700000000000003" cx="27.05" j="0" val="170" barHeight="66.3"
                                        barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1928"
                                        d="M 29.55 78L 29.55 10.800000000000011Q 29.55 7.800000000000011 32.55 7.800000000000011L 46.878571428571426 7.800000000000011Q 49.878571428571426 7.800000000000011 49.878571428571426 10.800000000000011L 49.878571428571426 10.800000000000011L 49.878571428571426 78L 49.878571428571426 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 29.55 78L 29.55 10.800000000000011Q 29.55 7.800000000000011 32.55 7.800000000000011L 46.878571428571426 7.800000000000011Q 49.878571428571426 7.800000000000011 49.878571428571426 10.800000000000011L 49.878571428571426 10.800000000000011L 49.878571428571426 78L 49.878571428571426 78z"
                                        pathFrom="M 29.55 78L 29.55 78L 49.878571428571426 78L 49.878571428571426 78L 49.878571428571426 78L 49.878571428571426 78L 49.878571428571426 78L 29.55 78"
                                        cy="7.800000000000011" cx="55.19285714285714" j="1" val="180"
                                        barHeight="70.19999999999999" barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1930"
                                        d="M 57.69285714285714 78L 57.69285714285714 17.040000000000006Q 57.69285714285714 14.040000000000006 60.69285714285714 14.040000000000006L 75.02142857142857 14.040000000000006Q 78.02142857142857 14.040000000000006 78.02142857142857 17.040000000000006L 78.02142857142857 17.040000000000006L 78.02142857142857 78L 78.02142857142857 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 57.69285714285714 78L 57.69285714285714 17.040000000000006Q 57.69285714285714 14.040000000000006 60.69285714285714 14.040000000000006L 75.02142857142857 14.040000000000006Q 78.02142857142857 14.040000000000006 78.02142857142857 17.040000000000006L 78.02142857142857 17.040000000000006L 78.02142857142857 78L 78.02142857142857 78z"
                                        pathFrom="M 57.69285714285714 78L 57.69285714285714 78L 78.02142857142857 78L 78.02142857142857 78L 78.02142857142857 78L 78.02142857142857 78L 78.02142857142857 78L 57.69285714285714 78"
                                        cy="14.040000000000006" cx="83.33571428571429" j="2" val="164"
                                        barHeight="63.959999999999994" barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1932"
                                        d="M 85.83571428571429 78L 85.83571428571429 24.450000000000003Q 85.83571428571429 21.450000000000003 88.83571428571429 21.450000000000003L 103.16428571428571 21.450000000000003Q 106.16428571428571 21.450000000000003 106.16428571428571 24.450000000000003L 106.16428571428571 24.450000000000003L 106.16428571428571 78L 106.16428571428571 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 85.83571428571429 78L 85.83571428571429 24.450000000000003Q 85.83571428571429 21.450000000000003 88.83571428571429 21.450000000000003L 103.16428571428571 21.450000000000003Q 106.16428571428571 21.450000000000003 106.16428571428571 24.450000000000003L 106.16428571428571 24.450000000000003L 106.16428571428571 78L 106.16428571428571 78z"
                                        pathFrom="M 85.83571428571429 78L 85.83571428571429 78L 106.16428571428571 78L 106.16428571428571 78L 106.16428571428571 78L 106.16428571428571 78L 106.16428571428571 78L 85.83571428571429 78"
                                        cy="21.450000000000003" cx="111.47857142857143" j="3" val="145"
                                        barHeight="56.55" barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1934"
                                        d="M 113.97857142857143 78L 113.97857142857143 5.340000000000003Q 113.97857142857143 2.3400000000000034 116.97857142857143 2.3400000000000034L 131.30714285714285 2.3400000000000034Q 134.30714285714285 2.3400000000000034 134.30714285714285 5.340000000000003L 134.30714285714285 5.340000000000003L 134.30714285714285 78L 134.30714285714285 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 113.97857142857143 78L 113.97857142857143 5.340000000000003Q 113.97857142857143 2.3400000000000034 116.97857142857143 2.3400000000000034L 131.30714285714285 2.3400000000000034Q 134.30714285714285 2.3400000000000034 134.30714285714285 5.340000000000003L 134.30714285714285 5.340000000000003L 134.30714285714285 78L 134.30714285714285 78z"
                                        pathFrom="M 113.97857142857143 78L 113.97857142857143 78L 134.30714285714285 78L 134.30714285714285 78L 134.30714285714285 78L 134.30714285714285 78L 134.30714285714285 78L 113.97857142857143 78"
                                        cy="2.3400000000000034" cx="139.62142857142857" j="4" val="194"
                                        barHeight="75.66" barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1936"
                                        d="M 142.12142857142857 78L 142.12142857142857 14.700000000000003Q 142.12142857142857 11.700000000000003 145.12142857142857 11.700000000000003L 159.45 11.700000000000003Q 162.45 11.700000000000003 162.45 14.700000000000003L 162.45 14.700000000000003L 162.45 78L 162.45 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 142.12142857142857 78L 142.12142857142857 14.700000000000003Q 142.12142857142857 11.700000000000003 145.12142857142857 11.700000000000003L 159.45 11.700000000000003Q 162.45 11.700000000000003 162.45 14.700000000000003L 162.45 14.700000000000003L 162.45 78L 162.45 78z"
                                        pathFrom="M 142.12142857142857 78L 142.12142857142857 78L 162.45 78L 162.45 78L 162.45 78L 162.45 78L 162.45 78L 142.12142857142857 78"
                                        cy="11.700000000000003" cx="167.7642857142857" j="5" val="170"
                                        barHeight="66.3" barWidth="25.328571428571426"></path>
                                    <path id="SvgjsPath1938"
                                        d="M 170.2642857142857 78L 170.2642857142857 20.550000000000004Q 170.2642857142857 17.550000000000004 173.2642857142857 17.550000000000004L 187.59285714285713 17.550000000000004Q 190.59285714285713 17.550000000000004 190.59285714285713 20.550000000000004L 190.59285714285713 20.550000000000004L 190.59285714285713 78L 190.59285714285713 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskrqan7nj7)"
                                        pathTo="M 170.2642857142857 78L 170.2642857142857 20.550000000000004Q 170.2642857142857 17.550000000000004 173.2642857142857 17.550000000000004L 187.59285714285713 17.550000000000004Q 190.59285714285713 17.550000000000004 190.59285714285713 20.550000000000004L 190.59285714285713 20.550000000000004L 190.59285714285713 78L 190.59285714285713 78z"
                                        pathFrom="M 170.2642857142857 78L 170.2642857142857 78L 190.59285714285713 78L 190.59285714285713 78L 190.59285714285713 78L 190.59285714285713 78L 190.59285714285713 78L 170.2642857142857 78"
                                        cy="17.550000000000004" cx="195.90714285714284" j="6" val="155"
                                        barHeight="60.449999999999996" barWidth="25.328571428571426"></path>
                                    <g id="SvgjsG1924" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                                        <g id="SvgjsG1925" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1927" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1929" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1931" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1933" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1935" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1937" className="apexcharts-bar-goals-groups"></g>
                                    </g>
                                </g>
                                <g id="SvgjsG1923" class="apexcharts-datalabels" data:realIndex="0"></g>
                            </g>
                            <line id="SvgjsLine1959" x1="0" y1="0" x2="197" y2="0"
                                stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine1960" x1="0" y1="0" x2="197" y2="0"
                                stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs-hidden"></line>
                            <g id="SvgjsG1961" class="apexcharts-yaxis-annotations"></g>
                            <g id="SvgjsG1962" class="apexcharts-xaxis-annotations"></g>
                            <g id="SvgjsG1963" class="apexcharts-point-annotations"></g>
                        </g>
                        <g id="SvgjsG1948" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                        <g id="SvgjsG1911" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 70px;"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-light">
                        <div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;">
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span>
                            <div class="apexcharts-tooltip-text" style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                        <div class="apexcharts-yaxistooltip-text"></div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Users</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
                <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                    <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                            </path>
                        </svg>
                        3,4%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="week-signups-chart" style="min-height: 155px;">
                <div id="apexcharts76idw1fu" class="apexcharts-canvas apexcharts76idw1fu apexcharts-theme-light"
                    style="width: 219px; height: 140px;"><svg id="SvgjsSvg1964" width="219" height="140"
                        xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                        transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG1966" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 30)">
                            <defs id="SvgjsDefs1965">
                                <linearGradient id="SvgjsLinearGradient1970" x1="0" y1="0"
                                    x2="0" y2="1">
                                    <stop id="SvgjsStop1971" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)"
                                        offset="0"></stop>
                                    <stop id="SvgjsStop1972" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                    <stop id="SvgjsStop1973" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                </linearGradient>
                                <clipPath id="gridRectMask76idw1fu">
                                    <rect id="SvgjsRect1975" width="201" height="78" x="-2" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <clipPath id="forecastMask76idw1fu"></clipPath>
                                <clipPath id="nonForecastMask76idw1fu"></clipPath>
                                <clipPath id="gridRectMarkerMask76idw1fu">
                                    <rect id="SvgjsRect1976" width="201" height="82" x="-2" y="-2" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                            </defs>
                            <rect id="SvgjsRect1974" width="7.035714285714286" height="78" x="0" y="0" rx="0"
                                ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                fill="url(#SvgjsLinearGradient1970)" class="apexcharts-xcrosshairs" y2="78"
                                filter="none" fill-opacity="0.9"></rect>
                            <g id="SvgjsG2002" class="apexcharts-xaxis" transform="translate(0, 0)">
                                <g id="SvgjsG2003" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g>
                            </g>
                            <g id="SvgjsG2012" class="apexcharts-grid">
                                <g id="SvgjsG2013" class="apexcharts-gridlines-horizontal" style="display: none;">
                                    <line id="SvgjsLine2015" x1="0" y1="0" x2="197"
                                        y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine2016" x1="0" y1="15.6" x2="197"
                                        y2="15.6" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine2017" x1="0" y1="31.2" x2="197"
                                        y2="31.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine2018" x1="0" y1="46.8" x2="197"
                                        y2="46.8" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine2019" x1="0" y1="62.4" x2="197"
                                        y2="62.4" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine2020" x1="0" y1="78" x2="197"
                                        y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                </g>
                                <g id="SvgjsG2014" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                <line id="SvgjsLine2022" x1="0" y1="78" x2="197" y2="78"
                                    stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                <line id="SvgjsLine2021" x1="0" y1="1" x2="0" y2="78"
                                    stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                            </g>
                            <g id="SvgjsG1977" class="apexcharts-bar-series apexcharts-plot-series">
                                <g id="SvgjsG1978" class="apexcharts-series" rel="1" seriesName="Users"
                                    data:realIndex="0">
                                    <rect id="SvgjsRect1981" width="7.035714285714286" height="78"
                                        x="10.553571428571429" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1983"
                                        d="M 10.553571428571429 78L 10.553571428571429 46.315999999999995Q 10.553571428571429 43.315999999999995 13.553571428571429 43.315999999999995L 14.589285714285715 43.315999999999995Q 17.589285714285715 43.315999999999995 17.589285714285715 46.315999999999995L 17.589285714285715 46.315999999999995L 17.589285714285715 78L 17.589285714285715 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 10.553571428571429 78L 10.553571428571429 46.315999999999995Q 10.553571428571429 43.315999999999995 13.553571428571429 43.315999999999995L 14.589285714285715 43.315999999999995Q 17.589285714285715 43.315999999999995 17.589285714285715 46.315999999999995L 17.589285714285715 46.315999999999995L 17.589285714285715 78L 17.589285714285715 78z"
                                        pathFrom="M 10.553571428571429 78L 10.553571428571429 78L 17.589285714285715 78L 17.589285714285715 78L 17.589285714285715 78L 17.589285714285715 78L 17.589285714285715 78L 10.553571428571429 78"
                                        cy="43.315999999999995" cx="38.69642857142857" j="0" val="1334"
                                        barHeight="34.684000000000005" barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1984" width="7.035714285714286" height="78"
                                        x="38.69642857142857" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1986"
                                        d="M 38.69642857142857 78L 38.69642857142857 17.689999999999998Q 38.69642857142857 14.689999999999998 41.69642857142857 14.689999999999998L 42.732142857142854 14.689999999999998Q 45.732142857142854 14.689999999999998 45.732142857142854 17.689999999999998L 45.732142857142854 17.689999999999998L 45.732142857142854 78L 45.732142857142854 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 38.69642857142857 78L 38.69642857142857 17.689999999999998Q 38.69642857142857 14.689999999999998 41.69642857142857 14.689999999999998L 42.732142857142854 14.689999999999998Q 45.732142857142854 14.689999999999998 45.732142857142854 17.689999999999998L 45.732142857142854 17.689999999999998L 45.732142857142854 78L 45.732142857142854 78z"
                                        pathFrom="M 38.69642857142857 78L 38.69642857142857 78L 45.732142857142854 78L 45.732142857142854 78L 45.732142857142854 78L 45.732142857142854 78L 45.732142857142854 78L 38.69642857142857 78"
                                        cy="14.689999999999998" cx="66.83928571428571" j="1" val="2435"
                                        barHeight="63.31" barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1987" width="7.035714285714286" height="78"
                                        x="66.83928571428571" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1989"
                                        d="M 66.83928571428571 78L 66.83928571428571 35.422Q 66.83928571428571 32.422 69.83928571428571 32.422L 70.875 32.422Q 73.875 32.422 73.875 35.422L 73.875 35.422L 73.875 78L 73.875 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 66.83928571428571 78L 66.83928571428571 35.422Q 66.83928571428571 32.422 69.83928571428571 32.422L 70.875 32.422Q 73.875 32.422 73.875 35.422L 73.875 35.422L 73.875 78L 73.875 78z"
                                        pathFrom="M 66.83928571428571 78L 66.83928571428571 78L 73.875 78L 73.875 78L 73.875 78L 73.875 78L 73.875 78L 66.83928571428571 78"
                                        cy="32.422" cx="94.98214285714285" j="2" val="1753" barHeight="45.578"
                                        barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1990" width="7.035714285714286" height="78"
                                        x="94.98214285714285" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1992"
                                        d="M 94.98214285714285 78L 94.98214285714285 46.472Q 94.98214285714285 43.472 97.98214285714285 43.472L 99.01785714285714 43.472Q 102.01785714285714 43.472 102.01785714285714 46.472L 102.01785714285714 46.472L 102.01785714285714 78L 102.01785714285714 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 94.98214285714285 78L 94.98214285714285 46.472Q 94.98214285714285 43.472 97.98214285714285 43.472L 99.01785714285714 43.472Q 102.01785714285714 43.472 102.01785714285714 46.472L 102.01785714285714 46.472L 102.01785714285714 78L 102.01785714285714 78z"
                                        pathFrom="M 94.98214285714285 78L 94.98214285714285 78L 102.01785714285714 78L 102.01785714285714 78L 102.01785714285714 78L 102.01785714285714 78L 102.01785714285714 78L 94.98214285714285 78"
                                        cy="43.472" cx="123.12499999999999" j="3" val="1328" barHeight="34.528"
                                        barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1993" width="7.035714285714286" height="78"
                                        x="123.12499999999999" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1995"
                                        d="M 123.12499999999999 78L 123.12499999999999 50.97Q 123.12499999999999 47.97 126.12499999999999 47.97L 127.16071428571428 47.97Q 130.16071428571428 47.97 130.16071428571428 50.97L 130.16071428571428 50.97L 130.16071428571428 78L 130.16071428571428 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 123.12499999999999 78L 123.12499999999999 50.97Q 123.12499999999999 47.97 126.12499999999999 47.97L 127.16071428571428 47.97Q 130.16071428571428 47.97 130.16071428571428 50.97L 130.16071428571428 50.97L 130.16071428571428 78L 130.16071428571428 78z"
                                        pathFrom="M 123.12499999999999 78L 123.12499999999999 78L 130.16071428571428 78L 130.16071428571428 78L 130.16071428571428 78L 130.16071428571428 78L 130.16071428571428 78L 123.12499999999999 78"
                                        cy="47.97" cx="151.26785714285714" j="4" val="1155"
                                        barHeight="30.03" barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1996" width="7.035714285714286" height="78"
                                        x="151.26785714285714" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath1998"
                                        d="M 151.26785714285714 78L 151.26785714285714 38.568Q 151.26785714285714 35.568 154.26785714285714 35.568L 155.30357142857142 35.568Q 158.30357142857142 35.568 158.30357142857142 38.568L 158.30357142857142 38.568L 158.30357142857142 78L 158.30357142857142 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 151.26785714285714 78L 151.26785714285714 38.568Q 151.26785714285714 35.568 154.26785714285714 35.568L 155.30357142857142 35.568Q 158.30357142857142 35.568 158.30357142857142 38.568L 158.30357142857142 38.568L 158.30357142857142 78L 158.30357142857142 78z"
                                        pathFrom="M 151.26785714285714 78L 151.26785714285714 78L 158.30357142857142 78L 158.30357142857142 78L 158.30357142857142 78L 158.30357142857142 78L 158.30357142857142 78L 151.26785714285714 78"
                                        cy="35.568" cx="179.41071428571428" j="5" val="1632"
                                        barHeight="42.432" barWidth="7.035714285714286"></path>
                                    <rect id="SvgjsRect1999" width="7.035714285714286" height="78"
                                        x="179.41071428571428" y="0" rx="3" ry="3" opacity="1"
                                        stroke-width="0" stroke="none" stroke-dasharray="0" fill="#374151"
                                        class="apexcharts-backgroundBar"></rect>
                                    <path id="SvgjsPath2001"
                                        d="M 179.41071428571428 78L 179.41071428571428 46.263999999999996Q 179.41071428571428 43.263999999999996 182.41071428571428 43.263999999999996L 183.44642857142856 43.263999999999996Q 186.44642857142856 43.263999999999996 186.44642857142856 46.263999999999996L 186.44642857142856 46.263999999999996L 186.44642857142856 78L 186.44642857142856 78z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                        class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMask76idw1fu)"
                                        pathTo="M 179.41071428571428 78L 179.41071428571428 46.263999999999996Q 179.41071428571428 43.263999999999996 182.41071428571428 43.263999999999996L 183.44642857142856 43.263999999999996Q 186.44642857142856 43.263999999999996 186.44642857142856 46.263999999999996L 186.44642857142856 46.263999999999996L 186.44642857142856 78L 186.44642857142856 78z"
                                        pathFrom="M 179.41071428571428 78L 179.41071428571428 78L 186.44642857142856 78L 186.44642857142856 78L 186.44642857142856 78L 186.44642857142856 78L 186.44642857142856 78L 179.41071428571428 78"
                                        cy="43.263999999999996" cx="207.55357142857142" j="6" val="1336"
                                        barHeight="34.736000000000004" barWidth="7.035714285714286"></path>
                                    <g id="SvgjsG1980" class="apexcharts-bar-goals-markers"
                                        style="pointer-events: none">
                                        <g id="SvgjsG1982" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1985" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1988" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1991" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1994" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG1997" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG2000" className="apexcharts-bar-goals-groups"></g>
                                    </g>
                                </g>
                                <g id="SvgjsG1979" class="apexcharts-datalabels" data:realIndex="0"></g>
                            </g>
                            <line id="SvgjsLine2023" x1="0" y1="0" x2="197" y2="0"
                                stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine2024" x1="0" y1="0" x2="197" y2="0"
                                stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs-hidden"></line>
                            <g id="SvgjsG2025" class="apexcharts-yaxis-annotations"></g>
                            <g id="SvgjsG2026" class="apexcharts-xaxis-annotations"></g>
                            <g id="SvgjsG2027" class="apexcharts-point-annotations"></g>
                        </g>
                        <g id="SvgjsG2011" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)">
                        </g>
                        <g id="SvgjsG1967" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 70px;"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-light">
                        <div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;">
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                        <div class="apexcharts-yaxistooltip-text"></div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
                <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Audience by age</h3>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium dark:text-white">50+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full dark:bg-blue-500" style="width: 18%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium dark:text-white">40+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full dark:bg-blue-500" style="width: 15%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium dark:text-white">30+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full dark:bg-blue-500" style="width: 60%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium dark:text-white">20+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full dark:bg-blue-500" style="width: 30%"></div>
                    </div>
                </div>
            </div>
            <div id="traffic-channels-chart" class="w-full"></div>
        </div>
    </div>
    <div class="md:col-span-2 col-span-4">
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center justify-between pb-4 border-b border-gray-200 sm:flex dark:border-gray-700">
                <div class="w-full mb-4 sm:mb-0">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Sales by category</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Desktop
                        PC</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                </path>
                            </svg>
                            2.5%
                        </span>
                        Since last month
                    </p>
                </div>
                <div class="w-full max-w-lg">
                    <div date-rangepicker="" class="grid items-center grid-cols-2 gap-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z">
                                    </path>
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z">
                                    </path>
                                </svg>
                            </div>
                            <input name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 datepicker-input"
                                placeholder="From">
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z">
                                    </path>
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z">
                                    </path>
                                </svg>
                            </div>
                            <input name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 datepicker-input"
                                placeholder="To">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full" id="sales-by-category" style="min-height: 435px;">
                <div id="apexchartsrfitmes6" class="apexcharts-canvas apexchartsrfitmes6 apexcharts-theme-light"
                    style="width: 543px; height: 420px;"><svg id="SvgjsSvg3180" width="543" height="420"
                        xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                        transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG3182" class="apexcharts-inner apexcharts-graphical"
                            transform="translate(12, 30)">
                            <defs id="SvgjsDefs3181">
                                <linearGradient id="SvgjsLinearGradient3185" x1="0" y1="0"
                                    x2="0" y2="1">
                                    <stop id="SvgjsStop3186" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)"
                                        offset="0"></stop>
                                    <stop id="SvgjsStop3187" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                    <stop id="SvgjsStop3188" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                                        offset="1"></stop>
                                </linearGradient>
                                <clipPath id="gridRectMaskrfitmes6">
                                    <rect id="SvgjsRect3190" width="530" height="380" x="-4.5" y="-2.5"
                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <clipPath id="forecastMaskrfitmes6"></clipPath>
                                <clipPath id="nonForecastMaskrfitmes6"></clipPath>
                                <clipPath id="gridRectMarkerMaskrfitmes6">
                                    <rect id="SvgjsRect3191" width="525" height="379" x="-2" y="-2"
                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                            </defs>
                            <rect id="SvgjsRect3189" width="74.42857142857143" height="375" x="0" y="0"
                                rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                fill="url(#SvgjsLinearGradient3185)" class="apexcharts-xcrosshairs" y2="375"
                                filter="none" fill-opacity="0.9"></rect>
                            <g id="SvgjsG3244" class="apexcharts-xaxis" transform="translate(0, 0)">
                                <g id="SvgjsG3245" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                            </g>
                            <g id="SvgjsG3254" class="apexcharts-grid">
                                <g id="SvgjsG3255" class="apexcharts-gridlines-horizontal" style="display: none;">
                                    <line id="SvgjsLine3257" x1="0" y1="0" x2="521"
                                        y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine3258" x1="0" y1="75" x2="521"
                                        y2="75" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine3259" x1="0" y1="150" x2="521"
                                        y2="150" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine3260" x1="0" y1="225" x2="521"
                                        y2="225" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine3261" x1="0" y1="300" x2="521"
                                        y2="300" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                    <line id="SvgjsLine3262" x1="0" y1="375" x2="521"
                                        y2="375" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt"
                                        class="apexcharts-gridline"></line>
                                </g>
                                <g id="SvgjsG3256" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                <line id="SvgjsLine3264" x1="0" y1="375" x2="521"
                                    y2="375" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt">
                                </line>
                                <line id="SvgjsLine3263" x1="0" y1="1" x2="0"
                                    y2="375" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt">
                                </line>
                            </g>
                            <g id="SvgjsG3192" class="apexcharts-bar-series apexcharts-plot-series">
                                <g id="SvgjsG3193" class="apexcharts-series" rel="1" seriesName="DesktopxPC"
                                    data:realIndex="0">
                                    <path id="SvgjsPath3197"
                                        d="M 3.721428571428568 375L 3.721428571428568 195.85714285714286Q 3.721428571428568 192.85714285714286 6.721428571428568 192.85714285714286L 18.05 192.85714285714286Q 21.05 192.85714285714286 21.05 195.85714285714286L 21.05 195.85714285714286L 21.05 375L 21.05 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 3.721428571428568 375L 3.721428571428568 195.85714285714286Q 3.721428571428568 192.85714285714286 6.721428571428568 192.85714285714286L 18.05 192.85714285714286Q 21.05 192.85714285714286 21.05 195.85714285714286L 21.05 195.85714285714286L 21.05 375L 21.05 375z"
                                        pathFrom="M 3.721428571428568 375L 3.721428571428568 375L 21.05 375L 21.05 375L 21.05 375L 21.05 375L 21.05 375L 3.721428571428568 375"
                                        cy="192.85714285714286" cx="75.65" j="0" val="170"
                                        barHeight="182.14285714285714" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3199"
                                        d="M 78.15 375L 78.15 185.14285714285714Q 78.15 182.14285714285714 81.15 182.14285714285714L 92.47857142857144 182.14285714285714Q 95.47857142857144 182.14285714285714 95.47857142857144 185.14285714285714L 95.47857142857144 185.14285714285714L 95.47857142857144 375L 95.47857142857144 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 78.15 375L 78.15 185.14285714285714Q 78.15 182.14285714285714 81.15 182.14285714285714L 92.47857142857144 182.14285714285714Q 95.47857142857144 182.14285714285714 95.47857142857144 185.14285714285714L 95.47857142857144 185.14285714285714L 95.47857142857144 375L 95.47857142857144 375z"
                                        pathFrom="M 78.15 375L 78.15 375L 95.47857142857144 375L 95.47857142857144 375L 95.47857142857144 375L 95.47857142857144 375L 95.47857142857144 375L 78.15 375"
                                        cy="182.14285714285714" cx="150.07857142857142" j="1" val="180"
                                        barHeight="192.85714285714286" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3201"
                                        d="M 152.57857142857142 375L 152.57857142857142 202.28571428571428Q 152.57857142857142 199.28571428571428 155.57857142857142 199.28571428571428L 166.90714285714284 199.28571428571428Q 169.90714285714284 199.28571428571428 169.90714285714284 202.28571428571428L 169.90714285714284 202.28571428571428L 169.90714285714284 375L 169.90714285714284 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 152.57857142857142 375L 152.57857142857142 202.28571428571428Q 152.57857142857142 199.28571428571428 155.57857142857142 199.28571428571428L 166.90714285714284 199.28571428571428Q 169.90714285714284 199.28571428571428 169.90714285714284 202.28571428571428L 169.90714285714284 202.28571428571428L 169.90714285714284 375L 169.90714285714284 375z"
                                        pathFrom="M 152.57857142857142 375L 152.57857142857142 375L 169.90714285714284 375L 169.90714285714284 375L 169.90714285714284 375L 169.90714285714284 375L 169.90714285714284 375L 152.57857142857142 375"
                                        cy="199.28571428571428" cx="224.50714285714287" j="2" val="164"
                                        barHeight="175.71428571428572" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3203"
                                        d="M 227.00714285714287 375L 227.00714285714287 222.64285714285714Q 227.00714285714287 219.64285714285714 230.00714285714287 219.64285714285714L 241.3357142857143 219.64285714285714Q 244.3357142857143 219.64285714285714 244.3357142857143 222.64285714285714L 244.3357142857143 222.64285714285714L 244.3357142857143 375L 244.3357142857143 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 227.00714285714287 375L 227.00714285714287 222.64285714285714Q 227.00714285714287 219.64285714285714 230.00714285714287 219.64285714285714L 241.3357142857143 219.64285714285714Q 244.3357142857143 219.64285714285714 244.3357142857143 222.64285714285714L 244.3357142857143 222.64285714285714L 244.3357142857143 375L 244.3357142857143 375z"
                                        pathFrom="M 227.00714285714287 375L 227.00714285714287 375L 244.3357142857143 375L 244.3357142857143 375L 244.3357142857143 375L 244.3357142857143 375L 244.3357142857143 375L 227.00714285714287 375"
                                        cy="219.64285714285714" cx="298.9357142857143" j="3" val="145"
                                        barHeight="155.35714285714286" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3205"
                                        d="M 301.4357142857143 375L 301.4357142857143 170.14285714285714Q 301.4357142857143 167.14285714285714 304.4357142857143 167.14285714285714L 315.76428571428573 167.14285714285714Q 318.76428571428573 167.14285714285714 318.76428571428573 170.14285714285714L 318.76428571428573 170.14285714285714L 318.76428571428573 375L 318.76428571428573 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 301.4357142857143 375L 301.4357142857143 170.14285714285714Q 301.4357142857143 167.14285714285714 304.4357142857143 167.14285714285714L 315.76428571428573 167.14285714285714Q 318.76428571428573 167.14285714285714 318.76428571428573 170.14285714285714L 318.76428571428573 170.14285714285714L 318.76428571428573 375L 318.76428571428573 375z"
                                        pathFrom="M 301.4357142857143 375L 301.4357142857143 375L 318.76428571428573 375L 318.76428571428573 375L 318.76428571428573 375L 318.76428571428573 375L 318.76428571428573 375L 301.4357142857143 375"
                                        cy="167.14285714285714" cx="373.36428571428576" j="4" val="194"
                                        barHeight="207.85714285714286" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3207"
                                        d="M 375.86428571428576 375L 375.86428571428576 195.85714285714286Q 375.86428571428576 192.85714285714286 378.86428571428576 192.85714285714286L 390.1928571428572 192.85714285714286Q 393.1928571428572 192.85714285714286 393.1928571428572 195.85714285714286L 393.1928571428572 195.85714285714286L 393.1928571428572 375L 393.1928571428572 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 375.86428571428576 375L 375.86428571428576 195.85714285714286Q 375.86428571428576 192.85714285714286 378.86428571428576 192.85714285714286L 390.1928571428572 192.85714285714286Q 393.1928571428572 192.85714285714286 393.1928571428572 195.85714285714286L 393.1928571428572 195.85714285714286L 393.1928571428572 375L 393.1928571428572 375z"
                                        pathFrom="M 375.86428571428576 375L 375.86428571428576 375L 393.1928571428572 375L 393.1928571428572 375L 393.1928571428572 375L 393.1928571428572 375L 393.1928571428572 375L 375.86428571428576 375"
                                        cy="192.85714285714286" cx="447.7928571428572" j="5" val="170"
                                        barHeight="182.14285714285714" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3209"
                                        d="M 450.2928571428572 375L 450.2928571428572 211.92857142857144Q 450.2928571428572 208.92857142857144 453.2928571428572 208.92857142857144L 464.6214285714286 208.92857142857144Q 467.6214285714286 208.92857142857144 467.6214285714286 211.92857142857144L 467.6214285714286 211.92857142857144L 467.6214285714286 375L 467.6214285714286 375z"
                                        fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 450.2928571428572 375L 450.2928571428572 211.92857142857144Q 450.2928571428572 208.92857142857144 453.2928571428572 208.92857142857144L 464.6214285714286 208.92857142857144Q 467.6214285714286 208.92857142857144 467.6214285714286 211.92857142857144L 467.6214285714286 211.92857142857144L 467.6214285714286 375L 467.6214285714286 375z"
                                        pathFrom="M 450.2928571428572 375L 450.2928571428572 375L 467.6214285714286 375L 467.6214285714286 375L 467.6214285714286 375L 467.6214285714286 375L 467.6214285714286 375L 450.2928571428572 375"
                                        cy="208.92857142857144" cx="522.2214285714286" j="6" val="155"
                                        barHeight="166.07142857142856" barWidth="22.328571428571433"></path>
                                    <g id="SvgjsG3195" class="apexcharts-bar-goals-markers"
                                        style="pointer-events: none">
                                        <g id="SvgjsG3196" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3198" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3200" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3202" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3204" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3206" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3208" className="apexcharts-bar-goals-groups"></g>
                                    </g>
                                </g>
                                <g id="SvgjsG3210" class="apexcharts-series" rel="2" seriesName="Phones"
                                    data:realIndex="1">
                                    <path id="SvgjsPath3214"
                                        d="M 26.05 375L 26.05 249.42857142857144Q 26.05 246.42857142857144 29.05 246.42857142857144L 40.37857142857143 246.42857142857144Q 43.37857142857143 246.42857142857144 43.37857142857143 249.42857142857144L 43.37857142857143 249.42857142857144L 43.37857142857143 375L 43.37857142857143 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 26.05 375L 26.05 249.42857142857144Q 26.05 246.42857142857144 29.05 246.42857142857144L 40.37857142857143 246.42857142857144Q 43.37857142857143 246.42857142857144 43.37857142857143 249.42857142857144L 43.37857142857143 249.42857142857144L 43.37857142857143 375L 43.37857142857143 375z"
                                        pathFrom="M 26.05 375L 26.05 375L 43.37857142857143 375L 43.37857142857143 375L 43.37857142857143 375L 43.37857142857143 375L 43.37857142857143 375L 26.05 375"
                                        cy="246.42857142857144" cx="97.97857142857144" j="0" val="120"
                                        barHeight="128.57142857142856" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3216"
                                        d="M 100.47857142857144 375L 100.47857142857144 63Q 100.47857142857144 60 103.47857142857144 60L 114.80714285714288 60Q 117.80714285714288 60 117.80714285714288 63L 117.80714285714288 63L 117.80714285714288 375L 117.80714285714288 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 100.47857142857144 375L 100.47857142857144 63Q 100.47857142857144 60 103.47857142857144 60L 114.80714285714288 60Q 117.80714285714288 60 117.80714285714288 63L 117.80714285714288 63L 117.80714285714288 375L 117.80714285714288 375z"
                                        pathFrom="M 100.47857142857144 375L 100.47857142857144 375L 117.80714285714288 375L 117.80714285714288 375L 117.80714285714288 375L 117.80714285714288 375L 117.80714285714288 375L 100.47857142857144 375"
                                        cy="60" cx="172.40714285714284" j="1" val="294" barHeight="315"
                                        barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3218"
                                        d="M 174.90714285714284 375L 174.90714285714284 199.07142857142858Q 174.90714285714284 196.07142857142858 177.90714285714284 196.07142857142858L 189.23571428571427 196.07142857142858Q 192.23571428571427 196.07142857142858 192.23571428571427 199.07142857142858L 192.23571428571427 199.07142857142858L 192.23571428571427 375L 192.23571428571427 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 174.90714285714284 375L 174.90714285714284 199.07142857142858Q 174.90714285714284 196.07142857142858 177.90714285714284 196.07142857142858L 189.23571428571427 196.07142857142858Q 192.23571428571427 196.07142857142858 192.23571428571427 199.07142857142858L 192.23571428571427 199.07142857142858L 192.23571428571427 375L 192.23571428571427 375z"
                                        pathFrom="M 174.90714285714284 375L 174.90714285714284 375L 192.23571428571427 375L 192.23571428571427 375L 192.23571428571427 375L 192.23571428571427 375L 192.23571428571427 375L 174.90714285714284 375"
                                        cy="196.07142857142858" cx="246.8357142857143" j="2" val="167"
                                        barHeight="178.92857142857142" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3220"
                                        d="M 249.3357142857143 375L 249.3357142857143 186.21428571428572Q 249.3357142857143 183.21428571428572 252.3357142857143 183.21428571428572L 263.6642857142857 183.21428571428572Q 266.6642857142857 183.21428571428572 266.6642857142857 186.21428571428572L 266.6642857142857 186.21428571428572L 266.6642857142857 375L 266.6642857142857 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 249.3357142857143 375L 249.3357142857143 186.21428571428572Q 249.3357142857143 183.21428571428572 252.3357142857143 183.21428571428572L 263.6642857142857 183.21428571428572Q 266.6642857142857 183.21428571428572 266.6642857142857 186.21428571428572L 266.6642857142857 186.21428571428572L 266.6642857142857 375L 266.6642857142857 375z"
                                        pathFrom="M 249.3357142857143 375L 249.3357142857143 375L 266.6642857142857 375L 266.6642857142857 375L 266.6642857142857 375L 266.6642857142857 375L 266.6642857142857 375L 249.3357142857143 375"
                                        cy="183.21428571428572" cx="321.26428571428573" j="3" val="179"
                                        barHeight="191.78571428571428" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3222"
                                        d="M 323.76428571428573 375L 323.76428571428573 115.5Q 323.76428571428573 112.5 326.76428571428573 112.5L 338.09285714285716 112.5Q 341.09285714285716 112.5 341.09285714285716 115.5L 341.09285714285716 115.5L 341.09285714285716 375L 341.09285714285716 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 323.76428571428573 375L 323.76428571428573 115.5Q 323.76428571428573 112.5 326.76428571428573 112.5L 338.09285714285716 112.5Q 341.09285714285716 112.5 341.09285714285716 115.5L 341.09285714285716 115.5L 341.09285714285716 375L 341.09285714285716 375z"
                                        pathFrom="M 323.76428571428573 375L 323.76428571428573 375L 341.09285714285716 375L 341.09285714285716 375L 341.09285714285716 375L 341.09285714285716 375L 341.09285714285716 375L 323.76428571428573 375"
                                        cy="112.5" cx="395.6928571428572" j="4" val="245" barHeight="262.5"
                                        barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3224"
                                        d="M 398.1928571428572 375L 398.1928571428572 183Q 398.1928571428572 180 401.1928571428572 180L 412.5214285714286 180Q 415.5214285714286 180 415.5214285714286 183L 415.5214285714286 183L 415.5214285714286 375L 415.5214285714286 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 398.1928571428572 375L 398.1928571428572 183Q 398.1928571428572 180 401.1928571428572 180L 412.5214285714286 180Q 415.5214285714286 180 415.5214285714286 183L 415.5214285714286 183L 415.5214285714286 375L 415.5214285714286 375z"
                                        pathFrom="M 398.1928571428572 375L 398.1928571428572 375L 415.5214285714286 375L 415.5214285714286 375L 415.5214285714286 375L 415.5214285714286 375L 415.5214285714286 375L 398.1928571428572 375"
                                        cy="180" cx="470.1214285714286" j="5" val="182" barHeight="195"
                                        barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3226"
                                        d="M 472.6214285714286 375L 472.6214285714286 224.78571428571428Q 472.6214285714286 221.78571428571428 475.6214285714286 221.78571428571428L 486.95000000000005 221.78571428571428Q 489.95000000000005 221.78571428571428 489.95000000000005 224.78571428571428L 489.95000000000005 224.78571428571428L 489.95000000000005 375L 489.95000000000005 375z"
                                        fill="rgba(253,186,140,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 472.6214285714286 375L 472.6214285714286 224.78571428571428Q 472.6214285714286 221.78571428571428 475.6214285714286 221.78571428571428L 486.95000000000005 221.78571428571428Q 489.95000000000005 221.78571428571428 489.95000000000005 224.78571428571428L 489.95000000000005 224.78571428571428L 489.95000000000005 375L 489.95000000000005 375z"
                                        pathFrom="M 472.6214285714286 375L 472.6214285714286 375L 489.95000000000005 375L 489.95000000000005 375L 489.95000000000005 375L 489.95000000000005 375L 489.95000000000005 375L 472.6214285714286 375"
                                        cy="221.78571428571428" cx="544.5500000000001" j="6" val="143"
                                        barHeight="153.21428571428572" barWidth="22.328571428571433"></path>
                                    <g id="SvgjsG3212" class="apexcharts-bar-goals-markers"
                                        style="pointer-events: none">
                                        <g id="SvgjsG3213" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3215" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3217" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3219" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3221" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3223" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3225" className="apexcharts-bar-goals-groups"></g>
                                    </g>
                                </g>
                                <g id="SvgjsG3227" class="apexcharts-series" rel="3"
                                    seriesName="GamingxConsole" data:realIndex="2">
                                    <path id="SvgjsPath3231"
                                        d="M 48.37857142857143 375L 48.37857142857143 142.28571428571428Q 48.37857142857143 139.28571428571428 51.37857142857143 139.28571428571428L 62.70714285714287 139.28571428571428Q 65.70714285714287 139.28571428571428 65.70714285714287 142.28571428571428L 65.70714285714287 142.28571428571428L 65.70714285714287 375L 65.70714285714287 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 48.37857142857143 375L 48.37857142857143 142.28571428571428Q 48.37857142857143 139.28571428571428 51.37857142857143 139.28571428571428L 62.70714285714287 139.28571428571428Q 65.70714285714287 139.28571428571428 65.70714285714287 142.28571428571428L 65.70714285714287 142.28571428571428L 65.70714285714287 375L 65.70714285714287 375z"
                                        pathFrom="M 48.37857142857143 375L 48.37857142857143 375L 65.70714285714287 375L 65.70714285714287 375L 65.70714285714287 375L 65.70714285714287 375L 65.70714285714287 375L 48.37857142857143 375"
                                        cy="139.28571428571428" cx="120.30714285714288" j="0" val="220"
                                        barHeight="235.71428571428572" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3233"
                                        d="M 122.80714285714288 375L 122.80714285714288 170.14285714285714Q 122.80714285714288 167.14285714285714 125.80714285714288 167.14285714285714L 137.1357142857143 167.14285714285714Q 140.1357142857143 167.14285714285714 140.1357142857143 170.14285714285714L 140.1357142857143 170.14285714285714L 140.1357142857143 375L 140.1357142857143 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 122.80714285714288 375L 122.80714285714288 170.14285714285714Q 122.80714285714288 167.14285714285714 125.80714285714288 167.14285714285714L 137.1357142857143 167.14285714285714Q 140.1357142857143 167.14285714285714 140.1357142857143 170.14285714285714L 140.1357142857143 170.14285714285714L 140.1357142857143 375L 140.1357142857143 375z"
                                        pathFrom="M 122.80714285714288 375L 122.80714285714288 375L 140.1357142857143 375L 140.1357142857143 375L 140.1357142857143 375L 140.1357142857143 375L 140.1357142857143 375L 122.80714285714288 375"
                                        cy="167.14285714285714" cx="194.7357142857143" j="1" val="194"
                                        barHeight="207.85714285714286" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3235"
                                        d="M 197.2357142857143 375L 197.2357142857143 145.5Q 197.2357142857143 142.5 200.2357142857143 142.5L 211.56428571428572 142.5Q 214.56428571428572 142.5 214.56428571428572 145.5L 214.56428571428572 145.5L 214.56428571428572 375L 214.56428571428572 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 197.2357142857143 375L 197.2357142857143 145.5Q 197.2357142857143 142.5 200.2357142857143 142.5L 211.56428571428572 142.5Q 214.56428571428572 142.5 214.56428571428572 145.5L 214.56428571428572 145.5L 214.56428571428572 375L 214.56428571428572 375z"
                                        pathFrom="M 197.2357142857143 375L 197.2357142857143 375L 214.56428571428572 375L 214.56428571428572 375L 214.56428571428572 375L 214.56428571428572 375L 214.56428571428572 375L 197.2357142857143 375"
                                        cy="142.5" cx="269.1642857142857" j="2" val="217" barHeight="232.5"
                                        barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3237"
                                        d="M 271.6642857142857 375L 271.6642857142857 79.07142857142856Q 271.6642857142857 76.07142857142856 274.6642857142857 76.07142857142856L 285.99285714285713 76.07142857142856Q 288.99285714285713 76.07142857142856 288.99285714285713 79.07142857142856L 288.99285714285713 79.07142857142856L 288.99285714285713 375L 288.99285714285713 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 271.6642857142857 375L 271.6642857142857 79.07142857142856Q 271.6642857142857 76.07142857142856 274.6642857142857 76.07142857142856L 285.99285714285713 76.07142857142856Q 288.99285714285713 76.07142857142856 288.99285714285713 79.07142857142856L 288.99285714285713 79.07142857142856L 288.99285714285713 375L 288.99285714285713 375z"
                                        pathFrom="M 271.6642857142857 375L 271.6642857142857 375L 288.99285714285713 375L 288.99285714285713 375L 288.99285714285713 375L 288.99285714285713 375L 288.99285714285713 375L 271.6642857142857 375"
                                        cy="76.07142857142856" cx="343.59285714285716" j="3" val="279"
                                        barHeight="298.92857142857144" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3239"
                                        d="M 346.09285714285716 375L 346.09285714285716 147.64285714285714Q 346.09285714285716 144.64285714285714 349.09285714285716 144.64285714285714L 360.4214285714286 144.64285714285714Q 363.4214285714286 144.64285714285714 363.4214285714286 147.64285714285714L 363.4214285714286 147.64285714285714L 363.4214285714286 375L 363.4214285714286 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 346.09285714285716 375L 346.09285714285716 147.64285714285714Q 346.09285714285716 144.64285714285714 349.09285714285716 144.64285714285714L 360.4214285714286 144.64285714285714Q 363.4214285714286 144.64285714285714 363.4214285714286 147.64285714285714L 363.4214285714286 147.64285714285714L 363.4214285714286 375L 363.4214285714286 375z"
                                        pathFrom="M 346.09285714285716 375L 346.09285714285716 375L 363.4214285714286 375L 363.4214285714286 375L 363.4214285714286 375L 363.4214285714286 375L 363.4214285714286 375L 346.09285714285716 375"
                                        cy="144.64285714285714" cx="418.0214285714286" j="4" val="215"
                                        barHeight="230.35714285714286" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3241"
                                        d="M 420.5214285714286 375L 420.5214285714286 96.21428571428572Q 420.5214285714286 93.21428571428572 423.5214285714286 93.21428571428572L 434.85 93.21428571428572Q 437.85 93.21428571428572 437.85 96.21428571428572L 437.85 96.21428571428572L 437.85 375L 437.85 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 420.5214285714286 375L 420.5214285714286 96.21428571428572Q 420.5214285714286 93.21428571428572 423.5214285714286 93.21428571428572L 434.85 93.21428571428572Q 437.85 93.21428571428572 437.85 96.21428571428572L 437.85 96.21428571428572L 437.85 375L 437.85 375z"
                                        pathFrom="M 420.5214285714286 375L 420.5214285714286 375L 437.85 375L 437.85 375L 437.85 375L 437.85 375L 437.85 375L 420.5214285714286 375"
                                        cy="93.21428571428572" cx="492.45000000000005" j="5" val="263"
                                        barHeight="281.7857142857143" barWidth="22.328571428571433"></path>
                                    <path id="SvgjsPath3243"
                                        d="M 494.95000000000005 375L 494.95000000000005 181.92857142857144Q 494.95000000000005 178.92857142857144 497.95000000000005 178.92857142857144L 509.27857142857147 178.92857142857144Q 512.2785714285715 178.92857142857144 512.2785714285715 181.92857142857144L 512.2785714285715 181.92857142857144L 512.2785714285715 375L 512.2785714285715 375z"
                                        fill="rgba(23,176,189,1)" fill-opacity="1" stroke="transparent"
                                        stroke-opacity="1" stroke-linecap="round" stroke-width="5"
                                        stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                        clip-path="url(#gridRectMaskrfitmes6)"
                                        pathTo="M 494.95000000000005 375L 494.95000000000005 181.92857142857144Q 494.95000000000005 178.92857142857144 497.95000000000005 178.92857142857144L 509.27857142857147 178.92857142857144Q 512.2785714285715 178.92857142857144 512.2785714285715 181.92857142857144L 512.2785714285715 181.92857142857144L 512.2785714285715 375L 512.2785714285715 375z"
                                        pathFrom="M 494.95000000000005 375L 494.95000000000005 375L 512.2785714285715 375L 512.2785714285715 375L 512.2785714285715 375L 512.2785714285715 375L 512.2785714285715 375L 494.95000000000005 375"
                                        cy="178.92857142857144" cx="566.8785714285715" j="6" val="183"
                                        barHeight="196.07142857142856" barWidth="22.328571428571433"></path>
                                    <g id="SvgjsG3229" class="apexcharts-bar-goals-markers"
                                        style="pointer-events: none">
                                        <g id="SvgjsG3230" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3232" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3234" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3236" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3238" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3240" className="apexcharts-bar-goals-groups"></g>
                                        <g id="SvgjsG3242" className="apexcharts-bar-goals-groups"></g>
                                    </g>
                                </g>
                                <g id="SvgjsG3194" class="apexcharts-datalabels" data:realIndex="0"></g>
                                <g id="SvgjsG3211" class="apexcharts-datalabels" data:realIndex="1"></g>
                                <g id="SvgjsG3228" class="apexcharts-datalabels" data:realIndex="2"></g>
                            </g>
                            <line id="SvgjsLine3265" x1="0" y1="0" x2="521" y2="0"
                                stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine3266" x1="0" y1="0" x2="521" y2="0"
                                stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs-hidden"></line>
                            <g id="SvgjsG3267" class="apexcharts-yaxis-annotations"></g>
                            <g id="SvgjsG3268" class="apexcharts-xaxis-annotations"></g>
                            <g id="SvgjsG3269" class="apexcharts-point-annotations"></g>
                        </g>
                        <g id="SvgjsG3253" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)">
                        </g>
                        <g id="SvgjsG3183" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 210px;"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-light">
                        <div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;">
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(253, 186, 140);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(23, 176, 189);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                        <div class="apexcharts-yaxistooltip-text"></div>
                    </div>
                </div>
            </div>
            <!-- Card Footer -->
            <div
                class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                <div>
                    <button
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                        type="button" data-dropdown-toggle="sales-by-category-dropdown">Last 7 days <svg
                            class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="sales-by-category-dropdown" data-popper-placement="top"
                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(859px, 961px, 0px);">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                        Sales Report
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="md:col-span-2 col-span-4">
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Traffic by device</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Desktop</span>
                </div>
                <a href="#"
                    class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                    Full report
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div id="traffic-by-device" style="min-height: 378.7px;">
                <div id="apexchartss2lhneea" class="apexcharts-canvas apexchartss2lhneea apexcharts-theme-light"
                    style="width: 543px; height: 378.7px;"><svg id="SvgjsSvg3270" width="543" height="378.7"
                        xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                        transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG3272" class="apexcharts-inner apexcharts-graphical"
                            transform="translate(84.5, 0)">
                            <defs id="SvgjsDefs3271">
                                <clipPath id="gridRectMasks2lhneea">
                                    <rect id="SvgjsRect3274" width="382" height="400" x="-3" y="-1"
                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                                <clipPath id="forecastMasks2lhneea"></clipPath>
                                <clipPath id="nonForecastMasks2lhneea"></clipPath>
                                <clipPath id="gridRectMarkerMasks2lhneea">
                                    <rect id="SvgjsRect3275" width="380" height="402" x="-2" y="-2"
                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                </clipPath>
                            </defs>
                            <g id="SvgjsG3276" class="apexcharts-pie">
                                <g id="SvgjsG3277" transform="translate(0, 0) scale(1)">
                                    <circle id="SvgjsCircle3278" r="115.31951219512197" cx="188" cy="188"
                                        fill="transparent"></circle>
                                    <g id="SvgjsG3279" class="apexcharts-slices">
                                        <g id="SvgjsG3280" class="apexcharts-series apexcharts-pie-series"
                                            seriesName="Desktop" rel="1" data:realIndex="0">
                                            <path id="SvgjsPath3281"
                                                d="M 188 10.585365853658516 A 177.41463414634148 177.41463414634148 0 1 1 19.268656109001284 242.82413700203338 L 78.32462647085082 223.6356890513217 A 115.31951219512197 115.31951219512197 0 1 0 188 72.68048780487803 L 188 10.585365853658516 z"
                                                fill="rgba(22,189,202,1)" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-pie-area apexcharts-donut-slice-0" index="0"
                                                j="0" data:angle="252" data:startAngle="0" data:strokeWidth="2"
                                                data:value="70"
                                                data:pathOrig="M 188 10.585365853658516 A 177.41463414634148 177.41463414634148 0 1 1 19.268656109001284 242.82413700203338 L 78.32462647085082 223.6356890513217 A 115.31951219512197 115.31951219512197 0 1 0 188 72.68048780487803 L 188 10.585365853658516 z"
                                                stroke="#1f2937"></path>
                                        </g>
                                        <g id="SvgjsG3282" class="apexcharts-series apexcharts-pie-series"
                                            seriesName="Tablet" rel="2" data:realIndex="1">
                                            <path id="SvgjsPath3283"
                                                d="M 19.268656109001284 242.82413700203338 A 177.41463414634148 177.41463414634148 0 0 1 10.585365853658516 188.00000000000003 L 72.68048780487803 188 A 115.31951219512197 115.31951219512197 0 0 0 78.32462647085082 223.6356890513217 L 19.268656109001284 242.82413700203338 z"
                                                fill="rgba(253,186,140,1)" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-pie-area apexcharts-donut-slice-1" index="0"
                                                j="1" data:angle="18" data:startAngle="252" data:strokeWidth="2"
                                                data:value="5"
                                                data:pathOrig="M 19.268656109001284 242.82413700203338 A 177.41463414634148 177.41463414634148 0 0 1 10.585365853658516 188.00000000000003 L 72.68048780487803 188 A 115.31951219512197 115.31951219512197 0 0 0 78.32462647085082 223.6356890513217 L 19.268656109001284 242.82413700203338 z"
                                                stroke="#1f2937"></path>
                                        </g>
                                        <g id="SvgjsG3284" class="apexcharts-series apexcharts-pie-series"
                                            seriesName="Phone" rel="3" data:realIndex="2">
                                            <path id="SvgjsPath3285"
                                                d="M 10.585365853658516 188.00000000000003 A 177.41463414634148 177.41463414634148 0 0 1 187.96903530508644 10.585368555837903 L 187.97987294830617 72.68048956129464 A 115.31951219512197 115.31951219512197 0 0 0 72.68048780487803 188 L 10.585365853658516 188.00000000000003 z"
                                                fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1"
                                                stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-pie-area apexcharts-donut-slice-2" index="0"
                                                j="2" data:angle="90" data:startAngle="270" data:strokeWidth="2"
                                                data:value="25"
                                                data:pathOrig="M 10.585365853658516 188.00000000000003 A 177.41463414634148 177.41463414634148 0 0 1 187.96903530508644 10.585368555837903 L 187.97987294830617 72.68048956129464 A 115.31951219512197 115.31951219512197 0 0 0 72.68048780487803 188 L 10.585365853658516 188.00000000000003 z"
                                                stroke="#1f2937"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                            <line id="SvgjsLine3286" x1="0" y1="0" x2="376" y2="0"
                                stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine3287" x1="0" y1="0" x2="376" y2="0"
                                stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                class="apexcharts-ycrosshairs-hidden"></line>
                        </g>
                        <g id="SvgjsG3273" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-dark">
                        <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(22, 189, 202);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(253, 186, 140);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span>
                            <div class="apexcharts-tooltip-text"
                                style="font-family: Inter, sans-serif; font-size: 14px;">
                                <div class="apexcharts-tooltip-y-group"><span
                                        class="apexcharts-tooltip-text-y-label"></span><span
                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                <div class="apexcharts-tooltip-goals-group"><span
                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                <div class="apexcharts-tooltip-z-group"><span
                                        class="apexcharts-tooltip-text-z-label"></span><span
                                        class="apexcharts-tooltip-text-z-value"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-4 lg:justify-evenly sm:pt-6">
                <div>
                    <svg class="w-8 h-8 mb-1 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.25A2.25 2.25 0 014.25 2h11.5A2.25 2.25 0 0118 4.25v8.5A2.25 2.25 0 0115.75 15h-3.105a3.501 3.501 0 001.1 1.677A.75.75 0 0113.26 18H6.74a.75.75 0 01-.484-1.323A3.501 3.501 0 007.355 15H4.25A2.25 2.25 0 012 12.75v-8.5zm1.5 0a.75.75 0 01.75-.75h11.5a.75.75 0 01.75.75v7.5a.75.75 0 01-.75.75H4.25a.75.75 0 01-.75-.75v-7.5z">
                        </path>
                    </svg>
                    <h3 class="text-gray-500 dark:text-gray-400">Desktop</h3>
                    <h4 class="text-xl font-bold dark:text-white">
                        234k
                    </h4>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                                </path>
                            </svg>
                            4%
                        </span>
                        vs last month
                    </p>
                </div>
                <div>
                    <svg class="w-8 h-8 mb-1 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M8 16.25a.75.75 0 01.75-.75h2.5a.75.75 0 010 1.5h-2.5a.75.75 0 01-.75-.75z"></path>
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M4 4a3 3 0 013-3h6a3 3 0 013 3v12a3 3 0 01-3 3H7a3 3 0 01-3-3V4zm4-1.5v.75c0 .414.336.75.75.75h2.5a.75.75 0 00.75-.75V2.5h1A1.5 1.5 0 0114.5 4v12a1.5 1.5 0 01-1.5 1.5H7A1.5 1.5 0 015.5 16V4A1.5 1.5 0 017 2.5h1z">
                        </path>
                    </svg>
                    <h3 class="text-gray-500 dark:text-gray-400">Phone</h3>
                    <h4 class="text-xl font-bold dark:text-white">
                        94k
                    </h4>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-red-600 dark:text-red-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                </path>
                            </svg>
                            1%
                        </span>
                        vs last month
                    </p>
                </div>
                <div>
                    <svg class="w-8 h-8 mb-1 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5 1a3 3 0 00-3 3v12a3 3 0 003 3h10a3 3 0 003-3V4a3 3 0 00-3-3H5zM3.5 4A1.5 1.5 0 015 2.5h10A1.5 1.5 0 0116.5 4v12a1.5 1.5 0 01-1.5 1.5H5A1.5 1.5 0 013.5 16V4zm5.25 11.5a.75.75 0 000 1.5h2.5a.75.75 0 000-1.5h-2.5z">
                        </path>
                    </svg>
                    <h3 class="text-gray-500 dark:text-gray-400">Tablet</h3>
                    <h4 class="text-xl font-bold dark:text-white">
                        16k
                    </h4>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-sm text-red-600 dark:text-red-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z">
                                </path>
                            </svg>
                            0,6%
                        </span>
                        vs last month
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
