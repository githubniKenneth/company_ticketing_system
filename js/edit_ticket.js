$(document).ready(function() {
    $('.editTicket').click(function(){
        var ticketId = $(this).data('id');
        // alert(ticketId);
        $.ajax({
            url: 'action_button/edit-ticket.php',
            type: 'post',
            data: {ticketId: ticketId},
            success: function(response){
                $('.target-modal-body').html(response);
                $('#editTicketModal').modal('show');
            }
        });
    });
});