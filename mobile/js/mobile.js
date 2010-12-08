YUI().use("yql", "node", function(Y) {
 
    var res = Y.one('#main'),
    sources = Y.all('button'),
    srcStr = 'http://pipes.yahoo.com/zomie/dealwad?_render=json';
    for(var x = 0;x<=(sources._nodes.length - 1);x++) {
    		srcStr += '&url' + x + '=' + sources._nodes[x].value;
    }
    console.log(sources);
    console.log(srcStr);
Y.YQL('select * from json where url="'+srcStr+'"', function(r) {
       var mixedResults = r.query.results.json.value.items;
       var html = '';
       console.log(mixedResults);
       for (var y = 0;y<=(mixedResults.length - 1);y++) {
       		var title = mixedResults[y].title;
       		html += "<div><h4>" + title + "</h4><p>" + mixedResults[y].pubDate + "</p></div>";
       }
       res.set('innerHTML', html);
    });
 
});