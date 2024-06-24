$(document).ready(function(){
    $("select.company").change(function(){
        var selectedCompany = $(".company option:selected").val();
        // alert('sdaf');
        $.ajax({
            type: "POST",
            url: "action_button/department-select.php",
            data: { company : selectedCompany } 
        }).done(function(data){
            $("#response").html(data);
        });
    });
});