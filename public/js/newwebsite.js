$('#tagsInput').on('keypress', function(e){
    if(e.which == 32) {

            if($('#tagsInput').val().length >= 3 && $('#tagsInput').val().length <= 8) {

                $('#tagsList')
                .append($('<li>', {
                    text : $('#tagsInput').val() + ' '
                }))
                .append($('<input>', {
                    type : 'hidden',
                    name : 'tags[]',
                    value : $('#tagsInput').val()
                }));

                $('#tagsList li:last')
                .append($('<span>', {
                    class : 'glyphicon glyphicon-remove tag-remove'
                }))

                $('#tagsInput').val('');
            }

        return false;
    }
});

$('#tagsInput').on('paste', function(){
    return false;
});

$('#tagsList').on('click', 'span.tag-remove', function () {
    $(this).parent().next().remove();
    $(this).parent().remove();
});





