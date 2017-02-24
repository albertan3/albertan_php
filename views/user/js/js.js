/* 
 * this is the javascript file albert built to generate a concordance
 */




function binaryTree() { //my little tree

    var rootNode = null;
    var count = 0;

    this.count = function () {
        
        return count;
    }

    this.traverse = function (callback) { // traversal
        var mainRoot = rootNode;

        // Go to first one
        while (mainRoot.left != null) {
            current = mainRoot.left;
            current.back = mainRoot;
            mainRoot = current;
        }

        while (mainRoot != null) { //check null
             
                callback(mainRoot);
                if (mainRoot.right != null) {
                    mainRoot.right.back = mainRoot.back;
                    mainRoot = mainRoot.right;

                    while (mainRoot.left != null) {
                        current = mainRoot.left;
                        current.back = mainRoot;
                        mainRoot = current;
                    }// while 
                } else {
                    current = mainRoot.back;
                    mainRoot.back = null;
                    mainRoot = current;
                } //right?
            
        }
    } //end traverse

    this.addNode = function(value, callback) { //adding the node 
        
        if (rootNode == null) {
            rootNode = new Node(value);
            callback(rootNode);
            count += 1;
        } else {
            var parent = rootNode;
            while (true) { //maybe change to switch to make cleaner 
                if (parent.value == value) {
                    callback(parent);
                    parent.count += 1;
                    break;
                } else if (parent.value > value) {
                    if (parent.left == null) {
                        parent.left = new Node(value);
                        callback(parent.left);
                        count += 1;
                        break;
                    } else {
                        parent = parent.left;
                    }
                } else {
                    if (parent.right == null) {
                        parent.right = new Node(value);
                        callback(parent.right);
                        count += 1;
                        break;
                    } else {
                        parent = parent.right;
                    }
                }
            } //while loop end
        }//end else 
    }// add node 
}  //end the tree 

function Node(word) { //create a node
    
    this.value = word;
    this.count = 1;
    this.left = null;
    this.right = null;
    
    this.context = {};
}// node



function sentenceToNode(node, sentence) {
    if(node.context.sentences == null ) {
        node.context.sentences = [sentence];
    } else {
        node.context.sentences.push(sentence);
    }
} //add

function getLabel(index) {
    
    var result = "";
    var len = Math.floor(index / 26) + 1;
    var char = String.fromCharCode(97 + index % 26);
    return Array(len + 1).join(char);
    
} //end getinglabel 

function getConcordance(text) {
    var results = [];
    var bTree = new binaryTree();

    // scan text
    var sentenceCount = 1;
    var word = "";
    for (var index = 0; index < text.length; index += 1) {
        
        var char = text.substr(index, 1);

        switch (char) { //switch between cases to see if it is a word or not 
            case ".":  //if
                
                if (text.substr(index + 1, 1) == "") {
                    // end of file
                    if (word != "") {
                        bTree.addNode(word, function (node) { sentenceToNode(node, sentenceCount); });
                        word = "";
                    }
                } else if (text.substr(index + 1, 1) == " ") {
                    
                    if (text.substr(index + 2, 1) >= "a" && text.substr(index + 2, 1) <= "z") {
                        // Consider dots followed by space and low case chars as abbriviations "i.e. an"
                        if (word != "") {
                            word += ".";
                            bTree.addNode(word, function (node) { sentenceToNode(node, sentenceCount); });
                            word = "";
                        }
                    } else {
                        //  dots followed by space and any other chars as sentence  ender 
                        if (word != "") {
                            bTree.addNode(word, function (node) { sentenceToNode(node, sentenceCount); });
                            word = "";
                        }
                        
                        sentenceCount += 1;
                        
                    }
                } else {
                    
                    // period followed by any other char right away with no space as part of word
                    word += ".";
                }
                break;
            
            case " ": //space
                if (word !=="") {
                    bTree.addNode(word, function (node) { sentenceToNode(node, sentenceCount); });
                    word = "";
                }
                break;
            case "?": //question mark case
            
            case "!": //excamation mark
                
                if (word !=="") {
                    bTree.addNode(word, function (node) { sentenceToNode(node, sentenceCount); });
                    word = "";
                }
                sentenceCount += 1;
                break;
             case ",": //,
            
            case ":": //:
            default:
                word += char.toLowerCase();
                break;
        }
    }

    // print out words concordance into regular array
    var wherenow = 0;
    var eachlabelLength = getLabel(bTree.count()).length;
    bTree.traverse(function (node) {
        var marker = getLabel(wherenow++);
        
        var markerSpace = Array(eachlabelLength + 3 - marker.length).join(" ");
        var wordSpace = Array(20 - node.value.length).join(" ");
        results.push(marker + "." + markerSpace + node.value + wordSpace + "{" + node.count + ":" + node.context.sentences.toString() + "}");
    });

    return results;
} //end Concordance

//client side show on the browser
            
            $(document).ready(function () {
                 getResults();
           
            }); //doc ready function
            
            
            $( "#your_typed_text" ).keydown(function() {
                
                    getResults();
                    
                     var text = $("#your_typed_text").val();
                    
            });  //keypress
            
            
             function getResults(){
                
                var text = $("#your_typed_text").val();
            
            if(text ==null){
             //  alert("type in text box."); 
                $(".your_typed_text").val("Given an arbitrary text document written in English, write a program that will generate a concordance, i.e. an alphabetical list of all word occurrences, labeled with word frequencies. Bonus: label each word with the sentence numbers in which each occurrence appeared.");
                
                var text = $(".your_typed_text").val();
            }//if null
            
            

                    var results = getConcordance(text);

                    var output = "";
                    for (var index = 0; index < results.length; index += 1) {
                        output += "<p>" + results[index]+"</p>";

                    }//forend
                    
                       $("#show_results").replaceWith('<div id ="show_results" class="btn btn-primary" style="display: block; margin: auto; margin-top:20px;">'+output+'</div>');
                        
                console.log("change"+output );
            }//get results
            
//show the video of what this code is about 

