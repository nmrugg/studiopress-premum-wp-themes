<?php
function lexicon_post_date() {
	if(is_page()) return;
	
	echo '<div class="date">'."\n";
		echo "\t".'<div class="month">'.get_the_time('M').'</div>'."\n";
		echo "\t".'<div class="day">'.get_the_time('d').'</div>'."\n";		
	echo '</div>'."\n";			
}

function lexicon_post_info() {
	if(is_page()) return; // don't do post-info on pages
	
	echo '<p class="byline">'."\n\t\t\t\t";
	
	$post_info = __('By', 'genesis') . ' [post_author_posts_link after=" |"] [post_categories sep="," before="" after=""] [post_edit]';
	echo apply_filters('genesis_post_info', $post_info);
		
	echo "\n\t\t\t\t".'</p>'."\n\n";	
	
	echo '<p class="commentlink">'."\n\t\t\t\t";
	
	$post_info = '[post_comments]';
	echo apply_filters('genesis_post_info', $post_info);
		
	echo "\n\t\t\t\t".'</p>'."\n\n";		
}
?>