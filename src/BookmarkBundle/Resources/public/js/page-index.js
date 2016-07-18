$(document).ready(function(){
    $tree = $("#category_tree");
    
    var handle_drag = function(node) {
        // Return the value of data-draggable attribute
        return node[0].data.draggable;
    };
    
    var handle_drop = function(operation, node, node_parent, node_position, more) {
        if (operation == 'move_node') {
            if (node_parent.type == '#' || node_parent.type == 'bookmark') {
                return false
            } else {
                return true;
            }
        }
    };

    $tree.jstree({
        "core": {
          "check_callback" : handle_drop
        },
        "dnd": {
            "is_draggable": handle_drag
        },
        "types" : {
            "default" : {
                "valid_children": ["bookmark"],
                "icon" : "glyphicon glyphicon-tags"
            },
            "bookmark" : {
                "icon" : "glyphicon glyphicon-bookmark"
            }
        },
        "plugins" : [ "dnd", "types" ]
    });
    
    $(".bookmark-row").on("click", function() {
        var id = $(this).data("row-id");
        var tag = "#bkmk_" + id;

        $tree.jstree(true).close_all();
        $tree.jstree(true).deselect_all();
        $tree.jstree(true).select_node(tag);
    });

    $(document).on('dnd_stop.vakata', function (e, data) {
        var ref = $tree.jstree(true);
        var element = ref.get_node(data.element);
        var parents = element.parent;
        
        var element_id = element.id;
        element_id = element_id.split("_")[1];
        
        var cat = $("#"+parents+"_anchor").text();
        
        console.log(cat);
        console.log(element);
        console.log(element.id);
        
        $("#bookmark-category-"+element_id).html(cat);
        
        $.ajax({
            "url": "/bookmarks/edit/"+element_id+"/category",
            "data": "cat="+cat,
            "method": "POST",
            "success": function(res){
                console.log(res);
            }
        });
    });
});