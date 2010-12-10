YUI().use("yql", "node", function(Y) {
    var currentItem;
    var res = Y.one('#main'),
    sources = Y.all('#settings button');
    var settingsView = function (e) {
    	Y.one('#container').setAttribute('class','viewSettings');
    };
    var changeFeed = function (e) {
    	
    	Y.all('button').setAttribute('class','off');
    	e.target.setAttribute('class','on');
    	loadFeed();
    	
    };

    var changeView = function (e) {
        Y.one('#container').setAttribute('class','viewItem');
        var target = e.target._node;
        currentItem = target;
     	//console.log(target.parentNode.nextSibling);
        target.parentNode.nextSibling.setAttribute('style','display:block');
        Y.YQL('select * from search.termextract where context="' + target.innerHTML + '"', function(r) {
      	    var extractedProducts = r.query.results.Result,
      	        productList = '<div class="compare">Compare Prices:',
      	        productCt = 0;
      	    //console.log(extractedProducts);
      	    for (z in extractedProducts) {
      	    	productCt++;
      	        productList += '<button class="">' + extractedProducts[z] + '</button>';
      	    }
      	    	productList += "</div>"; 
      	    if(productCt > 0) {
      	    	target.parentNode.nextSibling.innerHTML+=productList;
      	    }
      	    
        });
    };
    
    var normalView = function (e) {
    	Y.one('#container').setAttribute('class','viewHome');
        currentItem.parentNode.nextSibling.setAttribute('style','display:none');
        Y.all('compare').remove;
    };
    Y.on("click", changeFeed, ["#settings button"]);
    Y.on("click", changeView, [".headline"]);
    Y.on("click", normalView, [".back"]);
    Y.on("click", settingsView, [".setting"]);

    var loadFeed = function () {
        var srcStr = 'http://pipes.yahoo.com/zomie/dealwad?_render=json';
        for(var x = 0;x<=(sources._nodes.length - 1);x++) {
            if (sources._nodes[x].getAttribute('class')!='off') {
    	       srcStr += '&url' + x + '=' + sources._nodes[x].value;
    	    }
    	}
    	Y.YQL('select * from json where url="'+srcStr+'"', function(r) {
      	    var mixedResults = r.query.results.json.value.items;
      	    var html = '';
      	    //console.log(mixedResults);
            for (var y = 0;y<=(mixedResults.length - 1);y++) {
            	//todo: factor out time logic or find a better way to do this crap
            	var hour = mixedResults[y]['y:published'].hour;
            	if (hour < 10) {
            	    hour = '0' + hour;
            	} else if (hour > 12) {
            	    hour = hour - 12;
            	    if (hour < 10) {
            	    	hour = '0' + hour;
            	    }
            	}
            	var minute = mixedResults[y]['y:published'].minute;
            	if (minute < 10) {
            	   minute = '0' + minute;
            	}
            	var ampm = 'am';
            	if (mixedResults[y]['y:published'].hour > 12) {
            	   ampm = 'pm';
            	}
            	
       		var title = mixedResults[y].title,
       		    pubDate = hour + ':' + minute + ampm + ' ' + mixedResults[y]['y:published'].month + '/' + mixedResults[y]['y:published'].day + '/' + mixedResults[y]['y:published'].year,
       		    description = mixedResults[y].description,
       		    link = mixedResults[y].link;
       		if (title != null) {
       	            html += '<div><div class="headline"><h4>' + title + "<span>" + pubDate + '</span></h4></div><div class="description"><h4><a href="' + link + '">' + title + "</a><span>" + pubDate + "</span></h4>" + description + '</div></div>';
            	}	
            }
         res.set('innerHTML', html);
        });
    };
    
    loadFeed();
 
});
//+ link.match(/[\w\$\-\_\+\!\*]+\.([\w\$\-\_\+\!\*]+\.)*[\w\$\-\_\+\!\*]+[^\/]/)