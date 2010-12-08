YUI().use("yql", "node", function(Y) {
 
    var res = Y.one('#main'),
    sources = Y.all('button');
    var handleClick = function (e) {
    	
    	Y.all('button').setAttribute('class','off');
    	e.target.setAttribute('class','on');
    	loadFeed();
    	
    };
    Y.on("click", handleClick, ["header button"]);

    var loadFeed = function () {
        var srcStr = 'http://pipes.yahoo.com/zomie/dealwad?_render=json';
        for(var x = 0;x<=(sources._nodes.length - 1);x++) {
            if (sources._nodes[x].getAttribute('class')!='off') {
    	       srcStr += '&url' + x + '=' + sources._nodes[x].value;
    	    }
    	}
    	console.log(srcStr);
    	Y.YQL('select * from json where url="'+srcStr+'"', function(r) {
      	    var mixedResults = r.query.results.json.value.items;
      	    var html = '';
            for (var y = 0;y<=(mixedResults.length - 1);y++) {
       		var title = mixedResults[y].title;
       		html += "<div><h4>" + title + "</h4><p>" + mixedResults[y].pubDate + "</p></div>";
            }
         res.set('innerHTML', html);
        });
    };
    
    loadFeed();
 
});