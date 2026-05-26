$(function ($) {

  $(".slide-items").slick({
    autoplay: true, // 自動再生
    arrows: false, // 矢印
    dots: true, // インジケーター
  });

  $(".slide-items-menu").slick({
    autoplay: true, // 自動再生
    arrows: false, // 矢印
    dots: true,
    // インジケーター
    centerMode: true,
    centerPadding: "15%",
    responsive: [
      {
        breakpoint: 2000,
        settings: 'unslick'
      }, {
        breakpoint: 786,
        settings: 'slick'
      }
    ]
  });

  // リサイズした時に実行
  $(window).on('resize orientationchange', function () {
    $('.slide-items-menu').slick('resize');
  });


  $('.hamburger').click(function () {
    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
      $('.globalMenuSp').addClass('active');
    } else {
      $('.globalMenuSp').removeClass('active');
    }

  });

  // メニュー内を閉じておく
  $('.globalMenuSp a[href]').click(function () {
    $('.globalMenuSp').removeClass('active');
    $('.hamburger').removeClass('active');

  });


  // $(function () { // ボタンがクリックされたときの処理
  // $('test .red').click(function () {
  //     $('test .blue').addClass('.red'); // グリーン
  // });
  // });

  // $(function () { // ボタンがクリックされたときの処理
  // $(".lang_btn .btn_jp").on("click", function () {
  //     // divタグのクラスを切り替える
  //     // $(".lang_btn .btn_en").css("background-color", "#dcdcdc");
  //     // $(".lang_btn .btn_jp").css("background-color", "#ffffff");
  //     // $(".lang_btn .btn_en").toggleClass(".grey");

  //     return false;
  // });
  // });

  // $(function () {
  // $('.btn').on('click', function () {
  //     $('.btn.btn_jp').removeClass('grey');
  //     $('.btn.btn_en').addClass('grey');
  // });
  // });

  // $("button").on("click", function () {
  // location.href = "http://nepaldiningtest.local";
  // $("button").removeClass('active');
  // $(this).addClass('active');
  // });

  // $("button").on("click", function () {
  // location.href = "http://nepaldiningtest.local/en";
  // $("button").removeClass('active');
  // $(this).addClass('active');
  // });

});
