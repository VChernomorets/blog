$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.like__object').on('click', likeClick);
    function likeClick() {
        $(this).off('click');
        let $value = $(this).parent().find('.like__value');
        if($(this).attr('status') === '1'){
            $(this).removeClass('like-active');
            $(this).attr('status', '0');
            $value.text($value.text() - 1);
        } else {
            $(this).addClass('like-active');
            $(this).attr('status', '1');
            $value.text(+$value.text() + 1);
        }
        let id = $(this).attr('essenceId');
        let url = '/' + $(this).parent().attr('likeType') +'/like/' + id;
        let $this = $(this);
        let data = 'like=' + $(this).attr('status');
        $.ajax({
            type:'POST',
            url:url,
            dataType : "json",
            data: data,
            complete:function () {
                $this.on('click', likeClick);
            }
        });
    }
})
