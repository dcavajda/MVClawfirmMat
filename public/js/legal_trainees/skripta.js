$( "#uvjet" ).autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "/Legal_trainees/TraziLegal_trainees",
        data: {
          uvjet: request.term,
          legal_case: legal_case
        },
        success: function( data ) {
          response( data );
        }
      } );
    },
    minLength: 1,
    select: function( event, ui ) {
      spremi(legal_case,ui.item);
    }
  } ).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append( "<div>" + item.firstname + " " + item.lastname + "</div>" )
      .appendTo( ul );
  };



  

function spremi(legal_case,legal_trainee){
  $.ajax( {
    url: "/legal_cases/addLegalTrainee",
    data: {
      legal_case: legal_case,
      legal_trainee: legal_trainee.legal_trainee_id
    },
    success: function( data ) {

      if(data=="OK"){
          $("#tijelo").append('<tr> ' +
          '<td> ' + legal_trainee.firstname + ' ' + legal_trainee.lastname +
          '' +
          
          '</td> ' +
          '' +
          '<td><a href="#" class="legal_trainee"  ' +
          'id="p_'+ legal_trainee.legal_trainee_id  +'"> ' +
              '<i class="fas fa-trash fa-2x" style="color: red"></i> ' +
              '</a></td> ' +
          '</tr>');
      }

      
      definirajBrisanje();

    }
  });
}


function definirajBrisanje(){


$(".legal_trainee").click(function(){
  var element = $(this);
  var legal_trainee = element.attr("id").split("_")[1];


  $.ajax( {
    url: "/legal_cases/delLegalTreainee",
    data: {
      legal_case: legal_case,
      legal_trainee: legal_trainee
    },
    success: function( data ) {
      if(data=="OK"){
        element.parent().parent().remove();
      }
    }
  });

  return false;
});

}


definirajBrisanje();