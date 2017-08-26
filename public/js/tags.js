$(function() {
    let tags = new Array();
    $('#tagsList input').each(function () {
        tags.push($(this).val());
    });

    $('#tagsInput').on('keypress', function(e){
        if(e.which == 32) {
            let newTag = $('#tagsInput').val();
            if(
                newTag.length >= 3 &&
                newTag.length <= 15 &&
                $('#tagsList input').length <= 5 &&
                !tags.includes(newTag)
            )
            {
                tags.push($('#tagsInput').val());
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
});





