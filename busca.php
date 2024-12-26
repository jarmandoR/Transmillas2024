        <link href="dist/selectivity-full.css" rel="stylesheet">
        <style>
            body, input {
                font-family: Helvetica, sans-serif;
                font-size: 12px;
            }
            .dev-instructions {
                display: none;
            }
        </style>
        <script src="dist/jquery.js"></script>
        <script src="dist/selectivity-full.js"></script>
        <script>
            $(document).ready(function() {
                var cities = $('#single-select-box').find('option').map(function() {
					return this.textContent;
                }).get();

                var transformText = $.fn.selectivity.transformText;

                function queryFunction(query) {
                    var selectivity = query.selectivity;
                    var term = query.term;
                    var offset = query.offset || 0;
                    var results;

                    if (selectivity.$el.attr('id') === 'single-input-with-submenus') {
                        var timezone = selectivity.dropdown.highlightedResult.id;
                        results = citiesWithTimezone.filter(function(city) {
                            return transformText(city.id).indexOf(transformText(term)) > -1 &&
                                   city.timezone === timezone;
                        }).map(function(city) { return city.id;} );
                    } else {
                        results = cities.filter(function(city) {
                            return transformText(city).indexOf(transformText(term)) > -1;
                        });
                    }
                    setTimeout(function() {
                        query.callback({
                            more: results.length > offset + 10,
                            results: results.slice(offset, offset + 10)
                        });
                    }, 500);
                }

                $('#multiple-input').selectivity({
                    multiple: true,
                    placeholder: 'Seleccione asistentes',
                    query: queryFunction
					
                });
            });
        </script>
