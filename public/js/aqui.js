var limit = $('#limit').val()

$('input[name="asiento[]"]').on('change', function(evt) {
    if($('input[name="asiento[]"]:checked').length > limit) {
        this.checked = false;
    }
});