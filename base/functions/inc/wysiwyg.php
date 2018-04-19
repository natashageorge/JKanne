<?php

// Add container div for embed
function embed_container( $html ) {
    return '<div class="embed-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'embed_container', 10, 3 );
add_filter( 'video_embed_html', 'embed_container' );
