<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css2?family={{ urlencode(theme_option('font_heading', 'Jost')) }}:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family={{ urlencode(theme_option('font_body', 'Muli')) }}:300,400,600,700" rel="stylesheet" type="text/css">
    
    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: {{ theme_option('primary_color', '#2b4db9') }};
            --font-body: {{ theme_option('font_body', 'Muli') }}, sans-serif;
            --font-heading: {{ theme_option('font_heading', 'Jost') }}, sans-serif;
        }
    </style>

    <script>
        "use strict";
        window.trans = {
            "Price": "{{ __('Price') }}",
            "Number of rooms": "{{ __('Number of rooms') }}",
            "Number of rest rooms": "{{ __('Number of rest rooms') }}",
            "Square": "{{ __('Square') }}",
            "No property found": "{{ __('No property found') }}",
            "million": "{{ __('million') }}",
            "billion": "{{ __('billion') }}",
            "in": "{{ __('in') }}",
            "Added to wishlist successfully!": "{{ __('Added to wishlist successfully!') }}",
            "Removed from wishlist successfully!": "{{ __('Removed from wishlist successfully!') }}",
            "I care about this property!!!": "{{ __('I care about this property!!!') }}",
            "See More Reviews": "{{ __('See More Reviews') }}",
            "Reviews": "{{ __('Reviews') }}",
            "out of 5.0": "{{ __('out of 5.0') }}",
            "service": "{{ trans('plugins/real-estate::review.service') }}",
            "value": "{{ trans('plugins/real-estate::review.value') }}",
            "location": "{{ trans('plugins/real-estate::review.location') }}",
            "cleanliness": "{{ trans('plugins/real-estate::review.cleanliness') }}",
        }
        window.themeUrl = '{{ Theme::asset()->url('') }}';
        window.siteUrl = '{{ url('') }}';
        window.currentLanguage = '{{ App::getLocale() }}';
    </script>

    {!! Theme::header() !!}
</head>
<body class="{{ theme_option('skin', 'blue') }}" @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
<div id="alert-container"></div>

@if (theme_option('preloader_enabled', 'no') == 'yes')
    <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
@endif

<div id="main-wrapper">
    <!-- Modern Fixed Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md transition-all duration-300" id="modern-nav">
        <!-- Top Bar -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-2 text-sm">
                    <div class="flex items-center space-x-4">
                        @if (is_plugin_active('language'))
                            <div class="flex items-center space-x-2">
                                {!! apply_filters('language_switcher') !!}
                            </div>
                        @endif
                    </div>
                    
                    @if (is_plugin_active('real-estate'))
                        <div class="flex items-center space-x-6">
                            <a href="{{ route('public.wishlist') }}" class="flex items-center space-x-2 hover:text-blue-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ __('Wishlist') }}</span>
                                <span class="bg-white text-blue-600 px-2 py-0.5 rounded-full text-xs font-semibold wishlist-count">0</span>
                            </a>
                            
                            @php $currencies = get_all_currencies(); @endphp
                            @if (count($currencies) > 1)
                                <div class="flex items-center space-x-2">
                                    <span>{{ __('Currency') }}:</span>
                                    @foreach ($currencies as $currency)
                                        <a href="{{ route('public.change-currency', $currency->title) }}" 
                                           class="hover:text-blue-200 transition-colors {{ get_application_currency_id() == $currency->id ? 'font-semibold underline' : '' }}">
                                            {{ $currency->title }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    @if (theme_option('logo'))
                        <a href="{{ route('public.index') }}" class="flex items-center space-x-3">
                            <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" 
                                 alt="{{ setting('site_title') }}" 
                                 class="h-12 w-auto object-contain">
                            <span class="text-2xl font-bold text-gray-800 hidden lg:block">Essentiel Immo Tamatave</span>
                        </a>
                    @endif
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    {!! Menu::renderMenuLocation('main-menu', [
                        'view'    => 'modern-menu',
                        'options' => ['class' => 'flex items-center space-x-6'],
                    ]) !!}
                </div>

                <!-- Right Side Actions -->
                @if (is_plugin_active('real-estate'))
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="{{ route('public.account.properties.create') }}" 
                           class="flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-6 py-2.5 rounded-lg font-semibold transition-colors shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>{{ __('Add Property') }}</span>
                        </a>

                        @if (auth('account')->check())
                            <div class="relative group">
                                <button class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium text-gray-700">{{ auth('account')->user()->name }}</span>
                                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                                    <a href="{{ route('public.account.dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors rounded-t-lg">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                       class="block px-4 py-3 text-red-600 hover:bg-red-50 transition-colors rounded-b-lg">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                            <form id="logout-form" action="{{ route('public.account.logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('public.account.login') }}" 
                               class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                <span>{{ __('Sign In') }}</span>
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Mobile Menu Button -->
                <button type="button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" id="mobile-menu-button">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
            <div class="container mx-auto px-4 py-4 space-y-3">
                {!! Menu::renderMenuLocation('main-menu', [
                    'view'    => 'mobile-menu',
                    'options' => ['class' => 'space-y-2'],
                ]) !!}

                @if (is_plugin_active('real-estate'))
                    <div class="pt-4 border-t border-gray-200 space-y-2">
                        <a href="{{ route('public.account.properties.create') }}" 
                           class="block w-full text-center bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-semibold transition-colors">
                            {{ __('Add Property') }}
                        </a>
                        @if (auth('account')->check())
                            <a href="{{ route('public.account.dashboard') }}" 
                               class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-lg font-medium transition-colors">
                                {{ auth('account')->user()->name }}
                            </a>
                        @else
                            <a href="{{ route('public.account.login') }}" 
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-semibold transition-colors">
                                {{ __('Sign In') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed nav -->
    <div class="h-32"></div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('modern-nav');
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
            
            lastScroll = currentScroll;
        });
    </script>
