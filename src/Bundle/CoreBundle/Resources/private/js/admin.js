$(function() {
    $('nav#sidebar ul').jarvismenu({
        accordion : true,
        speed : 235
    });

    $('.breadcrumb li:last-of-type').addClass('active');
});

var changeContent = function() {
    $('#wrapper').css('height', ($(window).height() - 76) + 'px');
};

$(window).on('resize', changeContent);

$(changeContent);