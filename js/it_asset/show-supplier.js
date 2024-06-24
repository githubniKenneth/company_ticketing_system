// JS TO SHOW THE LIST OF SUPPLIER AFTER CLICKING THE SHOW BTN INSIDE THE ADD SUPPLIER MODAL
$(document).ready(function() {
    $('.show_supplier').click(function(){
        $.ajax({
            url: 'action_button/show-supplier.php',
            success: function(response){
                $('.showSupplier_body').html(response);
                $("#showSupplier").modal('show');
            }
        });
    });
});
