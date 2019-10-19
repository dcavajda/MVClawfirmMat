$( "#uvjet" ).autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "/legal_trainees/TraziLegal_trainee",
        data: {
          uvjet: request.term,
          Legal_trainee: Legal_trainee
        },
        success: function( data ) {
          response( data );
        }
      } );
    },
    minLength: 1,
    select: function( event, ui ) {
        console.log( "Idem na server s: " + legal_trainee + " i " + ui.item.legal_trainee_id );
    }
  } ).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append( "<div>" + item.firstname + " " + item.lastname + "</div>" )
      .appendTo( ul );
  };
