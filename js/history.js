var responseFromServer;
var finalResponseFormat;

getHistory();


function getHistory() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
			buildTable(xmlhttp.responseText);
		}
    }

    xmlhttp.open("GET", "php/getHistory.php", true);
    xmlhttp.send();
}

function buildTable(history) {
	var newTable = "";
		
	newTable += "<thead> <tr>";
	newTable += "<td id=\"headerCol\">" + "Twitter Username" + "</td>";
	newTable += "<td id=\"headerCol\">" + "Number of Tweets" + "</td>";
	newTable += "<td id=\"headerCol\">" + "View Word Cloud" + "</td>";
	newTable += "</tr> </thead>";

	newTable += "<tbody>";
	history = history.split("|");
	rowNumber = 1;
	for(var i = 0; i < history.length - 1; i++) {
		if(i % 3 == 0) {
			newTable += "<tr>";
		}
		
		newTable += "<td>" + history[i] + "</td>";
		
		if((i-1) % 3 == 0) {
			i++;
			newTable += "<td> <button type=\"button\" name=" + history[i] + " id=" + rowNumber + " onclick=\"showWordCloud(this.id, this.name);\" class=\"btn btn-default btn-neat\"> <span class=\"glyphicon glyphicon-chevron-down\"></span> </button> </td>";
			newTable += "</tr>";
			rowNumber++;
		}
	}
	newTable += "</tbody>";

	$("#searchHistory").append(newTable);
}

function showWordCloud(row, historyId) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//makeWordCloud(xmlhttp.responseText, historyId);
			responseFromServer = xmlhttp.responseText;
			console.log("Making word cloud with this id: " + historyId);
			makeWordCloud(row);
        }
    }

    xmlhttp.open("POST", "php/getJSON.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("historyId=" + historyId);
}

var color = d3.scale.linear()
    .domain([0,1,2,3,4,5,6,10,15,20,100])
    .range(["#ddd", "#ccc", "#bbb", "#aaa", "#999", "#888", "#777", "#666", "#555", "#444", "#333", "#222"]);


function makeWordCloud(row) { 
	rowToAdd = Number(row) + 1;
	document.getElementById("searchHistory").insertRow(rowToAdd).setAttribute("id", "tempChart");	
	document.getElementById("tempChart").insertCell(0).setAttribute("id", "chart");
	document.getElementById("chart").colSpan = 3;

	finalResponseFormat = JSON.parse(responseFromServer);

	d3.layout.cloud().size([800, 300])
	    .words(finalResponseFormat)
	    .rotate(0)
	    .fontSize(function(d) { return d.size; })
	    .on("end", draw)
	    .start();
}

function draw(words) {
	//figure out how to remove word clouds after they have been opened
	//$("svg").remove();
	
	d3.select("#chart").append("svg")
		.attr("width", 850)
		.attr("height", 350)
		.attr("class", "wordcloud")
		.append("g")
		// without the transform, words words would get cutoff to the left and top, they would
		// appear outside of the SVG area
		.attr("transform", "translate(320,200)")
		.selectAll("text")
		.data(words)
		.enter().append("text")
		.style("font-size", function(d) { return d.size + "px"; })
		.style("fill", function(d, i) { return color(i); })
		.attr("transform", function(d) {
		    return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
		})
		.text(function(d) { return d.text; });
}


