
$(document).ready(function () {
    var myArray = new Array();

    myArray[0] = "addsettingsection";
    myArray[1] = "addbatchsection";
    myArray[2] = "addstudentrecordsection";
    myArray[3] = "addpdfsection";

    $(".menu_button").click(function () {
        $("#maindashboardsection").css("display", "none");
        var getId = this.id;

        if (getId == "addbatch") {
            getId = "addbatchsection";


        } else if (getId == "addsetting") {
            getId = "addsettingsection";
        }
        else if (getId == "addstudentrecord") {
            getId = "addstudentrecordsection";
        } else if (getId == "addpdfsectionbutton") {
            getId = "addpdfsection";
        }


        for (var i = 0; i < myArray.length; i++) {
            if (myArray[i] == getId) {
                continue;
            } else {
                $("#" + myArray[i]).css("display", "none");
            }
        }
        $("#" + getId).css("display", "block");
    });
    $(".maindashbutton").click(function () {

        for (var i = 0; i < myArray.length; i++) {
            $("#" + myArray[i]).css("display", "none");
        }
        $("#maindashboardsection").css("display", "grid");
    });

});