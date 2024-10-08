@extends('web.layouts.layout')
@section('content')
    <div id="page" class="site">
        @include('web.layouts.header')
        <div id="smooth-wrapper">
            <div id="smooth-content">
                <main>
                    <!-- Breadcrumbs -->
                    <div class="bizmax-internal-area bizmax-entry-page">
                        <div class="container-elementor">
                            <div class="row">
                                <div class="col-12">

                                    <article id="post-17" class="post-17 page type-page status-publish hentry">

                                        <div class="entry-content">
                                            <div data-elementor-type="wp-page" data-elementor-id="17"
                                                 class="elementor elementor-17">
                                                @include('web.layouts.slider')

                                                <section
                                                    class="elementor-section elementor-top-section elementor-element elementor-element-7ace083 elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default"
                                                    data-id="7ace083" data-element_type="section"
                                                    data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}"
                                                    style="width: 1281px; left: 0px;">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div
                                                            class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-51a81c3"
                                                            data-id="51a81c3" data-element_type="column"
                                                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                            <div
                                                                class="elementor-widget-wrap elementor-element-populated">
                                                                <section
                                                                    class="elementor-section elementor-inner-section elementor-element elementor-element-3f6f8fb elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                                    data-id="3f6f8fb" data-element_type="section">
                                                                    <div
                                                                        class="elementor-container elementor-column-gap-default">
                                                                        <div
                                                                            class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-57ce8c1 animated fadeIn"
                                                                            data-id="57ce8c1" data-element_type="column"
                                                                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                                                                            <div
                                                                                class="elementor-widget-wrap elementor-element-populated">
                                                                                <div
                                                                                    class="elementor-element elementor-element-f975398 elementor-widget elementor-widget-bizmax-section-title"
                                                                                    data-id="f975398"
                                                                                    data-element_type="widget"
                                                                                    data-widget_type="bizmax-section-title.default">
                                                                                    <div
                                                                                        class="elementor-widget-container">


                                                                                        <div
                                                                                            class="cs_section_heading cs_style_1 d-flex align-items-center cs_column_gap_15 cs_row_gap_15 text-left">

                                                                                            <div
                                                                                                class="cs_section_heading_in">

                                                                                                <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"
                                                                                                    data-wow-duration="0.8s"
                                                                                                    data-wow-delay="0.2s"
                                                                                                    style="color:#18191d">{{ __('web.home.our_services') }}</h3>

                                                                                                <h2 class="section-title-heading cs_fs_48 cs_fs_lg_36 m-0"
                                                                                                    style="color:#18191d">{!! __('web.home.our_services_title') !!}
                                                                                                </h2>

                                                                                            </div>

                                                                                            <div
                                                                                                class="cs_section_heading_right">

                                                                                                <div
                                                                                                    class="cs_section_text m-0"
                                                                                                    style="color:#666">
                                                                                                    <p>{!! __('web.home.our_services_description') !!}</p>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <section
                                                                    class="elementor-section elementor-inner-section elementor-element elementor-element-a56aa36 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                                    data-id="a56aa36" data-element_type="section">
                                                                    <div
                                                                        class="elementor-container elementor-column-gap-default">
                                                                        @foreach($directions as $direction)
                                                                            <div
                                                                                class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-6fab881 elementor-invisible"
                                                                                data-id="6fab881"
                                                                                data-element_type="column"
                                                                                data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:300}">
                                                                                <div
                                                                                    class="elementor-widget-wrap elementor-element-populated">
                                                                                    <div
                                                                                        class="elementor-element elementor-element-f98bff5 elementor-widget elementor-widget-bizmax-services"
                                                                                        data-id="f98bff5"
                                                                                        data-element_type="widget"
                                                                                        data-widget_type="bizmax-services.default">
                                                                                        <div
                                                                                            class="elementor-widget-container">


                                                                                            <div
                                                                                                class="cs_service cs_style_1 cs_pt_25 cs_pl_25 cs_pr_25 cs_pb_15 bg-white cs_transition_4 shadow">

                                                                                                <div
                                                                                                    class="cs_service_iconbox d-flex align-items-center cs_mb_20">

                                                                                                    <div
                                                                                                        class="cs_service_icon d-flex align-items-center justify-content-center cs_rounded_5 cs_mr_15 cs_transition_4 flex-none">
                                                                                                        <img
                                                                                                            decoding="async"
                                                                                                            src="{{ asset("/sliders/$direction->icon") }}"
                                                                                                            alt="service image">

                                                                                                    </div>

                                                                                                    <h2 class="cs_lh_base cs_fs_20 cs_fs_lg_18 m-0">

                                                                                                        <a href="{{ route('contact') }}"
                                                                                                           class="inline-block">{{ $direction->titleH }}</a>

                                                                                                    </h2>

                                                                                                </div>

                                                                                                <div class="cs_mb_24">
                                                                                                    <p>{{ $direction->descriptionH }}</p>
                                                                                                </div>

                                                                                                <div
                                                                                                    class="cs_service_thumb position-relative cs_rounded_5">

                                                                                                    <a href="{{ route('contact') }}"
                                                                                                       class="cs_service_btn d-flex align-items-center justify-content-center rounded-circle position-absolute text-white">

                                                                                                        <svg width="22"
                                                                                                             height="22"
                                                                                                             viewBox="0 0 22 22"
                                                                                                             fill="none"
                                                                                                             xmlns="http://www.w3.org/2000/svg">

                                                                                                            <path
                                                                                                                d="M20.8491 11.347C20.855 11.3381 20.8602 11.3289 20.8656 11.3198C20.8706 11.3114 20.8759 11.3032 20.8805 11.2946C20.8855 11.2853 20.8897 11.2757 20.8942 11.2663C20.8984 11.2573 20.9029 11.2484 20.9067 11.2392C20.9105 11.23 20.9136 11.2206 20.9169 11.2113C20.9205 11.2014 20.9243 11.1916 20.9274 11.1814C20.9302 11.1721 20.9322 11.1626 20.9346 11.1532C20.9372 11.1429 20.9401 11.1327 20.9422 11.1222C20.9444 11.1113 20.9456 11.1003 20.9472 11.0894C20.9485 11.0801 20.9503 11.0711 20.9512 11.0617C20.9532 11.0415 20.9543 11.0213 20.9543 11.001C20.9543 11.0007 20.9543 11.0004 20.9543 11.0001C20.9543 10.9998 20.9543 10.9994 20.9543 10.9991C20.9542 10.9789 20.9532 10.9586 20.9512 10.9384C20.9503 10.929 20.9485 10.92 20.9472 10.9108C20.9456 10.8998 20.9444 10.8888 20.9422 10.8779C20.9401 10.8674 20.9372 10.8572 20.9346 10.8469C20.9322 10.8375 20.9302 10.828 20.9274 10.8187C20.9243 10.8086 20.9205 10.7988 20.9169 10.7889C20.9136 10.7795 20.9105 10.7701 20.9067 10.7609C20.9029 10.7517 20.8984 10.7428 20.8941 10.7338C20.8897 10.7244 20.8855 10.7148 20.8805 10.7055C20.8759 10.6969 20.8706 10.6887 20.8656 10.6803C20.8602 10.6712 20.855 10.662 20.8491 10.6531C20.8428 10.6438 20.8359 10.635 20.8292 10.6261C20.8237 10.6187 20.8186 10.6112 20.8127 10.604C20.7996 10.588 20.7858 10.5727 20.7713 10.5581L15.026 4.81285C14.7819 4.56877 14.3862 4.56877 14.1421 4.81285C13.898 5.05692 13.898 5.45264 14.1421 5.69672L18.8204 10.375L0.88388 10.375C0.53871 10.375 0.258878 10.6548 0.258878 11C0.258878 11.3452 0.53871 11.625 0.88388 11.625L18.8204 11.625L14.1421 16.3033C13.8981 16.5474 13.8981 16.9431 14.1421 17.1872C14.3862 17.4312 14.7819 17.4313 15.026 17.1872L20.7713 11.442C20.7858 11.4274 20.7996 11.4121 20.8127 11.3962C20.8186 11.389 20.8237 11.3814 20.8292 11.374C20.8359 11.3651 20.8428 11.3563 20.8491 11.347Z"
                                                                                                                fill="currentColor"></path>

                                                                                                        </svg>

                                                                                                    </a>

                                                                                                    <div
                                                                                                        class="cs_service_thumb-in position-relative-in background-filled h-100"
                                                                                                        style="background-image:url('{{ asset("/sliders/$direction->photo") }}')"></div>

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </section>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>

                                                <section
                                                    class="elementor-section elementor-inner-section elementor-element elementor-element-73ddd5e elementor-section-boxed elementor-section-height-default elementor-section-height-default animated fadeIn"
                                                    data-id="73ddd5e" data-element_type="section"
                                                    data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div
                                                            class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-96a2609 animated fadeIn"
                                                            data-id="96a2609" data-element_type="column"
                                                            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;}">
                                                            <div
                                                                class="elementor-widget-wrap elementor-element-populated">
                                                                <div
                                                                    class="elementor-element elementor-element-3d32066 elementor-widget elementor-widget-bizmax-section-title"
                                                                    data-id="3d32066" data-element_type="widget"
                                                                    data-widget_type="bizmax-section-title.default">
                                                                    <div class="elementor-widget-container">


                                                                        <div
                                                                            class="cs_section_heading cs_style_1 d-flex align-items-center text-center">

                                                                            <div class="cs_section_heading_in">

                                                                                <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10 wow fadeInLeft"
                                                                                    data-wow-duration="0.8s"
                                                                                    data-wow-delay="0.2s"
                                                                                    style="color:#18191d">{{ __('web.our_teams.title') }}</h3>

                                                                                <h2 class="section-title-heading  cs_fs_48 cs_fs_lg_36 cs_mb_20"
                                                                                    style="color:#18191d">{!!  __('web.our_teams.about') !!}</h2>

                                                                                <div class="cs_section_text m-0"
                                                                                     style="color:#666"></div>

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
                                                            <div
                                                                class="elementor-widget-wrap elementor-element-populated">
                                                                <div
                                                                    class="elementor-element elementor-element-a1b16b9 elementor-widget elementor-widget-bizmax-team-modern"
                                                                    data-id="a1b16b9" data-element_type="widget"
                                                                    data-widget_type="bizmax-team-modern.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="bizmax-teams">
                                                                            <div
                                                                                class="bizmax-clients__grid bizmax-team__grid">
                                                                                <div class="row">
                                                                                    @foreach($employees as $employee)
                                                                                        <div
                                                                                            class="col-lg-4 col-md-6 col-sm-6">

                                                                                            <div
                                                                                                class="cs_team cs_style_1 text-center cs_mt_30 overflow-hidden cs_rounded_50">

                                                                                                <div
                                                                                                    class="cs_team_member position-relativecs_rounded_50">

                                                                                                    <a class="cs_team_link"
                                                                                                       href="#">

                                                                                                        <img
                                                                                                            decoding="async"
                                                                                                            class="w-100 cs_rounded_50"
                                                                                                            src="{{ asset("/employees/$employee->photo") }}"
                                                                                                            alt="{{ $employee->fio }}">

                                                                                                    </a>

                                                                                                    <div
                                                                                                        class="cs_social_btns d-flex flex-wrap cs_column_gap_15 cs_row_gap_15 cs_transition_5 cs_fs_20 cs_fs_lg_18 position-absolute">
                                                                                                        <a href="#"
                                                                                                           class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i
                                                                                                                class="fab fa-facebook-f"></i></a>

                                                                                                        <a href="#"
                                                                                                           class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i
                                                                                                                class="fab fa-twitter"></i></a>

                                                                                                        <a href="#"
                                                                                                           class="d-flex align-items-center justify-content-center cs_height_45 cs_width_45 border-0 text-white rounded-circle"><i
                                                                                                                class="fab fa-dribbble"></i></a>

                                                                                                    </div>

                                                                                                </div>

                                                                                                <div
                                                                                                    class="cs_team_info cs_pt_127 cs_pl_15 cs_pr_15 cs_pb_25 cs_transition_4">

                                                                                                    <a class="cs_team_link"
                                                                                                       href="#">

                                                                                                        <h2 class="text-white m-0 cs_fs_26 cs_mb_3">
                                                                                                            {{ $employee->fio }}</h2>

                                                                                                        @foreach($directions as $direction)
                                                                                                            @if($direction->id == $employee->direction_id)
                                                                                                                <p class="text-white m-0">{{ $direction->titleH }}</p>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                        <p class="text-white m-0">{{ __('form.employees.experience') }}
                                                                                                            : {{ $employee->experience }} {{ __('web.our_teams.year') }}</p>
                                                                                                        <p class="text-white m-0">{{ $employee->aboutH }}</p>

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
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
