var results;
var topNumResults = 120;

function getTweets() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
			results = xmlhttp.responseText;
			makeMapping(JSON.parse(results));
			makeWordCloud();
			$("#resultsTitle").html(twitterUsername + "'s last " + numTweets + " tweets:");
		}
    }

    var twitterUsername = document.getElementById('inputTwitterName').value;
    var numTweets = document.getElementById('inputNumTweets').value;
    xmlhttp.open("POST", "php/getTweets.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("inputTwitterUsername=" + twitterUsername + "&inputNumTweets=" + numTweets);
}

function makeMapping(rawJSON) {
	var sentences = [];
	for (var i = 0; i < rawJSON.length; ++i) {
		sentences[i] = rawJSON[i]["text"];
	}
	var dictionary = {};
	var common = "\\n,&lt,&gt,rt,http://t,https://t,poop,i,me,my,myself,we,us,our,ours,ourselves,you,your,yours,yourself,yourselves,he,him,his,himself,she,her,hers,herself,it,its,itself,they,them,their,theirs,themselves,what,which,who,whom,whose,this,that,these,those,am,is,are,was,were,be,been,being,have,has,had,having,do,does,did,doing,will,would,should,can,could,ought,i'm,you're,he's,she's,it's,we're,they're,i've,you've,we've,they've,i'd,you'd,he'd,she'd,we'd,they'd,i'll,you'll,he'll,she'll,we'll,they'll,isn't,aren't,wasn't,weren't,hasn't,haven't,hadn't,doesn't,don't,didn't,won't,wouldn't,shan't,shouldn't,can't,cannot,couldn't,mustn't,let's,that's,who's,what's,here's,there's,when's,where's,why's,how's,a,an,the,and,but,if,or,because,as,until,while,of,at,by,for,with,about,against,between,into,through,during,before,after,above,below,to,from,up,upon,down,in,out,on,off,over,under,again,further,then,once,here,there,when,where,why,how,all,any,both,each,few,more,most,other,some,such,no,nor,not,only,own,same,so,than,too,very,say,says,said,shall";

        var word_count = {};
	for (var i = 0; i < sentences.length; ++i) {
		var theseWords = sentences[i].split(/[ \n\r'\-\(\)\*";\[\]|{},.!?]+/);
		for (var j = 0; j < theseWords.length; ++j) {
			var word = theseWords[j].toLowerCase();
			if (common.indexOf(word) == -1) {
				if (!dictionary[word]) {
					dictionary[word] = 0;
				}
				dictionary[word] += 1;
			}
		}
	}
  var sortedValues = [];
  for(a in dictionary) {
    tmp = {};
    tmp['text'] = a;
    tmp['size'] = dictionary[a]; 
    sortedValues.push(tmp);
  }
  sortedValues.sort(function(a,b) {return a['size']-b['size'];}).reverse();
	topResults = [];
	for (var i = 0; i < Math.min(topNumResults, sortedValues.length); ++i) {
		topResults[i] = sortedValues[i];
	}
	var topMin = topResults[topResults.length-1]['size'];
	var topMax = topResults[0]['size'];
	for (var i = 0; i < topResults.length; ++i) {
		var word = topResults[i];
		word['size'] = Math.floor(word['size'].map(topMin, topMax, 5, 120));
		topResults[i] = word;
	}
	topResultsForBlob = [];
	for (var i = 0; i < topResults.length; ++i) {
    var tmp = topResults[i];
    var newObj = {};
    newObj['text'] = tmp['text'];
    newObj['size'] = tmp['size'];
		topResultsForBlob[i] = newObj;
	}
}

Number.prototype.map = function (inMin, inMax, outMin, outMax) {
  return (this - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
}


function saveTweet() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
			console.log("successfully saved the tweet");
			console.log(xmlhttp.responseText);
		}
    }

    var twitterUsername = document.getElementById('inputTwitterName').value;
    var numTweets = document.getElementById('inputNumTweets').value;
    var json = topResultsForBlob;
		console.log(json);
    json = JSON.stringify(json);
		console.log(json);
    xmlhttp.open("POST", "php/saveTweet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("inputTwitterUsername=" + twitterUsername + "&inputNumTweets=" + numTweets + "&json=" + json);
}

var test_pre_run = [{"text":"study","size":40},{"text":"motion","size":15},{"text":"forces","size":10},{"text":"electricity","size":15},{"text":"movement","size":10},{"text":"relation","size":5}];

var test = [{"text":"study","size":40},{"text":"motion","size":15},{"text":"forces","size":10},{"text":"electricity","size":15},{"text":"movement","size":10},{"text":"relation","size":5}];

var color = d3.scale.linear()
    .domain([0,1,2,3,4,5,6,10,15,20,100])
    .range(["#ddd", "#ccc", "#bbb", "#aaa", "#999", "#888", "#777", "#666", "#555", "#444", "#333", "#222"]);

function makeWordCloud() {
	$("#resultsWell").removeClass("hidden");


	d3.layout.cloud().size([800, 300])
	    .words(topResults)
	    .rotate(0)
	    .fontSize(function(d) { return d.size; })
	    .on("end", draw)
	    .start();
}

function draw(words) {
	$("svg").remove();
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
