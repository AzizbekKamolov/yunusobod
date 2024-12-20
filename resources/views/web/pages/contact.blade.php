@section('head')
    <title>{{ __('web.menus.contact_us') }}-{{ env('APP_NAME') }}</title>
@endsection
@extends('web.layouts.home')
@section('content')
    <main>

        <!-- Breadcrumbs -->
        <!-- breadcrumb-area-start-->
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
                            property="position" content="1"></span> &gt;
                    <span property="itemListElement" typeof="ListItem"><span property="name"
                                                                             class="post post-page current-item">{{ __('web.menus.contact_us') }}</span><meta
                            property="url" content="#"><meta property="position"
                                                             content="2"></span>
                </nav>
                <h1 class="cs_fs_48 cs_fs_lg_36 text-white m-0">{{ __('web.menus.contact_us') }}</h1>
            </div>
            <div class="position-absolute end-0 bottom-0">
                <svg width="660" height="497" viewBox="0 0 660 497" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M240 0H660L430 497H0L240 0Z" fill="url(#paint0_linear_81_9510)"></path>
                    <defs>
                        <linearGradient id="paint0_linear_81_9510" x1="330" y1="78.2497" x2="375.052" y2="780.743"
                                        gradientUnits="userSpaceOnUse">
{{--                            <stop stop-color="white" stop-opacity="0" offset="none"></stop>--}}
                            <stop offset="0.9999" stop-color="#D9D9D9" stop-opacity="0.35"></stop>
                            <stop offset="1" stop-color="#222121" stop-opacity="0"></stop>
                            <stop offset="1" stop-color="#222121" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <!-- breadcrumb-area-start-->


        <div class="bizmax-internal-area bizmax-entry-page">
            <div class="container-elementor">
                <div class="row">
                    <div class="col-12">

                        <article id="post-65" class="post-65 page type-page status-publish hentry">

                            <div class="entry-content">
                                <div data-elementor-type="wp-page" data-elementor-id="65"
                                     class="elementor elementor-65">
                                    <section
                                        class="elementor-section elementor-top-section elementor-element elementor-element-b51d21b elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                        data-id="b51d21b" data-element_type="section"
                                        data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
                                        style="width: 878px; left: 0px;">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div
                                                class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-5eceea8 contact-us-form"
                                                data-id="5eceea8" data-element_type="column">
                                                <div class="elementor-widget-wrap elementor-element-populated">
                                                    <div
                                                        class="elementor-element elementor-element-f94d94a elementor-widget elementor-widget-bizmax-section-title"
                                                        data-id="f94d94a" data-element_type="widget"
                                                        data-widget_type="bizmax-section-title.default">
                                                        <div class="elementor-widget-container">


                                                            <div
                                                                class="cs_section_heading cs_style_1 d-flex align-items-center text-left">

                                                                <div class="cs_section_heading_in">

                                                                    <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"
                                                                        data-wow-duration="0.8s" data-wow-delay="0.2s"
                                                                        style="color:#18191d">{{ __('web.contact_us.have_any_question') }}</h3>

                                                                    <h2 class="section-title-heading  cs_fs_48 cs_fs_lg_36 cs_mb_20"
                                                                        style="color:#18191d">{{ __('web.contact_us.write_a_message') }}</h2>

                                                                    <div class="cs_section_text m-0"
                                                                         style="color:#666"></div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-b4d1974 elementor-widget elementor-widget-bizmax-contact"
                                                        data-id="b4d1974" data-element_type="widget"
                                                        data-widget_type="bizmax-contact.default">
                                                        <div class="elementor-widget-container">

                                                            <div class="" id="wpcf7-f4665-p65-o1" lang="en-US"
                                                                 dir="ltr">
                                                                <div class="screen-reader-response"><p role="status"
                                                                                                       aria-live="polite"
                                                                                                       aria-atomic="true"></p>
                                                                    @if(session()->has('success'))
                                                                        <h4
                                                                            class="text-success">{{ session('success') }}</h4>
                                                                    @endif
                                                                    <ul></ul>
                                                                </div>
                                                                <form action="{{ route('dashboard.feedback') }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="row bizmax-form">
                                                                        <div class="col-lg-6">
                                                                            <div class="contact__form-input">
                                                                                <p><span class="wpcf7-form-control-wrap"
                                                                                         data-name="your-name"><input
                                                                                            size="40" maxlength="400"
                                                                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                            aria-required="true"
                                                                                            aria-invalid="false"
                                                                                            placeholder="{{ __('web.contact_us.your_name') }}"
                                                                                            value="{{ old('fio') }}"
                                                                                            type="text"
                                                                                            name="fio"></span>
                                                                                </p>
                                                                                @if($errors->has('fio'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('fio') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="contact__form-input">
                                                                                <p><span class="wpcf7-form-control-wrap"
                                                                                         data-name="your-email"><input
                                                                                            size="40" maxlength="400"
                                                                                            class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                                                                            aria-required="true"
                                                                                            aria-invalid="false"
                                                                                            placeholder="{{ __('web.contact_us.email_address') }}"
                                                                                            value="" type="email"
                                                                                            name="email"></span>
                                                                                </p>
                                                                                @if($errors->has('email'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('email') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="contact__form-input">
                                                                                <p><span class="wpcf7-form-control-wrap"
                                                                                         data-name="tel-371"><input
                                                                                            size="40" maxlength="400"
                                                                                            class="wpcf7-form-control wpcf7-tel wpcf7-text wpcf7-validates-as-tel"
                                                                                            aria-invalid="false"
                                                                                            placeholder="{{ __('web.contact_us.phone') }}"
                                                                                            value=""
                                                                                            type="tel"
                                                                                            name="phone"></span>
                                                                                </p>
                                                                                @if($errors->has('phone'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('phone') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="contact__form-input">
                                                                                <p><span class="wpcf7-form-control-wrap"
                                                                                         data-name="your-name"><input
                                                                                            size="40" maxlength="400"
                                                                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                            aria-required="true"
                                                                                            aria-invalid="false"
                                                                                            placeholder="{{ __('web.contact_us.subject') }}"
                                                                                            value="" type="text"
                                                                                            name="title"></span>
                                                                                </p>
                                                                                @if($errors->has('title'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('title') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="contact__form-input">
                                                                                <p><span class="wpcf7-form-control-wrap"
                                                                                         data-name="your-message"><textarea
                                                                                            cols="40" rows="10"
                                                                                            maxlength="2000"
                                                                                            class="wpcf7-form-control wpcf7-textarea"
                                                                                            aria-invalid="false"
                                                                                            placeholder="{{ __('web.contact_us.message') }}"
                                                                                            name="content"></textarea></span>
                                                                                </p>
                                                                                @if($errors->has('content'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('content') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p>
                                                                                <button
                                                                                    class="cs_btn cs_style_1 cs_fs_14 cs_rounded_5 cs_pl_30 cs_pr_30 cs_pt_10 cs_pb_10 overflow-hidden">
                                                                                    <span>{{ __('web.contact_us.send_a_message') }}</span>
                                                                                </button>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="wpcf7-response-output"
                                                                         aria-hidden="true"></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6923a36"
                                                data-id="6923a36" data-element_type="column">
                                                <div class="elementor-widget-wrap elementor-element-populated">
                                                    <div
                                                        class="elementor-element elementor-element-5c1e6ee elementor-widget elementor-widget-bizmax-section-title"
                                                        data-id="5c1e6ee" data-element_type="widget"
                                                        data-widget_type="bizmax-section-title.default">
                                                        <div class="elementor-widget-container">


                                                            <div
                                                                class="cs_section_heading cs_style_1 d-flex align-items-center text-left">

                                                                <div class="cs_section_heading_in">

                                                                    <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"
                                                                        data-wow-duration="0.8s" data-wow-delay="0.2s"
                                                                        style="color:#18191d">{{ __('web.contact_us.title') }}</h3>

                                                                    <h2 class="section-title-heading  cs_fs_48 cs_fs_lg_36 cs_mb_20"
                                                                        style="color:#18191d">{{ __('web.contact_us.title2') }}</h2>

                                                                    <div class="cs_section_text m-0" style="color:#666">
                                                                        <p class="m-0">{{ __('web.contact_us.about') }}</p>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-f3e26f7 elementor-widget elementor-widget-bizmax-contact-list"
                                                        data-id="f3e26f7" data-element_type="widget"
                                                        data-widget_type="bizmax-contact-list.default">
                                                        <div class="elementor-widget-container">


                                                            <div
                                                                class="bizmax-contact-list d-flex align-items-center cs_mb_30">

                                                                <div
                                                                    class="d-flex align-items-center justify-content-center cs_height_90 cs_width_90 cs_height_lg_80 cs_width_lg-80 cs_rounded_10 flex-none cs_mr_20 bg-accent">
                                                                    <img decoding="async"
                                                                         src="{{ asset('source/1-1-1.png') }}">

                                                                </div>

                                                                <div>

                                                                    <p class="text-accent cs_mb_7">{{ __('web.contact_us.have_any_question') }}</p>

                                                                    <h2 class="m-0 fw-medium cs_fs_22 cs_fs_lg_18 cs_lh_base"
                                                                        style="color:#18191d"><a
                                                                            href="tel:070 4531 9507 "
                                                                            style="color:#18191d">+998 (99) 987 55
                                                                            35</a>

                                                                    </h2>

                                                                </div>

                                                            </div>

                                                            <div
                                                                class="bizmax-contact-list d-flex align-items-center cs_mb_30">

                                                                <div
                                                                    class="d-flex align-items-center justify-content-center cs_height_90 cs_width_90 cs_height_lg_80 cs_width_lg-80 cs_rounded_10 flex-none cs_mr_20 bg-accent">
                                                                    <img decoding="async"
                                                                         src="{{ asset('/source/2-1-1.png') }}">

                                                                </div>

                                                                <div>

                                                                    <p class="text-accent cs_mb_7">{{ __('web.contact_us.send_email') }}</p>

                                                                    <h2 class="m-0 fw-medium cs_fs_22 cs_fs_lg_18 cs_lh_base"
                                                                        style="color:#18191d"><a
                                                                            href="mailto:barassociation@gmail.com"
                                                                            style="color:#18191d">barassociation@gmail.com</a>

                                                                    </h2>

                                                                </div>

                                                            </div>

                                                            <div
                                                                class="bizmax-contact-list d-flex align-items-center cs_mb_30">

                                                                <div
                                                                    class="d-flex align-items-center justify-content-center cs_height_90 cs_width_90 cs_height_lg_80 cs_width_lg-80 cs_rounded_10 flex-none cs_mr_20 bg-accent">
                                                                    <img decoding="async"
                                                                         src="{{ asset('/source/3-1-1.png') }}">

                                                                </div>

                                                                <div>

                                                                    <p class="text-accent cs_mb_7">{{ __('web.contact_us.address') }}</p>

                                                                    <h2 class="m-0 fw-medium cs_fs_22 cs_fs_lg_18 cs_lh_base"
                                                                        style="color:#18191d"><a href=""
                                                                                                 style="color:#18191d">{{ __('web.address') }}</a>

                                                                    </h2>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section
                                        class="elementor-section elementor-top-section elementor-element elementor-element-2ff6c9c elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default"
                                        data-id="2ff6c9c" data-element_type="section"
                                        data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
                                        style="width: 878px; left: 0px;">
                                        <div class="elementor-container elementor-column-gap-default">
                                            <div
                                                class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8b3ef6e"
                                                data-id="8b3ef6e" data-element_type="column">
                                                <div class="elementor-widget-wrap elementor-element-populated">
                                                    <div
                                                        class="elementor-element elementor-element-927e367 elementor-widget elementor-widget-google_maps"
                                                        data-id="927e367" data-element_type="widget"
                                                        data-widget_type="google_maps.default">
                                                        <div class="elementor-widget-container">
                                                            <style>/*! elementor - v3.23.0 - 05-08-2024 */
                                                                .elementor-widget-google_maps .elementor-widget-container {
                                                                    overflow: hidden
                                                                }

                                                                .elementor-widget-google_maps .elementor-custom-embed {
                                                                    line-height: 0
                                                                }

                                                                .elementor-widget-google_maps iframe {
                                                                    height: 300px
                                                                }</style>
                                                            <div class="elementor-custom-embed">
                                                                <iframe
                                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3905.7905077774412!2d69.27406270110801!3d41.37892771716679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8cd72cb3b5eb%3A0xc9eb81fe639aca9e!2sDom%2014%2C%20Karakamish%20St%2C%20100190%2C%20Tashkent%2C%20Uzbekistan!5e0!3m2!1sen!2s!4v1728124291553!5m2!1sen!2s"
                                                                    {{--                                                                    width="600" height="450" style="border:0;"--}}
                                                                    allowfullscreen="" loading="lazy"
                                                                    referrerpolicy="no-referrer-when-downgrade"
                                                                    title="{{ __('web.address') }}"
                                                                    aria-label="{{ __('web.address') }}"
                                                                >
                                                                </iframe>
                                                                {{--                                                                <iframe loading="lazy"--}}
                                                                {{--                                                                        src="https://maps.google.com/maps?q=Parsippany%2C%20NJ%2007054%2C%20United%20States&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near"--}}
                                                                {{--                                                                        title="Parsippany, NJ 07054, United States"--}}
                                                                {{--                                                                        aria-label="Parsippany, NJ 07054, United States"></iframe>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div><!-- .entry-content -->

                        </article><!-- #post-65 -->
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
