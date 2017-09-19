<h1>TESTING ACF</h1>

<?php

//echo '<pre>';
//var_dump($group);
//echo '</pre>';

function h_acf($field) {
	echo '</pre>';
	echo '<br><strong>' . $field . ':</strong> ' . print_r(get_field($field),true);
}

function h_acf_sub($field) {
	echo '</pre>';
	echo '<br><strong>' . $field . ':</strong> ' . print_r(get_sub_field($field),true);
}

function h_acf_obj($field, $name) {
	echo '</pre>';
	echo '<br><strong>' . $field . ':</strong> ' . print_r(get_field($field)->$name,true);
}

function h_arr($field, $name) {
	echo '</pre>';
	echo '<br><strong>' . $name . ':</strong> ' . $field[$name];
}

echo '<h2>Test Normal</h2>';
h_acf('text_1');
h_acf('colour_1');
h_acf('link_picker_1');
h_acf_obj('post_object_1', 'post_name');
echo '<hr style="border-top: 2px solid #900a0a;">';


echo '<h2>Test Group</h2>';
		
$group = get_field('group');	

if( $group ): ?>
<?php
	h_arr($group, 'group_text');
	h_arr($group, 'group_img');
	//h_arr($group, 'group_relationship';

	echo '<pre>';
	var_dump($group['group_relationship'][0]->post_title);
	echo '</pre>';

	echo '<pre>';
	var_dump($group['group_repeater']);
	echo '</pre>';


	/*if( have_rows($group['group_repeater']) ):
	    while ( have_rows('group_repeater') ) : the_row();
	        h_acf_sub('text_1');
	        h_acf_sub('text_2');
	    endwhile;
	else :
	    // no rows found
	endif;*/
endif;

// if you need to get to a repeatable of flexible within a group you have to loop
if( have_rows('group') ): 

	while( have_rows('group') ): the_row(); 
		
		if( have_rows('group_repeater' ) ):
		    while ( have_rows('group_repeater') ) : the_row();
		        h_acf_sub('text_1');
		        h_acf_sub('text_2');
		    endwhile;
		else :
		    // no rows found
		endif;

	endwhile; 
endif;


echo '<hr style="border-top: 2px solid #900a0a;">';

?>

<h1>All Post Meta</h1>

<?php $getPostCustom=get_post_custom(); // Get all the data ?>

<?php
    foreach($getPostCustom as $name=>$value) {

        echo "<strong>".$name."</strong>"."  =>  ";

        foreach($value as $nameAr=>$valueAr) {
                echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $nameAr."  =>  ";
                echo var_dump($valueAr);
        }

        echo "<br /><br />";

    }
?>
