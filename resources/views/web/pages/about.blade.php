@section('head')
    <title>{{ __('web.menus.about_us') }}</title>
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
                                                                                     class="post post-page current-item">{{ __('web.menus.about_us') }}</span><meta
                                        property="url" content="#"><meta property="position"
                                                                         content="2"></span>
                        </nav>
                        <h1 class="cs_fs_48 cs_fs_lg_36 text-white m-0">{{ __('web.menus.about_us') }}</h1>
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
                                            <section
                                                    class="elementor-section elementor-inner-section elementor-element elementor-element-b412c5f elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                    data-id="b412c5f" data-element_type="section">
                                                <div class="elementor-container elementor-column-gap-default">
                                                    <div
                                                            class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-b7b5195 animated fadeIn"
                                                            data-id="b7b5195" data-element_type="column"
                                                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:200}">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div
                                                                    class="elementor-element elementor-element-02d4088 elementor-widget elementor-widget-bizmax-about-experience"
                                                                    data-id="02d4088" data-element_type="widget"
                                                                    data-widget_type="bizmax-about-experience.default">
                                                                <div class="elementor-widget-container">


                                                                    <div
                                                                            class="cs_experience cs_style_1 position-relative">

                                                                        <div class="cs_experience_thumb">

                                                                            <img decoding="async"
                                                                                 src="{{ asset('/source/experience_img.jpeg') }}"
                                                                                 alt="Thumb"
                                                                                 class="position-relative cs_zindex_3 cs_rounded_15">

                                                                            <div class="cs_experience_shape"><img
                                                                                        decoding="async"
                                                                                        src="{{ asset('/source/experience_shape_1.png') }}"
                                                                                        alt="Shape" class="moving_x">
                                                                            </div>

                                                                        </div>

                                                                        <div
                                                                                class="cs_experience_box background-filled text-center bg-white cs_rounded_10 position-absolute bottom-0 end-0 cs_zindex_3 d-flex flex-column justify-content-center align-items-center"
                                                                                style="background-image:url(https://bizmax-wp.laralink.com/wp-content/uploads/2023/09/experience_bg.jpeg);">

                                                                            <img decoding="async"
                                                                                 src="https://bizmax-wp.laralink.com/wp-content/uploads/2023/07/experience_icon-1-1.svg"
                                                                                 alt="Icon" class="cs_mb_5">

                                                                            <h3 class="text-white cs_fs_60 cs_fs_lg_46 fw-bold lh_1 mb-0 d-flex justify-content-between">

                                                                                <span data-count-to="40"
                                                                                      class="odometer odometer-auto-theme"><div
                                                                                            class="odometer-inside"><span
                                                                                                class="odometer-digit"><span
                                                                                                    class="odometer-digit-spacer">8</span><span
                                                                                                    class="odometer-digit-inner"><span
                                                                                                        class="odometer-ribbon"><span
                                                                                                            class="odometer-ribbon-inner"><span
                                                                                                                class="odometer-value">4</span></span></span></span></span><span
                                                                                                class="odometer-digit"><span
                                                                                                    class="odometer-digit-spacer">8</span><span
                                                                                                    class="odometer-digit-inner"><span
                                                                                                        class="odometer-ribbon"><span
                                                                                                            class="odometer-ribbon-inner"><span
                                                                                                                class="odometer-value">0</span></span></span></span></span></div></span>

                                                                                <span class="fw-light">+</span>

                                                                            </h3>

                                                                            <h2 class="cs_fs_18 fw-normal text-white m-0">{{ __('web.about_us.work_experience') }}</h2>

                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                            class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-7bec314 animated fadeIn"
                                                            data-id="7bec314" data-element_type="column"
                                                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:400}">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div
                                                                    class="elementor-element elementor-element-2e4425d elementor-widget elementor-widget-bizmax-section-title"
                                                                    data-id="2e4425d" data-element_type="widget"
                                                                    data-widget_type="bizmax-section-title.default">
                                                                <div class="elementor-widget-container">


                                                                    <div
                                                                            class="cs_section_heading cs_style_1 d-flex align-items-center text-left">

                                                                        <div class="cs_section_heading_in">

                                                                            <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"
                                                                                data-wow-duration="0.8s"
                                                                                data-wow-delay="0.2s"
                                                                                style="color:#18191d">{{ __('web.menus.about_us') }}</h3>

                                                                            <h2 class="section-title-heading  cs_fs_48 cs_fs_lg_36 cs_mb_20"
                                                                                style="color:#18191d">{{ __('web.about_us.title') }}</h2>

                                                                            <div class="cs_section_text m-0"
                                                                                 style="color:#666"><p
                                                                                        class="m-0">{{ __('web.about_us.description') }}</p>
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div
                                                                    class="elementor-element elementor-element-0dd632d elementor-widget elementor-widget-bizmax-about-info"
                                                                    data-id="0dd632d" data-element_type="widget"
                                                                    data-widget_type="bizmax-about-info.default">
                                                                <div class="elementor-widget-container">


                                                                    {{--                                                                    <div class="cs_progressbar cs_style_1 cs_mb_20">--}}

                                                                    {{--                                                                        <div--}}
                                                                    {{--                                                                            class="cs_progressbar_heading d-flex justify-content-between align-items-center cs_mb_8">--}}

                                                                    {{--                                                                            <h3 class="fw-medium m-0 cs_fs_18">Web--}}
                                                                    {{--                                                                                development</h3>--}}

                                                                    {{--                                                                            <p class="cs_fs_14 cs_lh_base m-0">90%</p>--}}

                                                                    {{--                                                                        </div>--}}

                                                                    {{--                                                                        <div--}}
                                                                    {{--                                                                            class="cs_progress cs_rounded_8 overflow-hidden"--}}
                                                                    {{--                                                                            data-progress="90">--}}

                                                                    {{--                                                                            <div--}}
                                                                    {{--                                                                                class="cs_progress_in bg-accent cs_rounded_8 h-100 wow fadeInLeft"--}}
                                                                    {{--                                                                                data-wow-duration="0.8s"--}}
                                                                    {{--                                                                                data-wow-delay="0.2s"--}}
                                                                    {{--                                                                                style="width: 90%;"></div>--}}

                                                                    {{--                                                                        </div>--}}

                                                                    {{--                                                                    </div><!-- .cs_progressbar -->--}}

                                                                    {{--                                                                    <div class="row cs_mb_15">--}}

                                                                    {{--                                                                        <div class="col-lg-6">--}}

                                                                    {{--                                                                            <div--}}
                                                                    {{--                                                                                class="cs_about-icon-box position-relative cs_mb_25">--}}

                                                                    {{--                                                                                <span--}}
                                                                    {{--                                                                                    class="position-absolute cs_height_20 cs_width_20 top-0 start-0 cs_mt_5 bg-accent text-white cs_fs_10 d-flex align-items-center justify-content-center cs_rounded_30"><i--}}
                                                                    {{--                                                                                        class="fas fa-angle-double-right"></i></span>--}}

                                                                    {{--                                                                                <h3 class="cs_fs_16 cs_pl_35 cs_mb_12 cs_lh_lg">--}}
                                                                    {{--                                                                                    Accounting and Bookkeeping</h3>--}}

                                                                    {{--                                                                                <p class="m-0">Services related to--}}
                                                                    {{--                                                                                    financial record-keeping,--}}
                                                                    {{--                                                                                    bookkeeping.</p>--}}

                                                                    {{--                                                                            </div>--}}

                                                                    {{--                                                                        </div>--}}

                                                                    {{--                                                                        <div class="col-lg-6">--}}

                                                                    {{--                                                                            <div--}}
                                                                    {{--                                                                                class="cs_about-icon-box position-relative cs_mb_25">--}}

                                                                    {{--                                                                                <span--}}
                                                                    {{--                                                                                    class="position-absolute cs_height_20 cs_width_20 top-0 start-0 cs_mt_5 bg-accent text-white cs_fs_10 d-flex align-items-center justify-content-center cs_rounded_30"><i--}}
                                                                    {{--                                                                                        class="fas fa-angle-double-right"></i></span>--}}

                                                                    {{--                                                                                <h3 class="cs_fs_16 cs_pl_35 cs_mb_12 cs_lh_lg">--}}
                                                                    {{--                                                                                    Human Resources (HR) Consulting</h3>--}}

                                                                    {{--                                                                                <p class="m-0">Assistance with--}}
                                                                    {{--                                                                                    HR-related tasks such as--}}
                                                                    {{--                                                                                    recruitment.</p>--}}

                                                                    {{--                                                                            </div>--}}

                                                                    {{--                                                                        </div>--}}

                                                                    {{--                                                                    </div>--}}

                                                                    <div
                                                                            class="d-flex align-items-center cs_row_gap_20 cs_column_gap_30 cs_column_gap_lg_20 flex-wrap">

                                                                        <a href="https://bizmax-wp.laralink.com/contact"
                                                                           class="cs_btn cs_style_1 cs_fs_14 cs_rounded_5 cs_pl_30 cs_pr_30 cs_pt_10 cs_pb_10 overflow-hidden"><span>{{ __('web.sliders.free_consultation') }}</span></a>

                                                                        <a href="https://www.youtube.com/embed/VStvZjykQ00"
                                                                           class="cs_video_open d-flex align-items-center">

				<span
                        class="cs_player_btn cs_width_45 cs_height_45 rounded-circle d-flex align-items-center justify-content-center text-white bg-primary position-relative cs_pl_5">

					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">

					<path
                            d="M1.71401 16C1.61636 16 1.51868 15.9748 1.43054 15.9246C1.25251 15.8231 1.14258 15.6339 1.14258 15.4285V0.570579C1.14258 0.365193 1.25251 0.176009 1.43054 0.0744495C1.61022 -0.026561 1.82844 -0.0243301 2.00475 0.0783627L14.5762 7.50735C14.7503 7.6106 14.8569 7.79755 14.8569 7.99957C14.8569 8.20159 14.7503 8.38855 14.5762 8.49179L2.00475 15.9207C1.9149 15.9732 1.81443 16 1.71401 16ZM2.28544 1.57172V14.4274L13.1621 7.99957L2.28544 1.57172Z"
                            fill="white"></path>

					</svg>

				</span>

                                                                            <span
                                                                                    class="cs_ml_15">{{ __('web.about_us.watch_the_video') }}</span>

                                                                        </a>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
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
