/**
 * Created by Vladislav Sokolov on 06/03/2016.
 */

$(document).ready(function() {

    $.ajax({
        type: "GET",
        datatype: "xml",
        url: "http://localhost:8080/PTUT/notifications",
        success: function(xml){
            /*var notif = $(xml).find('notification').text();
            $("#notifWindow").html(notif);*/
            alert(xml);
        },
        error:function(){
            alert("failure");
        }
    });
});