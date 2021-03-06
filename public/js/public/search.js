var currentRequest = null;
var timeoutID = null;

// Parse data from ajax to html
function parseData(data) {
    html = '<ul>';
    data.result.forEach(film => {
        path = (typeof film.images[0] != 'undefined' && film.images[0]) ? film.images[0].path : 'images/default/default-film.jpeg';
        html +='<li>'+
                    '<a href=/films/' + film.id + '>'+
                        '<div class="image" style="background-image:url(' + path + ')"></div>'+
                        '<div class="search-content">'+
                            '<b class="title-film">' + film.name + '</b>'+
                            '<p>' + film.director + '</p>'+
                        '</div>'+
                    '</a>'+
                '</li>';
    });
    html += '</ul>';
    return html;
}

// Handle request from ajax(send/abort)
function findListSearch(str) {
    if (currentRequest != null) {
        currentRequest.abort();
        currentRequest = null;
    }
    var query = 'query=' + str;
    currentRequest = $.ajax({
        url: "api/search",
        type: 'GET',
        data: query,
        dataType: 'json',
        cache: true,
    }).done(function (data) {
        !data.result.length ? $('#search-hint').html('') : $('#search-hint').html(parseData(data));

    }).fail(function () {
        console.log('error-connection');
    });
}

// Handle event keyup in search element
$('#query_search').keyup(function (e) {
    clearTimeout(timeoutID);
    timeoutID = setTimeout(findListSearch.bind(undefined, e.target.value), 200);
});

// Hide box result when click out of result dropbox
$(document).on('click', function () {
    $('#search-hint').html('');
});
