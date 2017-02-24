
        <div id="show_video" style="width:70%;  background: blue; display: block;margin: auto; ">
            <video loop autoplay poster="img/latest.png" class="fullscreen-bg__video" style="display:block;margin:auto;">
               <source src="views/user/video/compressed.mp4" type="video/mpeg">
                <source src="views/user/video/bridgewatercode.webm" type="video/webm" >
                
                <object type="application/x-shockwave-flash" data="player.swf?file=video/compressed.mp4">
	<param name="movie" value="player.swf?file=video/compressed.mp4">
	<a href="video/compressed.mp4">Your browser is too old...Download the video resume here</a>
            </object>
                
            </video>
            
        </div>
        <button id="mute_button" type="button" onclick="muteback();" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-volume-off" aria-hidden="true"></span> mute
          </button>
        <div class ="content" style="display: block; margin: auto;">
            
           
            <textarea rows="4" cols="50" id="your_typed_text" style="display: block;margin: auto; margin-top:20px;" >
Given an arbitrary text document written in English, write a program that will generate a concordance, i.e. an alphabetical list of all word occurrences, labeled with word frequencies. Bonus: label each word with the sentence numbers in which each occurrence appeared.
            </textarea>
            
            <button class="btn btn-danger" onclick="rungetResults();" style=" display: block;margin: auto; margin-top:20px;" > click to generate concordance</button>
            
       
        <p>output: alphabetical list of all word occurrences, labeled with word frequencies + label each word with the sentence numbers </p>
        <div id ="show_results" class="btn btn-primary" style="display: block; margin: auto;">
            
        </div>
        
    </div> <!--end content-->     
    
    <script>
        
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


 $( "#your_typed_text" ).keypress(function() {
                var text = $("#your_typed_text").val();
                
                    getResults();
                    
                     
                     
                     //alert(text);
                    
            });  //keypress
            
            function rungetResults(){
                
                var text = $("#your_typed_text").val();
                
                    getResults();
                    
                     
                
            }
    </script>