@section('head')
    <title>{{ __('web.menus.activity') }}-{{ env('APP_NAME') }}</title>
@endsection
@extends('web.layouts.home')
@section('content')
    <div class="container-elementor" style="margin-bottom: 200px">
        <div class="row">
            <div class="col-12">

                <div
                        class="cs_page_header position-relative background-filled d-flex align-items-center justify-content-between"
                        @if($item->photo)
                            data-src="{{ asset("/sliders/$item->photo") }}"
                        style="background-image: url('{{ asset("/sliders/$item->photo") }}');"
                        @else
                            data-src="{{ asset('/source/page_header_1.jpeg') }}"
                        style="background-image: url('{{ asset('/source/page_header_1.jpeg') }}');"
                        @endif>
                    <div class="container position-relative z-index-1">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav cs_fs_18 cs_mb_5">
                            <!-- Breadcrumb NavXT 7.3.1 -->
                            <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"
                                                                                  title="Go to Bizmax."
                                                                                  href="#"
                                                                                  class="home"><span
                                            property="name">{{ __('web.colleagues_of_advocates') }}</span></a><meta
                                        property="position"
                                        content="1"></span>
                            &gt;
                            <span property="itemListElement" typeof="ListItem"><span property="name"
                                                                                     class="post post-page current-item">{{ __('web.menus.activity') }}</span><meta
                                        property="url" content="#"><meta property="position"
                                                                         content="2"></span>
                        </nav>
                        <h1 class="cs_fs_48 cs_fs_lg_36 text-white m-0">{{ __('web.menus.activity') }}</h1>
                    </div>
                    <div class="position-absolute end-0 bottom-0">
                        <svg width="660" height="497" viewBox="0 0 660 497" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M240 0H660L430 497H0L240 0Z" fill="url(#paint0_linear_81_9510)"></path>
                            <defs>
                                <linearGradient id="paint0_linear_81_9510" x1="330" y1="78.2497" x2="375.052"
                                                y2="780.743"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0" offset="none"></stop>
                                    <stop offset="0.9999" stop-color="#D9D9D9" stop-opacity="0.35"></stop>
                                    <stop offset="1" stop-color="#222121" stop-opacity="0"></stop>
                                    <stop offset="1" stop-color="#222121" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <article id="post-30" class="post-30 page type-page status-publish hentry">

                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="30" class="elementor elementor-30">
                            <section
                                    class="elementor-section elementor-top-section elementor-element elementor-element-d286339 elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default"
                                    data-id="d286339" data-element_type="section"
                                    data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
                                    style="width: 888px; left: 0px;">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div
                                            class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4b274ee"
                                            data-id="4b274ee" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
{{--                                            <div--}}
{{--                                                    class="elementor-element elementor-element-861fe31 elementor-widget__width-auto elementor-absolute section-anim-shape semi_rotate elementor-widget elementor-widget-image"--}}
{{--                                                    data-id="861fe31" data-element_type="widget"--}}
{{--                                                    data-settings="{&quot;_position&quot;:&quot;absolute&quot;}"--}}
{{--                                                    data-widget_type="image.default">--}}
{{--                                                <div class="elementor-widget-container">--}}
{{--                                                    <style>/*! elementor - v3.23.0 - 05-08-2024 */--}}
{{--                                                        .elementor-widget-image {--}}
{{--                                                            text-align: center--}}
{{--                                                        }--}}

{{--                                                        .elementor-widget-image a {--}}
{{--                                                            display: inline-block--}}
{{--                                                        }--}}

{{--                                                        .elementor-widget-image a img[src$=".svg"] {--}}
{{--                                                            width: 48px--}}
{{--                                                        }--}}

{{--                                                        .elementor-widget-image img {--}}
{{--                                                            vertical-align: middle;--}}
{{--                                                            display: inline-block--}}
{{--                                                        }</style>--}}
{{--                                                    <img fetchpriority="high" decoding="async" width="1080"--}}
{{--                                                         height="1080"--}}
{{--                                                         src="https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1.png"--}}
{{--                                                         class="attachment-full size-full wp-image-6076" alt=""--}}
{{--                                                         srcset="https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1.png 1080w, https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1-300x300.png 300w, https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1-1024x1024.png 1024w, https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1-150x150.png 150w, https://bizmax-wp.laralink.com/wp-content/uploads/2023/08/section-shape-1-768x768.png 768w"--}}
{{--                                                         sizes="(max-width: 1080px) 100vw, 1080px"></div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="container" style="width: 888px; left: 0px;">
                                {!! $item->description ?? '' !!}

                            </section>


                        </div>
                    </div><!-- .entry-content -->

                </article><!-- #post-30 -->
            </div>
        </div>
    </div>

@endsection
