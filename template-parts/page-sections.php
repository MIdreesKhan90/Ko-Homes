<?php
// Page Sections
if (have_rows('sections')) :
    while (have_rows('sections')) : the_row();
        // Icon Box Section
        if (get_row_layout() == 'icon_box_section') :
            get_template_part('template-parts/icon-box', 'section');
        // Background Side Image Section
        elseif (get_row_layout() == 'bg_side_image_section') :
            get_template_part('template-parts/bg-side-image', 'section');
        // Featured Property Section
        elseif (get_row_layout() == 'featured_property_section') :
            get_template_part('template-parts/featured-property', 'section');
        // Image Content Section
        elseif (get_row_layout() == 'image_content_section') :
            get_template_part('template-parts/image-content', 'section');
        // Table Content Section
        elseif (get_row_layout() == 'table_content_section') :
            get_template_part('template-parts/table-content', 'section');
        // Two Column Content Section
        elseif (get_row_layout() == 'two_column_content_section') :
            get_template_part('template-parts/two-column-content', 'section');
        // Accordion Section
        elseif (get_row_layout() == 'accordion_section') :
            get_template_part('template-parts/accordion', 'section');
        // Connect Section
        elseif (get_row_layout() == 'connect_section') :
            get_template_part('template-parts/connect', 'section');
        // Press Release Section
        elseif (get_row_layout() == 'press_release_section') :
            get_template_part('template-parts/press-release', 'section');
        // Members Section
        elseif (get_row_layout() == 'members_section') :
            get_template_part('template-parts/members', 'section');

        // Image Content section - Repeater
        elseif (get_row_layout() == 'image_content_section_multiple') :
            get_template_part('template-parts/image-content-multiple', 'section');
        // Full Width Content section - Repeater
        elseif (get_row_layout() == 'full_width_content_section') :
            get_template_part('template-parts/full-width-content', 'section');
        endif;

        // End loop.
    endwhile;
endif;

?>