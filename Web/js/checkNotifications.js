/**
 * Created by Vladislav Sokolov on 06/03/2016.
 */

$(document).ready(function() {

    $.ajax({
        type: "GET",
        datatype: "xml",
        url: "http://localhost:8080/PTUT/notifications",
        success: function(xml){


            $(xml).find('notification').each(function(){


                var message = $(this).text();
                var i=0;

                var conteneur = $("<div></div>");
                conteneur.addClass("container");
                conteneur.css('margin-top','15px');

                var row = $("<div></div>");
                row.addClass("row");

                var contenu = $("<div></div>").text($(this).text());
                contenu.addClass("chip");
                contenu.attr("id","contenu"+i);

                var close = $("<i></i>").text('close');
                close.addClass("material-icons");

                conteneur.append(row);
                row.append(contenu);
                contenu.append(close);

                $("#separateur").after( conteneur );

                i++;





            });







        },
        error:function(){
            alert("failure");
        }
    });
});