<div class="vc_row wpb_row vc_row-fluid shape_divider_top-none shape_divider_bottom-none sc_layouts_row scheme_dark puzzle_banner">
    <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div id="sc_content_1925973386" class="sc_content color_style_default sc_content_default sc_content_width_1_1 sc_float_center">
                    <div class="sc_content_container">
                        <div class="sc_layouts_item">
                            <div id="sc_layouts_title_850083845" class="sc_layouts_title with_content without_image without_tint">
                                <div class="sc_layouts_title_content">
                                    <div class="sc_layouts_title_title">
                                        <h1 class="sc_layouts_title_caption">{{ $title }}</h1>
                                        <h6 class="sc_layouts_title_caption">
                                            @if(isset($dateTimeCompleted) && $dateTimeCompleted)
                                                Completed on {{ $dateTimeCompleted }} ({{ $numberOfAttempt }} {{ Str::plural('attempt', $numberOfAttempt) }})
                                            @endif
                                        </h6>
                                    </div>
                                </div><!-- .sc_layouts_title_content -->
                            </div><!-- /.sc_layouts_title -->
                        </div>
                    </div>
                </div><!-- /.sc_content -->
            </div>
        </div>
    </div>
</div>
