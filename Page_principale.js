$(document).ready(function(){
    $("#hello").show();
    // $(".ajouter-produit").hide();
    // $(".liste-produits").hide();
   

    $(".ajouter").click(function () {
    $(this).css({"background-color":"#1E1E1E"});
    $(this).css({"color":"white"});

    $(".supprimer").css({"background-color":"#D9D9D9"});
    $(".supprimer").css({"color":"black"});
    
    $("#hello").hide();
    $(".ajouter-produit").show();
    $(".liste-produits").hide();
    });


    $(".supprimer").click(function () {
        $(this).css({"background-color":"#1E1E1E"});
        $(this).css({"color":"white"});
    
        $(".ajouter").css({"background-color":"#D9D9D9"});
        $(".ajouter").css({"color":"black"});

        $("#hello").hide();
        $(".ajouter-produit").hide();
        $(".liste-produits").show();
        });

        $(".click-message").click(function () {
            $(".message").hide();
        });
    });