/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function muteback(){
    
    $("video").prop('muted', true); //mute
    
    $("#mute_button").replaceWith('<button id="mute_button" type="button" onclick="unmuteback();" class="btn btn-default btn-lg">'
  +'<span class="glyphicon glyphicon-volume-up" aria-hidden="true">'
  +'</span> unmute</button>');
    
}

function unmuteback(){
    
    $("video").prop('muted', false); //mute
    
    
     $("#mute_button").replaceWith('<button id="mute_button" type="button" onclick="muteback();" class="btn btn-default btn-lg">'
  +'<span class="glyphicon glyphicon-volume-off" aria-hidden="true">'
  +'</span> mute</button>');
    
}