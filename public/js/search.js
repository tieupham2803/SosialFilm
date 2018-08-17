jQuery(document).ready(function($) {
    var engine1 = new Bloodhound({
        remote: {
            url: '/search/name?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    var engine2 = new Bloodhound({
        remote: {
            url: '/search/movie?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, [
        {
            source: engine2.ttAdapter(),
            name: 'movie-name',
            display: function(data) {
                return data.title;
            },
            templates: {
                empty: [
                    '<h4>Movies</h4><div class="list-group search-results-dropdown"><div class="list-group-item list-group-item-warning">Nothing found.</div></div>'
                ],
                header: [
                    '<h4>Movies</h4><div class="list-group search-results-dropdown"></div>'
                ],
                suggestion: function (data) {
                    return '<a href="/moviedetails/' + data.id + '" class="list-group-item list-group-item-info">' + data.title + '</a>';
                }
            }
        },
        {
            source: engine1.ttAdapter(),
            name: 'reviews-name',
            display: function(data) {
                return data.title;
            },
            templates: {
                empty: [
                    '<h4>Reviews</h4><div class="list-group search-results-dropdown"><div class="list-group-item list-group-item-warning">Nothing found.</div></div>'
                ],
                header: [
                    '<h4>Reviews</h4><div class="list-group search-results-dropdown"></div>'
                ],
                suggestion: function (data) {
                    return '<a href="/reviews/' + data.id + '" class="list-group-item list-group-item-info">' + data.title + '</a>';
                }
            }
        },
    ]);
});
