function event(name) {
    $.ajax({"url": "/event/" + name});
}

setInterval(function() { event('one'); }, 500);
setInterval(function() { event('two'); }, 1000);
setInterval(function() { event('three'); }, 3000);

chartsrc = $('#eventchart').attr('src');

setInterval(function() {
    var url = chartsrc + "&dt=" + new Date().getTime();
    $('#eventchart').attr('src', url);
}, 5000);

$('#eventfour').click(function() { event('four'); });
$('#eventfive').click(function() { event('five'); });
