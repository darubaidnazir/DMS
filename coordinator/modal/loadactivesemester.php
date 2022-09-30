<section id="loadactivesemester">


</section>




<script>
$(document).on("click", "#assignsubjectbox", function() {
    var semesterid = $(this).data("id");

    var coordinate = $("#coordinator_hidden").val().trim();
    assignsubjectbox(semesterid, coordinate);

});


function assignsubjectbox(semesterid, coordinator) {
    $.ajax({
        url: "../../../DMS/coordinator/loadData/loadsemestersubject.php",
        type: "POST",
        data: {
            get_Semesterid: semesterid,
            get_Coordinatorid: coordinator,
            connection: true
        },
        success: function(data) {

            $(".modal-body-active").html(data);


        }


    });


}
</script>