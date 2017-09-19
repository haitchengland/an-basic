
<h3>This is template file for flexable content test_1</h3>
<?php

the_sub_field('test_1_sub');
echo '<br>';
the_sub_field('test_2_sub');
echo '<hr><br>';

?><h3>This is testing vaibles and include instead of load template</h3>
<?php

echo $test1 . '<br>';
echo $test2 . '<br>';

?>