jQuery(document).ready(function(){

    jQuery('body').on('submit', '.ajax-form-submit', function(e){
        e.preventDefault();
        var form = jQuery(this);

        var action = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        jQuery.ajax({
            url : action,
            type : method,
            data : data,
            dataType : 'json',
            success : function( res ) {
                if (res) {
                    alert('success');
                    location.reload(true);
                } else
                    alert('error');
            },
            error : function() {
                alert('error');
            }
        });
    });

    jQuery('body').on('click', '.pagination li a', function(e){
        e.preventDefault();
        var _this = jQuery(this);

        var page = _this.data('page');
        var form_id = _this.closest('.pagination').data('form');
        var form = jQuery('#' + form_id);

        form.find('input[name="page"]').val(page);

        form.trigger('submit');
    });

    jQuery('body').on('click', '.sort-tasks-list', function(e){
        e.preventDefault();
        var _this = jQuery(this);

        var sort = _this.closest('th').data('name');
        var order = _this.find('i').hasClass('fa-sort-up') ? 'ASC' : 'DESC';

        var form = _this.closest('form');

        form.find('input[name="sort"]').val(sort);
        form.find('input[name="order"]').val(order);

        form.trigger('submit');
    });

    jQuery('body').on('click', '.btn-user-logout', function(e){

        jQuery.ajax({
            url : '/api/auth/logout',
            type : 'POST',
            dataType : 'json',
            success : function( res ) {
                if (res) {
                    alert('success');
                    location.reload(true);
                } else
                    alert('error');
            },
            error : function() {
                alert('error');
            }
        });
    });

    jQuery('body').on('click', '.btn-update-task-text', function(e){
        e.preventDefault();
        var _this = jQuery(this);

        var text = _this.closest('tr').find('input[name="text"]').val();
        var status = _this.closest('tr').find('input[name="status"]').prop("checked") ? 1 : 0;
        var id = _this.closest('tr').data('id');

        jQuery.ajax({
            url : '/api/task/update',
            type : 'POST',
            dataType : 'json',
            data: 'text=' + text + '&id=' + id + '&status=' + status,
            success : function( res ) {
                if (res) {
                    alert('success');
                    location.reload(true);
                } else
                    alert('error');
            },
            error : function() {
                alert('error');
            }
        });
    });
});