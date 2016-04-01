window.onload = function() {
    setInterval(GetData,30);
};
var box = 0;
var xPos = 0;
var yPos = 0;
var menu1=0;
var menu2=0;
var menu3=0;
var yRangeMin = 1;//document.currentScript.getAttribute('yMin'); 
var yRangeMax = 120;//document.currentScript.getAttribute('yMax');
// console.log(yRangeMax);

function GetData() {
	$.ajax({
    	type: "GET",
    	url: 'http://localhost:9000'
    })
    .done(function(msg) {
    	//console.log(msg);
    	var n = msg.length;
        //console.dir(n);
        if ( n > 10 ){
            //console.dir(data);
            var Pos = msg.match(/[^,]+/g);
            //xPos = Math.abs(parseFloat(Pos[0])*100);
            //yPos = Math.abs(parseFloat(Pos[1])*100);
            xPos = parseFloat(Pos[0])*10;
            yPos = parseFloat(Pos[1])*10;
            // console.log(yPos);
            //console.log("hello");
            //console.dir(Pos[0]);
            //console.dir(Pos[1]);
        }
    });
}

var images = {};
images.help = new Image();
images.play = new Image();

images.help.src = "images/help.png";
images.play.src = "images/play_button.png";

// init function when the DOM is ready
$(function(){   
    // get the references of the audio element.
    audiogame.buttonActiveSound = document.getElementById("buttonactive");
    
});

setInterval(gameloop, 30);

// drawBackground();

function gameloop()
{
    var menu = document.getElementById("menu-canvas-back");
    var ctx = menu.getContext('2d');
    var center = menu.height/2;
    var yPlayAreaMin = 0;
    var yPlayAreaMax = menu.height;

    // CONVERSION TO PLOT VALUES
    //var yNormal = (yPos - yRangeMin)/(yRangeMax-yRangeMin);
    var yNormal = (yPos - yRangeMin)/(yRangeMax - yRangeMin);
    //var yPlot = (yNormal*(yPlayAreaMax - yPlayAreaMin) + yPlayAreaMin);
    var yPlot = (yNormal*(yPlayAreaMax - yPlayAreaMin)*-1 + yPlayAreaMin);
    var yVal=0;

    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

    // set the line style
    ctx.lineWidth = 3;
    ctx.strokeStyle = "#000";
    
    var width = menu.width;
    var height = menu.height;
    var center = height/2;
    
    // //Draw the rectangle to define the canvas limits
    // ctx.beginPath();
    // ctx.rect(0, 0, width, menu.height);
    // ctx.stroke();

    //draw the icons
    var play_icon = document.getElementById("play");
    var help_icon = document.getElementById("help");
    ctx.drawImage(images.play,0,menu.height*1/8,images.play.width,images.play.height);
    ctx.drawImage(images.help,0,menu.height*5/8,images.help.width,images.help.height);

    ctx.font = "35px Verdana";
    ctx.fillStyle = "black";
    //ctx.fillText("Settings", 100, 15+height*1/4);
    ctx.fillText("Play Game", 100, 15+height*1/4);
    ctx.fillText("Help", 100, 15+height*3/4);

    var gSect=(yPlayAreaMax-yPlayAreaMin)/2;
    var box = 0;

    if ( yPlot <= gSect+yPlayAreaMin) {
        box = 0;
        addEventListener("click",function(){
            window.location.replace("http://localhost/audio-game/index.php");
        });
        //menu1++;
    } else {
        box = 1;
        addEventListener("click",function(){
            window.location.replace("http://localhost/audio-game/patient-help.php");
        });
        //menu2++;
    };
    // console.log(yVal);
    
    
    ctx.beginPath();
    ctx.strokeStyle = '#7a9461';
    ctx.rect(0, gSect*box,width,gSect);
    ctx.stroke();
 
    ctx.beginPath();
    ctx.fillStyle = '#7a9461';
    ctx.arc(155, yPlot, 10, 0, 2 * Math.PI);
    ctx.fill();

    





    // if (menu1 > ) {
    //     console.log("menu 1");
    // } else if (menu2 >6 ) {
    //     console.log("menu 2");
    // } else {
    //     console.log("menu 3");
    // }
};