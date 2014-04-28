<!DOCTYPE html>
<html>
<head>
    <title>@yield("title") - Patrick Rose</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::style("assets/css/main.min.css") }}
    <link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css">
</head>
<body>
    <div class="container">
        @include('partials/_navigation')

        <div class="main-text">
            @if (Session::has("flash_message"))
                <div class='flash-message'>
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            @yield("content")

        </div>
    </div>
    {{ HTML::script('assets/js/jquery.min.js') }}
    {{ HTML::script('assets/js/bootstrap.js') }}
    {{ HTML::script('assets/js/fading.js') }}
    <script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
    <script type="application/javascript">
        hljs.LANGUAGES.behat = function() {
            return {
                defaultMode: {
                    contains: [
                        {
                            className: 'keyword',
                            begin: '^\\s*(But |And |Then |When |Given |\\* |Scenarios|Examples|Scenario Template|Scenario Outline|Scenario|Background|Feature)',
                            relevance: 0
                        },
                        {
                            className: 'string',
                            begin: '\\|',
                            relevance: 0
                        },
                        hljs.HASH_COMMENT_MODE,
                        {
                            className: 'string',
                            begin: '"""', end: '"""',
                            relevance: 10
                        },
                        hljs.APOS_STRING_MODE,
                        hljs.QUOTE_STRING_MODE,
                        hljs.C_NUMBER_MODE,
                        {
                            className: 'annotation', begin: '@[^@\r\n\t ]+'
                        }
                    ]
                }
            };
        }();
    </script>
    <script>hljs.initHighlightingOnLoad();</script>
</body>
</html>