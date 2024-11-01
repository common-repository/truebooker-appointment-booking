function delete_confirm() {
    if(jQuery('.checkbox:checked').length > 0){
        var result = confirm('Are you sure you want to delete ?');
        if (result){
            return true;
        }
        else {
            return false;
        }
    }
}
function status_confirm() {
    if(jQuery('.checkbox:checked').length > 0){
        var result = confirm('Are you sure want to change the booking status ?');
        if (result){
            return true;
        }
        else {
            return false;
        }
    }
}
jQuery(document).ready(function(){
    jQuery('#select_all').on('click',function(){
        jQuery("#delete").addClass("removeall");
        if(this.checked){
            jQuery('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             jQuery('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    jQuery('.checkbox').on('click',function(){
        if(jQuery('.checkbox:checked').length == jQuery('.checkbox').length){
            jQuery('#select_all').prop('checked',true);
        }else{
            jQuery('#select_all').prop('checked',false);
        }
    });


        jQuery('#edit').on('click',function(e){
            e.preventDefault();
            jQuery('#update_form').modal('toggle');
    
        });

});
setTimeout(function tba_user_insert_data() {
      jQuery( ".tba-popconfirm" ).hide();
    }, 4000);

jQuery(document).ready(function () {
        jQuery('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '+1d',
            defaultDate: -1,
            minDate:'0',
            beforeShowDay: function(date) {
        var day = date.getDay();
        return [(day != 0), ''];
    }
        });

    jQuery("#timepicker").timepicker({
    timeFormat: "h:mm", 
    interval: 30, 
    minTime: "01",
    maxTime: "23:55pm", 
    startTime: "01:00", 
    dynamic: true, 
    dropdown: true, 
    scrollbar: false 
  });


jQuery(".truebooker-form #truebooker_user_phone").intlTelInput({
    initialCountry: "in",
    separateDialCode: true
});

	jQuery('.tab-content section').hide();
	jQuery('.tab-content section:first').show();
	jQuery('#tba-tab li:first').addClass('tab-active');

	// Change tab class and display content
	jQuery('#tba-tab .nav-item a').on('click', function(event){
	  event.preventDefault();
	  jQuery('#tba-tab li').removeClass('tab-active');
	  jQuery(this).parent().addClass('tab-active');
	  jQuery('.tab-content section').hide();
	  jQuery(jQuery(this).attr('href')).show();
	});


 });