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

function openModal(id) {
  const modal = document.getElementById(`editModal${id}`);
  modal.style.visibility = 'visible';
  modal.style.display = 'flex'; /* ここで表示される */
}

function closeModal(id) {
  const modal = document.getElementById(`editModal${id}`);
  modal.style.visibility = 'hidden';
  modal.style.display = 'none'; /* 非表示にする */
}

window.addEventListener('click', function (e) {
  document.querySelectorAll('.modal').forEach(modal => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});
