$( "#uvjet" ).autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "/Legal_trainee/TraziLegal_trainees",
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
        console.log( "Idem na server s: " + legal_case + " i " + ui.item.legal_case_id );
    }
  } ).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append( "<div>" + item.firstname + " " + item.lastname + "</div>" )
      .appendTo( ul );
  };
