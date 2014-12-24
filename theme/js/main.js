/**
 * Created by alanjhonnes on 12/23/2014.
 */
$(document).ready(function(){
    "use strict";
    $('.navigation').jstree({
        "core" : {
            "multiple" : false,
            "animation" : 0
        },
        "plugins" : [ "wholerow" ]
    });
    var jstree = $('.navigation').jstree(true);

    var container = $('.main-container');
    $('.navigation').on('changed.jstree', function (e, data) {
        var i, j;
        for(i = 0, j = data.selected.length; i < j; i++) {
            var node = data.instance.get_node(data.selected[i]);
            //console.log(node);
            //node is a folder, create another gallery
            if(node.children.length > 0){
                createGallery(node);

            }
            else {
                //node is an image, display it.
                var name = node.data.name;
                var path = node.data.path;
                $.fancybox( {href : path, title : name} );
                //and recreate a gallery based on its parent.
                console.log(node);
                createGallery(jstree.get_node(node.parent));
            }

        }
        //console.log(data);

    });

    function createGallery(node){
        container.empty();
        _.forEach(node.children, function(nodeId){
            var childNode = jstree.get_node(nodeId);

            if(childNode.children.length === 0){
                var name = childNode.data.name;
                var path = childNode.data.path;
                var thumb = childNode.data.thumbnail;
                console.log(name);
                container.append('<div class="col-xs-6 col-sm-4 col-md-3"><a class="fancybox" href="'+path+'" rel="group"><img src="'+thumb+'" alt="'+name +'"/></a></div>');

            }
            $(".fancybox").fancybox();
        });
    }
});