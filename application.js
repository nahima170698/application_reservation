$(document).ready(function(){
  
    $('#plus').click(function(e){
        e.preventDefault();
      //https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Objets_globaux/parseInt
        var nbPlusMoins = parseInt($('#nbPersonnes').val());
  
        if (nbPlusMoins <=19) {
            $('#nbPersonnes').val(nbPlusMoins + 1);
            $("#moins").removeClass("stop");
        } else {
            $('#nbPersonnes').val(20);
            $("#plus").addClass("stop");
        }
    });
    
    $("#moins").addClass("stop");
    
    $("#moins").click(function(e) {
        e.preventDefault();
        var nbPlusMoins = parseInt($('#nbPersonnes').val());
  
        if (nbPlusMoins <= 3) {
            $('#nbPersonnes').val(2);
            $("#moins").addClass("stop");
      } else {
        $('#nbPersonnes').val(nbPlusMoins - 1);
        $("#plus").removeClass("stop");
        }
    });
  
  }); 
  
  
  Resources