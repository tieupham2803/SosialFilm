<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

        <title>Smart search in Laravel with Typeahead.js</title>



        <!-- Styles -->
        <style>
            h3 {
                text-align: center;
                margin: 20px auto;
            }

            .content {
                text-align: center;
            }

            a {
                color: #333;
            }

            .header-title {
                padding: 5px 10px;
                background: #dadada;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h3>Smart search in Laravel with Typeahead.js</h3>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form class="typeahead" role="search">
                    <input type="search" name="q" class="form-control search-input" placeholder="Type something..." autocomplete="off">
                </form>
            </div>
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <!-- Import typeahead.js -->
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

        <script type="text/javascript">
            /* TYPEAHEAD CODE */
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
            url: '/search/email?value=%QUERY%',
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
            source: engine1.ttAdapter(),
            name: 'students-name',
            display: function(data) {
                return data.title;
            },
            templates: {
                empty: [
                    '<div class="header-title">Name</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="header-title">Name</div><div class="list-group search-results-dropdown"></div>'
                ],
                suggestion: function (data) {
                    return '<a href="/reviews/' + data.id + '" class="list-group-item">' + data.title + '</a>';
                }
            }
        },
        {
            source: engine2.ttAdapter(),
            name: 'students-email',
            display: function(data) {
                return data.email;
            },
            templates: {
                empty: [
                    '<div class="header-title">Email</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="header-title">Email</div><div class="list-group search-results-dropdown"></div>'
                ],
                suggestion: function (data) {
                    return '<a href="/students/' + data.id + '" class="list-group-item">' + data.email + '</a>';
                }
            }
        }
    ]);
});
        </script>
    </body>
</html>
