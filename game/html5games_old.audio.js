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

audiogame.leveldata = "0.3571,5; 1.6616,1;3.6787,4;4.1316,5;5.4396,2;6.9372,4;7.5702,1;8.5776,3;12.2949,5;15.3989,4;16.2489,3;18.4489,2;19.5318,2;21.6681,2;24.6944,4;25.9249,1;26.3706,5;27.6388,5;29.4829,3;30.6298,4;31.4650,3;32.1092,3;33.1131,1;34.1079,5;35.4457,1;36.9388,3;37.6338,2;38.9297,3;39.0629,5;40.3069,5;41.9498,1;42.0104,4;43.1678,3;45.8338,5;46.6059,5;47.5179,5;48.9429,1;49.7412,5;50.7011,2;52.8738,5;54.9819,3;55.9186,1;56.2835,4;57.0586,4;58.8210,2;59.1795,2;60.0349,4;61.7713,5;62.5405,4;64.5782,3;65.8545,4;66.6424,3;67.4201,1;68.5459,2;69.1823,5;71.2054,5;72.2597,2;73.9426,2;74.6416,4;75.8291,2;77.1684,5;78.7401,5;79.8728,2;80.3555,4;81.1788,2;82.9964,2;83.9591,2;84.1560,1;85.9289,5;86.4246,4;87.2231,2;88.1364,3;89.2602,4;91.0822,2;93.0292,4;94.4549,4;95.3325,4;96.9437,4;97.3031,3;98.4282,2;99.6610,1;100.3811,3;101.1362,1;102.0966,1;103.3052,1;104.8239,3;105.6273,1;106.2059,3;107.9802,1;108.4378,3;109.8352,1;110.5392,3;111.0251,5;112.0068,1;113.7861,2;114.4474,2;115.2887,2;116.8632,3;117.6562,1;118.2847,3;119.6446,4;120.2636,3";


// the visual dots drawn on the canvas.
audiogame.dots = [];
audiogame.startingTime = 0;

// reference of the dot image
audiogame.dotImage = new Image();
audiogame.totalDotsCount = 0;
audiogame.totalSuccessCount = 0;

// storing the success count of last 5 results.
audiogame.successCount = 5;
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
	$("a[href='#game']")
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
	
	// mouse button press
	$(document).mousedown(function(){
		//save current time
		document.getElementById(elapsedTime)
		//save current audio count
		document.getElementById(audiogame.successCount)	
		//go to help page
		window.location.replace = 'http://localhost/audio-game/patient-help.php';
	});
	
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
	// starting game		
	var date = new Date();
	audiogame.startingTime = date.getTime();
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
				var dot = new Dot(ctx.canvas.height-150, note.line);
				audiogame.dots.push(dot);
			}
		}
	}
	
	// check missed dots
	for(var i in audiogame.dots)
	{
		if (!audiogame.dots[i].missed && audiogame.dots[i].distance < -10)
		{
			audiogame.dots[i].missed = true;
			
			// reduce the success count
			audiogame.successCount--;
			
			// reset the success count to 0 if it is lower than 0.
			audiogame.successCount = Math.max(0, audiogame.successCount);
										
			//Points
			audiogame.points--;
		}

		
		// remove missed dots after moved to the side
		if (audiogame.dots[i].distance <-350)
		{
			audiogame.dots.splice(i, 1);
		}
	}
	
	// calculate the percentage of the success in last 5 music dots
	var successPercent = audiogame.successCount / audiogame.totalDotsCount;
	
	// prevent the successPercent to exceed range(fail safe)
	successPercent = Math.max(0, Math.min(1, successPercent));	
	
	// change the volume of the melody according to the success percentange
	audiogame.melody.volume = successPercent;
		
	
	// move the dots
	for(var i in audiogame.dots)
	{
		audiogame.dots[i].distance -= 2.5;
	}
	
	// clear rectangle of screen
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
				
	
	// draw the music note dots
	for(var i in audiogame.dots)
	{
		
		// prepare the radial gradients fill style		
		var circle_gradient = ctx.createRadialGradient(-3,-3,1,0,0,20);
		circle_gradient.addColorStop(0, "#fff");
		circle_gradient.addColorStop(1, "#cc0");
		ctx.fillStyle = circle_gradient;
		
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
		ctx.translate(500+audiogame.dots[i].distance,x);
		ctx.drawImage(audiogame.dotImage, -audiogame.dotImage.height, -audiogame.dotImage.width/2);		
		ctx.restore();
	}
	
}

// show game over scene on melody ended.
function onMelodyEnded()
{
	console.log('song ended');
	console.log('success percent: ',audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 + '%');
	/*
	if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 70)
	{
		var badge = 
	}	
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 80)
	{
		var badge = 
	}
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 90)
	{
		var badge = 
	}
	else if (audiogame.totalSuccessCount / audiogame.totalDotsCount * 100 >= 100)
	{
		var badge = 
	}
	else 
	{
		var badge =
	}
	*/
}