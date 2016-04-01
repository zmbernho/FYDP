window.onload = function() {
    setInterval(GetData,30);
};
var clickOne = true;
var xPos = 0;
var yPos = 0;
var yRangeMin = 1;//document.currentScript.getAttribute('yMin'); 
var yRangeMax = 80;//document.currentScript.getAttribute('yMax');
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
            //console.log(yPos);
            //console.log("hello");
            //console.dir(Pos[0]);
            //console.dir(Pos[1]);
        }
    });
}

function MusicNote(time,line){
	this.time = time;
	this.line = line;
}

function Dot(distance, line) {
	this.distance = distance;
	this.line = line;
	this.missed = false;
}


// a global object variable to store all game scope variable.
var audiogame = {};

// toggle the game between play mode and record mode.
audiogame.isRecordMode = false;

// an array to store all music notes data.
audiogame.musicNotes = [];

audiogame.leveldata = "12.0000,5;13.5000,1;15.0000,2;15.7500,3;16.1250,2;16.5000,2;17.2500,1;18.0000,5;19.5000,2;21.0000,3;24.0000,5;25.5000,3;27.0000,4;27.7500,5;28.1250,4;28.5000,4;29.2500,3;30.0000,4;30.7500,5;31.1250,5;31.5000,4;32.2500,4;33.0000,5;36.0000,5;37.5000,1;39.0000,2;39.7500,3;40.1250,2;40.5000,2;41.2500,1;42.0000,5;43.5000,2;45.0000,3;48.0000,5;49.5000,3;51.0000,4;51.7500,5;52.1250,4;52.5000,4;53.2500,3;54.0000,4;54.7500,5;55.1250,5;55.5000,4;56.2500,4;57.0000,5;59.2500,3;60.0000,4;60.3750,3;60.7500,4;61.1250,3;61.5000,4;61.8750,3;62.2500,4;62.6250,3;63.0000,3;63.3750,3;63.7500,3;64.1250,3;64.5000,3;64.8750,3;65.2500,3;65.6250,3;66.0000,2;67.5000,2;69.0000,2;71.2500,3;72.1875,4;72.5625,3;72.9375,4;73.3125,3;73.6875,4;74.0625,3;74.4375,4;74.8125,3;75.0000,3;75.3750,3;75.7500,3;76.1250,3;76.5000,3;76.8750,3;77.2500,3;77.6250,3;78.0000,2;78.7500,2;79.5000,1;80.2500,4;81.0000,5;82.5000,1;84.0000,2;84.7500,3;85.1250,2;85.5000,2;86.2500,1;87.0000,5;88.5000,2;90.0000,3;93.0000,5;94.5000,3;96.0000,4;96.7500,5;97.1250,4;97.5000,4;98.2500,3;99.0000,4;99.7500,5;100.1250,5;100.5000,4;101.2500,4;102.0000,5;105.0000,5;106.5000,1;108.0000,2;108.7500,3;109.1250,2;109.5000,2;110.2500,1;111.0000,5;112.5000,2;114.0000,3;117.0000,5;118.5000,3;120.0000,4;120.7500,5;121.1250,4;121.5000,4;122.2500,3;123.0000,4;123.7500,5;124.1250,5;124.5000,4;125.2500,4;126.0000,5;128.2500,5;129.7500,1;131.2500,2;132.0000,3;132.3750,2;132.7500,2;133.5000,1;134.2500,5;135.7500,2;137.2500,3;140.2500,5;141.7500,3;143.2500,4;144.0000,5;144.3750,4;144.7500,4;145.5000,3;146.2500,4;147.0000,5;147.3750,5;147.7500,4;148.5000,4;149.2500,5;151.5000,3;152.2500,4;152.6250,3;153.0000,4;153.3750,3;153.7500,4;154.1250,3;154.5000,4;154.8750,3;155.2500,3;155.6250,3;156.0000,3;156.3750,3;158.2500,3;159.0000,3;159.7500,2;160.5000,2;161.2500,1;";

// the visual dots drawn on the canvas.
audiogame.dots = [];
audiogame.startingTime = 0;

// reference of the dot image
audiogame.dotImage = new Image();
audiogame.totalDotsCount = 0;
audiogame.totalSuccessCount = 0;

// storing the success count of last 5 results.
audiogame.successCount = 5;
audiogame.missedCount =0;
//Points initialized at 0
audiogame.points=0;

function setupLevelData()
{
	var notes = audiogame.leveldata.split(";");
	
	// store the total number of dots
	audiogame.totalDotsCount = notes.length;
	
	for(var i in notes)
	{
		var note = notes[i].split(",");
		var time = parseFloat(note[0]);
		var line = parseInt(note[1]);
		var musicNote = new MusicNote(time,line);
		audiogame.musicNotes.push(musicNote);	
	}
}

// init function when the DOM is ready
$(function(){	
	// get the references of the audio element.
	audiogame.melody = document.getElementById("melody");
	$(audiogame.melody).bind('ended', onMelodyEnded);
	audiogame.base = document.getElementById("base");
	audiogame.buttonOverSound = document.getElementById("buttonover");
	audiogame.buttonOverSound.volume = .3;
	audiogame.buttonActiveSound = document.getElementById("buttonactive");
	audiogame.buttonActiveSound.volume = .3;
	
	// load the dot image
	audiogame.dotImage.src = "images/dot.png";

	// listen the button event that links to #game
if(clickOne == true) {
	$(document)
	.hover(function(){
		audiogame.buttonOverSound.currentTime = 0;		
		audiogame.buttonOverSound.play();	
	},function(){
		audiogame.buttonOverSound.pause();	
	})
	.click(function(){
		audiogame.buttonActiveSound.currentTime = 0;
		audiogame.buttonActiveSound.play();

		$("#game-scene").addClass('show-scene');
		startGame();
		return false;
	});
}

	// keydown
	$(document).keydown(function(e){
		var line = e.which-73;
		$('#hit-line-'+line).removeClass('hide');				
		$('#hit-line-'+line).addClass('show');
		/*
		if (audiogame.isRecordMode)
		{
			// print the stored music notes data when press ";" (186)
			if (e.which == 186)
			{
				var musicNotesString = "";
				for(var i in audiogame.musicNotes)
				{
					musicNotesString += audiogame.musicNotes[i].time+","+audiogame.musicNotes[i].line+";";
				}
				console.log(musicNotesString);
			}
			
			var currentTime = audiogame.melody.currentTime.toFixed(3);
			var note = new MusicNote(currentTime, e.which-73);
			audiogame.musicNotes.push(note);
		}
		else
		{
		 	// our target is J(74), K(75), L(76)
			var hitLine = e.which-73;
			
		}	
		*/
	});
	$(document).keyup(function(e){
		var line = e.which-73;
		$('#hit-line-'+line).removeClass('show');				
		$('#hit-line-'+line).addClass('hide');		
	});
	
	if (!audiogame.isRecordMode)
	{
		setupLevelData();
	}	
	
	drawBackground();
	
	if (!audiogame.isRecordMode)
	{
		setInterval(gameloop, 30);
	}
		
});

function playMusic()
{
	// play both the melody and base
	audiogame.melody.play();
	audiogame.base.play();
}

function startGame()
{
	clickOne = false;
	// starting game		
	var date = new Date();
	audiogame.startingTime = date.getTime();
	// SONG LENGTH!?
	setTimeout(playMusic, 3550);
}

function drawBackground()
{
	// get the reference of the canvas and the context.
	var game = document.getElementById("game-background-canvas");
	var ctx = game.getContext('2d');
	
	// set the line style
	ctx.lineWidth = 3;
	ctx.strokeStyle = "#000";
	
	var width = game.width;
	var center = game.height/2;
	
	//Draw the small rectangle to define the scoring area
	ctx.beginPath();
	ctx.rect(100, center-200, width-920, center+135);
	ctx.stroke();
	
	// Border for end of area
	ctx.beginPath ();
	ctx.strokeStyle = '#000';
	ctx.lineWidth = 3;
	ctx.strokeRect(100, center-200, width-920, center+135);
	ctx.stroke();
	
	//Draw the 5 circles to define the correct place to press the buttons Top - Bottom
	ctx.beginPath();
	ctx.fillStyle = '#ACB9E8';
	ctx.arc(155, center-200+37, 30, 0, 2 * Math.PI);
	ctx.fill();
	
	ctx.beginPath ();
	ctx.arc(155, center-125+37, 30, 0, 2 * Math.PI);
	ctx.fill();
	
	ctx.beginPath ();
	ctx.arc(155, center-50+37, 30, 0, 2 * Math.PI);
	ctx.fill();
	
	ctx.beginPath ();
	ctx.arc(155, center+25+37, 30, 0, 2 * Math.PI);
	ctx.fill();
	
	ctx.beginPath ();
	ctx.arc(155, center+100+37, 30, 0, 2 * Math.PI);
	ctx.fill();
	
	//Draw large rectangle to define play area
	ctx.beginPath();
	ctx.strokeStyle = '#000000';
	ctx.rect(100, center-200, width-300, center+135);
	ctx.stroke();
	
	// draw the four lines
	// the bottom line is placed 100 pixels below center.
	ctx.beginPath();
	ctx.moveTo(width-200, center+100);
	ctx.lineTo(100, center+100);		
	ctx.stroke();

	// the 3rd line from the bottom is placed 25 pixels below center
	ctx.beginPath();
	ctx.moveTo(width-200, center+25);
	ctx.lineTo(100, center+25);
	ctx.stroke();
	
	// the 2nd line from the bottom is 50 pixels above center
	ctx.beginPath();
	ctx.moveTo(width-200, center-50);
	ctx.lineTo(100, center-50);
	ctx.stroke();
	
	// the top most line is 125 pixels above center
	ctx.beginPath();
	ctx.moveTo(width-200, center -125);
	ctx.lineTo(100,center -125);
	ctx.stroke();
}

// logic that run every 30ms.
function gameloop()
{
	var game = document.getElementById("game-canvas");
	var ctx = game.getContext('2d');
	var center = game.height/2;
	
    // HARD CODED GAME PLAY AREA VALUES
	var yPlayAreaMin = center - 200 + 37 - 1;
	var yPlayAreaMax = center + 137 + 1;

	// CONVERSION TO PLOT VALUES
	//var yNormal = (yPos - yRangeMin)/(yRangeMax-yRangeMin);
	var yNormal = ( yPos - yRangeMin )/(yRangeMax-yRangeMin);
	//var yPlot = (yNormal*(yPlayAreaMax - yPlayAreaMin) + yPlayAreaMin);
	var yPlot = (yNormal*(yPlayAreaMax - yPlayAreaMin) + yPlayAreaMin)*-1;
	var yVal=0;
	var hnotes=0;
	// show new dots
	// if the game is started
	if (audiogame.startingTime != 0)
	{
		for(var i in audiogame.musicNotes)
		{
			var date = new Date();
			var elapsedTime = (date.getTime() - audiogame.startingTime)/1000;
			var note = audiogame.musicNotes[i];

			var timeDiff = note.time - elapsedTime;
			if (timeDiff >= 0 && timeDiff <= .03)
			{
				var dot = new Dot(ctx.canvas.width -100, note.line);
				audiogame.dots.push(dot);
			}
		}
	}
	
	// move the dots
	for(var i in audiogame.dots)
	{
		audiogame.dots[i].distance -= 6;
	}
	
	// clear rectangle of screen
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

	var gSect=(yPlayAreaMax-yPlayAreaMin)/5;

	if ( yPlot <= gSect+yPlayAreaMin) {
		yVal = center-125-37;
		hnotes=1;

	} else if (  gSect+yPlayAreaMin < yPlot && yPlot <= 2*gSect+yPlayAreaMin) {
		yVal = center-50-37;
		hnotes=2;
	} else if (2*gSect+yPlayAreaMin < yPlot && yPlot <= 3*gSect+yPlayAreaMin) {
		yVal = center+25-37;
		hnotes=3;
	} else if (3*gSect+yPlayAreaMin < yPlot && yPlot <= 4*gSect+yPlayAreaMin) {
		yVal = center+100-37;
		hnotes=4;
	} else {
	//} else if (4*gSect < yPlot && yPlot <= 5*gSect) {
		yVal = center+175-37;
		hnotes=5;
	}


	// check if hit a music note dot
	for(var i in audiogame.dots)
	{
		if (hnotes == audiogame.dots[i].line && audiogame.dots[i].distance <8 && audiogame.dots[i].distance > -8)
		{
			// remove the hit dot from the dots array
			audiogame.dots.splice(i, 1);			
			// increase the success count
			audiogame.successCount++;
			// keep only 5 success count max.
			audiogame.successCount = Math.max(5, audiogame.successCount);
			// increase the total success count
			audiogame.totalSuccessCount ++;
			//add to points
			audiogame.points++;
			console.log(audiogame.totalSuccessCount);
			console.log(audiogame.dots[i].distance);
		} 
	}
	// // check missed dots
	// for(var i in audiogame.dots)
	// {
	// 	if (hnotes != audiogame.dots[i].line && audiogame.dots[i].distance <10)
	// 	{
	// 		audiogame.dots[i].missed = true;
			
	// 		// reduce the success count
	// 		audiogame.missedCount++;
	// 		//console.log("Missed");
	// 		// reset the success count to 0 if it is lower than 0.
	// 		audiogame.successCount = Math.max(0, audiogame.successCount);
										
	// 		//Points
	// 		//audiogame.points--;
	// 	}
	// 	// remove missed dots after moved to the side
	//	if (audiogame.dots[i].distance <-550)
	// 	{
	// 		audiogame.dots.splice(i, 1);
	// 	}
	// }
	ctx.font = "35px Verdana";
    ctx.fillStyle = "black";
    //ctx.fillText("Settings", 100, 15+height*1/4);
    ctx.fillText("Points: ", 330, 30);
    ctx.fillText(audiogame.totalSuccessCount*10, 500, 30);
	
	// calculate the percentage of the success in last 5 music dots
	var successPercent = audiogame.successCount / audiogame.totalDotsCount;
	
	// prevent the successPercent to exceed range(fail safe)
	successPercent = Math.max(0, Math.min(1, successPercent));	
	
	// change the volume of the melody according to the success percentange
	audiogame.melody.volume = successPercent;
		
	


	//console.log(yVal);
	ctx.beginPath();
	ctx.fillStyle = '#7a9461';
	ctx.arc(155, yVal, 30, 0, 2 * Math.PI);
	ctx.fill();

    // DRAW THE CIRCLE CURSOR
	ctx.beginPath();
	ctx.strokeStyle = '#7a9461';
	ctx.arc(155, yPlot, 32, 0, 2 * Math.PI);
	ctx.stroke();

	// draw the music note dots
	for(var i in audiogame.dots)
	{
		
		// prepare the radial gradients fill style		
		var circle_gradient = ctx.createRadialGradient(-3,-3,1,0,0,20);
		circle_gradient.addColorStop(0, "#fff");
		circle_gradient.addColorStop(1, "#cc0");
		ctx.fillStyle = circle_gradient;
		//console.log("draw");
		//console.log(audiogame.dots[i].distance);
		// draw the path
		ctx.save();	
		var center = game.height/2;
		var dot = audiogame.dots[i];
		var x = center;
		if (dot.line == 1)
		{
			x = center-125-37;
		}
		else if (dot.line == 2)
		{
			x = center-50-37;
		}
		else if (dot.line == 3)
		{
			x = center+25-37;
		}
		else if (dot.line == 4)
		{
			x = center+100-37;
		}
		else if (dot.line == 5)
		{
			x = center+175-37;
		}
		ctx.translate(ctx.canvas.width-830+audiogame.dots[i].distance,x);
//		ctx.translate(500+audiogame.dots[i].distance,x);
		ctx.drawImage(audiogame.dotImage, -audiogame.dotImage.height, -audiogame.dotImage.width/2);		
		ctx.restore();
	}
	// click
	if (clickOne == false)
	$(document).click(function(){
		audiogame.buttonActiveSound.currentTime = 0;
		audiogame.buttonActiveSound.play();
		//save elapsed time
		//save current points
		var stoptime = elapsedTime;
		var stoppts = audiogame.points;
        window.location.replace("http://localhost/audio-game/patient-help.php?pausetime=" + stoptime +"&pts=" +stoppts);

        });
}

// show game over scene on melody ended.
function onMelodyEnded()
{
	console.log('song ended');
	console.log('success percent: ',audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 + '%');
	var totalpts = 10*audiogame.points ;
	var percent =  audiogame.totalSuccessCount / audiogame.totalDotsCount * 100;
	/*if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 70)
	{
		var badge = 1;
	}	
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 80)
	{
		var badge = 2;
	}
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 90)
	{
		var badge = 3;
	}
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 100)
	{
		var badge = 4;
	}
	else 
	{
		var badge = 0;
	}
	*/
	window.location.replace("http://localhost/audio-game/end-of-game.php?totalpts=" + totalpts+ "&percent=" + percent); 
	
}