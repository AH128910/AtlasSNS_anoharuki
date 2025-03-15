$(function () {
  $('.menu-trigger').click(function () {        //ハンバーガーボタン（.menu-trigger）をタップすると、
    $(this).toggleClass('active');              //タップしたハンバーガーボタン（.menu-trigger）に（.active）を追加・削除する。
    if ($(this).hasClass('active')) {           //もし、ハンバーガーボタン（.menu-trigger）に（.active）があれば、
      $('.menu-list').addClass('active');          //(.g-navi)にも（.active）を追加する。
    } else {                                    //それ以外の場合は、
      $('.menu-list').removeClass('active');       //(.g-navi)にある（.active）を削除する。
    }
  });


});
