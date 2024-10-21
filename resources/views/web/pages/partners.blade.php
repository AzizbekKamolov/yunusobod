@section('head')
    <title>{{ __('web.menus.our_partners') }}-{{ env('APP_NAME') }}</title>
@endsection
@extends('web.layouts.home')
@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="17" class="elementor elementor-17">
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
                                                                          href="/"
                                                                          class="home"><span
                                property="name">{{ __('web.colleagues_of_advocates') }}</span></a><meta
                            property="position" content="1"></span> &gt;
                    <span property="itemListElement" typeof="ListItem"><span property="name"
                                                                             class="post post-page current-item">{{ __('web.menus.our_partners') }}</span><meta
                            property="url" content="{{ route('contact') }}"><meta property="position"
                                                                                                   content="2"></span>
                </nav>
                <h1 class="cs_fs_48 cs_fs_lg_36 text-white m-0">{{ __('web.menus.our_partners') }}</h1>
            </div>
            <div class="position-absolute end-0 bottom-0">
                <svg width="660" height="497" viewBox="0 0 660 497" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M240 0H660L430 497H0L240 0Z" fill="url(#paint0_linear_81_9510)"></path>
                    <defs>
                        <linearGradient id="paint0_linear_81_9510" x1="330" y1="78.2497" x2="375.052" y2="780.743"
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
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-7d6c6de elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default"
            data-id="7d6c6de" data-element_type="section"
            data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}"
            style="width: 878px; left: 0px;">
            <div class="elementor-container elementor-column-gap-default">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb15cb3"
                    data-id="fb15cb3" data-element_type="column"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <section
                            class="elementor-section elementor-inner-section elementor-element elementor-element-73ddd5e elementor-section-boxed elementor-section-height-default elementor-section-height-default animated fadeIn"
                            data-id="73ddd5e" data-element_type="section"
                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div
                                    class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-96a2609 animated fadeIn"
                                    data-id="96a2609" data-element_type="column"
                                    data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div
                                            class="elementor-element elementor-element-3d32066 elementor-widget elementor-widget-bizmax-section-title"
                                            data-id="3d32066" data-element_type="widget"
                                            data-widget_type="bizmax-section-title.default">
                                            <div class="elementor-widget-container">


                                                <div
                                                    class="cs_section_heading cs_style_1 d-flex align-items-center text-center">

                                                    <div class="cs_section_heading_in">

{{--                                                        <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"--}}
{{--                                                            data-wow-duration="0.8s" data-wow-delay="0.2s"--}}
{{--                                                            style="color:#18191d">{{ __('web.partners.title') }}</h3>--}}

                                                        <h2 class="section-title-heading  cs_fs_48 cs_fs_lg_36 cs_mb_20"
                                                            style="color:#18191d">{!!  __('web.partners.title') !!}</h2>

                                                        <div class="cs_section_text m-0" style="color:#666"></div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section
                            class="elementor-section elementor-inner-section elementor-element elementor-element-d89cb3b elementor-section-boxed elementor-section-height-default elementor-section-height-default animated fadeIn"
                            data-id="d89cb3b" data-element_type="section"
                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div
                                    class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6a4bf2b"
                                    data-id="6a4bf2b" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div
                                            class="elementor-element elementor-element-a1b16b9 elementor-widget elementor-widget-bizmax-team-modern"
                                            data-id="a1b16b9" data-element_type="widget"
                                            data-widget_type="bizmax-team-modern.default">
                                            <div class="elementor-widget-container">
                                                <div class="bizmax-teams">
                                                    <div class="bizmax-clients__grid bizmax-team__grid">
                                                        <div class="row">
                                                            @foreach($partners as $partner)
                                                                <div class="col-lg-4 col-md-6 col-sm-6">

                                                                    <div class="cs_team cs_style_1 text-center cs_mt_30 overflow-hidden cs_rounded_50">

{{--                                                                        <div--}}
{{--                                                                            class="cs_team_member position-relativecs_rounded_50">--}}

{{--                                                                            <a class="cs_team_link"--}}
{{--                                                                               href="#">--}}

{{--                                                                                <img decoding="async"--}}
{{--                                                                                     class="w-100 cs_rounded_50"--}}
{{--                                                                                     src="{{ asset("/sliders/$partner->photo") }}"--}}
{{--                                                                                     alt="{{ $partner->name }}">--}}

{{--                                                                            </a>--}}

{{--                                                                            <div--}}
{{--                                                                                class="cs_social_btns d-flex flex-wrap cs_column_gap_15 cs_row_gap_15 cs_transition_5 cs_fs_20 cs_fs_lg_18 position-absolute">--}}
{{--                                                                                <a href="#"--}}
{{--                                                                                   class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i--}}
{{--                                                                                        class="fab fa-facebook-f"></i></a>--}}

{{--                                                                                <a href="#"--}}
{{--                                                                                   class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i--}}
{{--                                                                                        class="fab fa-twitter"></i></a>--}}

{{--                                                                                <a href="#"--}}
{{--                                                                                   class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i--}}
{{--                                                                                        class="fab fa-dribbble"></i></a>--}}

{{--                                                                            </div>--}}

{{--                                                                        </div>--}}

                                                                        <div style="background-color:#ACC8E5;"
                                                                            class="cs_team_info cs_pt_127 cs_pl_15 cs_pr_15 cs_pb_25 cs_transition_4">
                                                                            @if($partner->photo)
                                                                                <img decoding="async"
                                                                                     class="cs_rounded_45"
                                                                                     src="{{ asset("/sliders/$partner->photo") }}"
                                                                                     alt="{{ $partner->name }}">
                                                                            @endif

                                                                            <a class="cs_team_link"
                                                                               href="#">

                                                                                <h2 class="text-white m-0 cs_fs_26 cs_mb_3">
                                                                                    <span style="color:#112A46;">{{ $partner->name }}</span></h2>

                                                                                <p class="text-white m-0">{{ $partner->aboutH }}</p>
                                                                            </a>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <section class="container" style="width: 888px; left: 0px; margin-top: 100px;">
                            {!! $item->description ?? '' !!}

                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
