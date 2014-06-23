$(document).ready(function() {
    var elementId;

    $.ajax({
        url: "load.php",
        type: "post",
        success: function(data) {
            var obj = $.parseJSON(data);

            $.each(obj, function() {
                var $element = $('<div class="ui-widget-content draggable" id="' + this['id'] + '">').html('Name: ' + this['name'] + '<br>' + 'Price: ' + this['price'] + '<a class="glyphicon glyphicon-remove delete"></a>');
                //var $remove = $('<a id="delete" class="glyphicon glyphicon-remove">');
                $('#' + this['category']).append($element);
                //$element.append($remove);
//                $remove.position({
//                    of: $remove.parent(),
//                    my: 'right top',
//                    at: 'right top'
//                });
                $element.draggable({ revert: "invalid" });
            });
        }
    });


     
    $(".droppable").droppable({
        drop: function(event, ui) {
            $(ui.draggable).detach().css({top: 0, left: 0}).appendTo(this);
            var category = this.id;
            var elementId = ui.draggable.attr("id");
            $.ajax({
                url: "update.php",
                type: "post",
                data: $(this).serialize() + "&category=" + category + "&elementId=" + elementId
            });
        }
        
        
    });
    

    $("form").submit(function(event) {
        var dataArray = $(this).serializeArray();
        $.ajax({
            url: "addtodb.php",
            type: "post",
            dataType: "json",
            data: $('#menu').serialize(),
            success: function(data) {
                elementId = data.id;
            },
            async: false
        });

        var $element = $('<div class="ui-widget-content draggable" id="' + elementId + '">').html('Name: ' + dataArray[1].value + '<br>' + 'Price: ' + dataArray[2].value + '<a class="glyphicon glyphicon-remove delete"></a>');
        //var $remove = $('<a id="delete" class="glyphicon glyphicon-remove">');

        $("#new").append($element);
        $element.draggable({ revert: "invalid" });
//        $element.append($remove);
//        $remove.position({
//            of: $remove.parent(),
//            my: 'right top',
//            at: 'right top',
//        });
        event.preventDefault();
        $(".droppable").css("height", "+=50");

    });

    $(document).on("click", '.delete', function(e) {
        $(this).parent().remove();
        var deleteId = $(this).parent().attr("id");
        $.ajax({
            url: "delete.php",
            type: "post",
            data: "deleteId=" + deleteId
        });
    });

});
 