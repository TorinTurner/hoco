<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Marck+Script|Open+Sans|Parisienne" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		var image_names = ["wagegap.png", "1by1.png", "andy.png", "code.png", "french.png"];
		var yes = 0;
		var no = 0;
		
		window.onload = function() {
			for(var i = 0; i < image_names.length; i++) {
				document.body.innerHTML += getHTML(image_names[i]);
			}
		}
		
		function getHTML(file) {
			var yes_text = "YES";
			var no_text = "NO";
			if(file == "french.png") {
				yes_text = "OUI";
				no_text = "NON";
			}
			return '<div id=' + file + ' class="page hidden animated slideInRight">\n' +
				'<div class="absolutecenter">\n' +
					'<img class="nodrag proposal" src="' + file + '" /><br>\n' +
					'<button class="response" onclick="next(\'' + file + '\', true)">' + yes_text + '</button>\n' +
					'<button class="response" onclick="next(\'' + file + '\', false)">' + no_text + '</button>\n' +
				'</div>\n' +
			'</div>\n';
		}
		
		function formatPercent(ratio) {
			return parseFloat(Math.round(ratio * 100) / 100).toFixed(2);
		}
		function next(current, response) {
			if(response) yes++;
			else no++;
			var index = image_names.indexOf(current);
			document.getElementById(current).style.display = 'none';
			if(index == image_names.length - 1) {
				var result = "";
				if(no > yes) {
					result = "No (" + formatPercent(no / image_names.length * 100) + "%)"
				} else {
					result = "Yes (" + formatPercent(yes / image_names.length * 100) + "%)";
				}
				document.getElementById("result").innerHTML = result;
				document.getElementById("finish").style.display = 'block';
				setTimeout(startConfetti, 1500);
			} else
				document.getElementById(image_names[index + 1]).style.display = 'block';
		}
		
		function start() {
			document.getElementById("home").style.display = 'none';
			document.getElementById(image_names[0]).style.display = 'block';
		}
	</script>
	<style>
		.absolutecenter {
			position: absolute;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
		}
		.cardcenter {
			position: relative;
			left: 50%;
			top: 0;
			-webkit-transform: translate(-50%, 0);
			transform: translate(-50%, 0);
			text-align: center;
		}
		.page {
			width: 100%;
			height: 100%;
		}
		.hidden {
			display: none;
		}
		
		.proposal {
			max-width: 100vw;
			max-height: 50vh;
			height: auto;
			width: auto;
		}
		
		.nodrag {
			user-drag: none; 
			user-select: none;
			-moz-user-select: none;
			-webkit-user-drag: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		
		body {
			margin: 0;
			overflow: hidden;
			
			font-family: 'Open Sans', sans-serif;
		}
		
		button {
			border: 0;
			border-radius: 5px;
			font-family: inherit;
			//font-size: 100%;
			background-color: lightgray;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 20px;
			padding-right: 20px;
			font-weight: bold;
			//font-style: italic;
			
			font-size: 32px;
		}
		
		button:hover {
			font-color: gray;
		}
		
		.response {
			margin-left: 10px;
			margin-right: 10px;
		}
		
		.finalcard {
			border: 100px solid transparent;
			border-size: min(100px, 25vh);
			width: 40vw;
			height: 50vh;
			padding: 0px;
		}
	</style>
	<!-- Confetti -->
	<style>
		.wrapper {
			position: relative;
			min-height: 100vh;
		}

		[class|="confetti"] {
			position: absolute;
		}

		.red {
			background-color: #E94A3F;
		}

		.yellow {
			background-color: #FAA040;
		}

		.blue {
			background-color: #5FC9F5;
		}
	</style>
	<script>
		function startConfetti() {
			for (var i = 0; i < 250; i++) {
			  create(i);
			}
		}

		function create(i) {
			var width = Math.random() * 8 + 6;
			var height = width * 0.4;
			var colourIdx = Math.ceil(Math.random() * 3);
			var colour = "red";
			switch(colourIdx) {
				case 1:
					colour = "yellow";
				break;
				case 2:
					colour = "blue";
				break;
				default:
					colour = "red";
			}
			$('<div class="confetti-'+i+' '+colour+'"></div>').css({
				"width" : width+"px",
				"height" : height+"px",
				"top" : -Math.random()*20+"%",
				"left" : Math.random()*100+"%",
				"opacity" : Math.random()+0.5,
				"transform" : "rotate("+Math.random()*360+"deg)"
			}).appendTo('.wrapper');  
		  
			drop(i);
		}

		function drop(x) {
			$('.confetti-'+x).animate({
				top: "100%",
				left: "+="+Math.random()*15+"%"
			}, Math.random()*3000 + 3000, function() {
				reset(x);
			});
		}

		function reset(x) {
			$('.confetti-'+x).animate({
				"top" : -Math.random()*20+"%",
				"left" : "-="+Math.random()*15+"%"
			}, 0, function() {
				drop(x);             
			});
		}
	</script>
</head>
<body>
	<div id="home" class="page">
		<div class="absolutecenter">
			<p>You will given the option to answer 'YES' or 'NO' for each.</p>
			<button onclick="start()">START</button>
		</div>
	</div>
	
	<div class="page wrapper hidden animated slideInRight" id="finish" style="z-index: -100">
		<div class="absolutecenter finalcard">
			<div class="cardcenter">
				<h1 style="font-size: 50px; font-family: 'Parisienne', cursive;">Homecoming 2019</h1>
				<h2 style="font-style: italic; margin-bottom: 0px;">You Answered</h2><br>
				<h3 id="result" style="margin-top: 0px;"></h3><br><br>
				<h3 style="font-family: 'Marck Script', cursive;">See You At 6!</h3><br><br>
				<span style="font-style: italic;">- <3 Torin</span>
			</div>
		</div>
	</div>
</body>
</html>