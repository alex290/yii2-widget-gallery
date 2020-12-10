$(document).ready(function() {
    $(function() {
        $(".sortableWidgetGallery").sortable({
            stop: function(event, ui) {
                let id = [];
                $('.sortableWidgetGalleryItem').each(function(index, element) {
                    id[index] = $(element).data('id');
                });

                $.ajax({
                    type: "GET",
                    url: "/widget-gallery/data/sortable",
                    data: { 'data': JSON.stringify(id) },
                    success: function(response) {

                    }
                });
                console.log(id);

            }
        });
        $(".sortableWidgetGallery").disableSelection();
    });
});