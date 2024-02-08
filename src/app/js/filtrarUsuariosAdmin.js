(function(document) {
    'use strict';
    var LightTableFilter = (function(Arr) {
        var _input;

        function _onInputEvent(e) {
            _input = e.target;
            var table = document.getElementById('tablaUsuarios');
            var rows = table.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var rowData = row.textContent.toLowerCase();
                var searchTerm = _input.value.toLowerCase();

                if (rowData.indexOf(searchTerm) === -1) {
                    row.style.display = 'none';
                } else {
                    row.style.display = 'table-row';
                }
            }
        }

        return {
            init: function() {
                var input = document.getElementById('buscador');
                input.onkeyup = _onInputEvent;
            }
        };
    })(Array.prototype);

    document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });
})(document);
