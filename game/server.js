var connect = require('connect');
var serveStatic = require('serve-static');
connect().use(serveStatic(__dirname)).listen(8080);

var exec = require('child_process').exec,
    path = require('path'),
    fs   = require('fs'),
    xPos = 0,
    yPos = 0;  

//Lets define a port we want to listen to
const PORT80=8000;
const PORT90=9000;

var http = require('http');

function handleRequest(request, response){
    //calls the matlab script (NEED TO CHANGE THIS TO RUN EXE)
    response.setHeader('Access-Control-Allow-Origin','*'); 
    console.log("Executing");
    //exec("C:\\wamp\\www\\DataStreamEXEMarch20at314pm.m", function puts(error, stdout, stderr) {console.log(error,stdout,stderr);});
    exec("C:\\wamp\\www\\audio-game\\js\\runMATLAB.bat", function puts(error, stdout, stderr) {console.log(error,stdout,stderr);});    
    response.end();
} 

function handleResult(request, response){
    response.setHeader('Access-Control-Allow-Origin','*'); 
    var fs = require('fs');
    do {                                           
         //var file = "C:\\Users\\AlanTJ\\Desktop\\FYDP\\Mozart\\MockDataStream.txt";
         var file = "C:\\wamp\\www\\DataStream.txt";
         var exists = fs.existsSync(file);
         console.log(exists);     
     } while (!exists);
     //filename = "C:\\Users\\AlanTJ\\Desktop\\FYDP\\Mozart\\MockDataStream.txt";
     filename = "C:\\wamp\\www\\DataStream.txt";
     fs.readFile(filename, 'utf8', function(err, data) {
        if (err) throw err;
        console.log(data);
        response.write(data);
        response.end();
     });
}

//Create a server
var server80 = http.createServer(handleRequest);
var server90 = http.createServer(handleResult);

//Lets start our server
server80.listen(PORT80, function(){
    //Callback triggered when server is successfully listening. Hurray!
    console.log("Server listening on: http://localhost:%s", PORT80);
});

server90.listen(PORT90, function(){
    //Callback triggered when server is successfully listening. Hurray!
    console.log("Server listening on: http://localhost:%s", PORT90);
});

//lets you read the txt file whenever it is modified ---------------------------|
// fs.watch('/Users/pyo/Documents/MATLAB/Project/XY.txt', function ( curr, prev ) {
//    // on file change we can read the new xml
//     fs.readFile('/Users/pyo/Documents/MATLAB/Project/XY.txt','utf8', function ( err, data ) {
//         if ( err ) throw err;
//         //measures the length of data variable (if there is both x and y position, there is total of 18 characters)
//         var n = data.length;
//         //console.dir(n);
//         if ( n > 17 ){
//             //console.dir(data);
//             var Pos = data.match(/[^\s]+/g);
//             xPos = parseFloat(Pos[0]);
//             yPos = parseFloat(Pos[1]);
//             console.dir(Pos);
//             //console.dir(Pos[0]);
//             //console.dir(Pos[1]);
//         }        
//     });
// }); 


