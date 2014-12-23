/**
 * Created by alanjhonnes on 12/23/2014.
 */
$(document).ready(function(){
    "use strict";
    $('.navigation').jstree().on('changed.jstree', function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).text);
        }
        console.log(data);
        //$('#event_result').html('Selected: ' + r.join(', '));
    });
});