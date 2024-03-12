<?php

/*
Image Guidelines
These are the image areas that should be kept in mind when editing.
The rest of the images live in image galleries or the page in a reduced
size that is taken care of in the backend!
*/

add_image_size('hero', 1920, 9999);
add_image_size('medium_large', 700, 1000);

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}


/*
The function below adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/
function ocupop_display_custom_image_sizes($sizes)
{
    global $_wp_additional_image_sizes;
    if (empty($_wp_additional_image_sizes)) {
        return false;
    }
    foreach ($_wp_additional_image_sizes as $id => $data) {
        if (!isset($sizes[$id])) {
            $sizes[$id] = ucfirst(str_replace('-', ' ', $id));
        }
    }
    return $sizes;
}
add_filter('image_size_names_choose', 'ocupop_display_custom_image_sizes');



// Adjust the maximum size of full-size images (to save space on hosting server and reduce size of migrations)
add_filter('big_image_size_threshold', 'increase_big_image_threshold', 10, 4);
function increase_big_image_threshold($threshold, $imagesize, $file, $attachment_id)
{
    return 1920; // Default 2560.
}




/**
*
 * FOR DEVELOPMENT
 * Prints all image sizes to the screen so we can see what we have.
*/

// add_action('loop_start','doShowThumbs',999);
// function doShowThumbs(){
//     global $_wp_additional_image_sizes;
//     $default_image_sizes = get_intermediate_image_sizes();
//     foreach ( $default_image_sizes as $size ) {
//         $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
//         $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
//         $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
//     }
//     if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
//         $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
//     }
//     print'<pre>';print_r($image_sizes);print'</pre>';
// }
