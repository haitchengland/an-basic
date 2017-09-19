jQuery(document).ready(function($){
  synchronize_child_and_parent_category($);
});
 

 // makes adding a child checkbox also add there parents checkbox. Used in the admin section for selecting make and model
function synchronize_child_and_parent_category($) {
  $('#vehical_makes_and_modelschecklist').find('input').each(function(index, input) {
    $(input).bind('change', function() {
      var checkbox = $(this);
      var is_checked = $(checkbox).is(':checked');
      if(is_checked) {
        $(checkbox).parents('li').children('label').children('input').attr('checked', 'checked');
      } else {
        $(checkbox).parentsUntil('ul').find('input').removeAttr('checked');
      }
    });
  });
}