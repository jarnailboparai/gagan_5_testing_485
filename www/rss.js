parseFeed();

function parseFeed() {
$.getFeed({
    url: 'http://someUrl.com',
    dataType: "xml",
    success: function(feed) {

    $('#feedresult').empty();

    var html = '<ul data-role="listview">';

    for(var i = 0; i < feed.items.length; i++) {

        var item = feed.items[i];

        html += '<li>'
        + '<a href="#article?id='
        + i
        + '">'
        + item.title
        + '</a>'
        + '</li>';
    }

    html = html + '</ul>';

    $('#feedresult').append(html);
    $('#main').page('destroy').page();

    }});
};
