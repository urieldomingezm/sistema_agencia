jQuery(document).ready(function ($) {
    $('#NivoSlider').nivoSlider({
      effect: 'slideInLeft',
      slices: 10,
      boxCols: 8,
      boxRows: 4,
      animSpeed: 500,
      pauseTime: 4500,
      startSlide: 0,
      directionNav: false,
      directionNavHide: false,
      controlNav: false,
      keyboardNav: false,
      pauseOnHover: false,
      captionOpacity: 1
    });
    $("abbr.timeago").timeago();
  });
  
  function removeHtmlTag(strx, chop) {
    if (strx.indexOf("<") != -1) {
      var s = strx.split("<");
      for (var i = 0; i < s.length; i++) {
        if (s[i].indexOf(">") != -1) {
          s[i] = s[i].substring(s[i].indexOf(">") + 1);
        }
      }
      strx = s.join("");
    }
    chop = (chop < strx.length - 1) ? chop : strx.length - 2;
    while (strx.charAt(chop - 1) != ' ' && strx.indexOf(' ', chop) != -1) chop++;
    return strx.substring(0, chop - 1) + '...';
  }
  
  function createSummaryAndThumb(pID) {
    var div = document.getElementById(pID);
    var summ = summary_noimg;
    div.innerHTML = '<div>' + removeHtmlTag(div.innerHTML, summ) + '</div>';
  }
  
  function createSummaryAndThumb2(pID) {
    var div = document.getElementById(pID);
    var img = div.getElementsByTagName("img");
    div.innerHTML = img.length >= 1 ? '<img style="float: left; border-radius: 2px;" src="' + img[0].src + '" width="320px" height="140px"/>' : "";
  }
  
  function time() {
    let today = new Date();
    document.getElementById('hora').innerHTML = today.getHours() + ":" + today.getMinutes();
    setTimeout(time, 500);
  }
  
  $(window).load(function () {
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({ 'overflow': 'visible' });
  });
  
  function fechar() {
    document.getElementById('notificacao').style.display = 'none';
  }
  
  function abrir() {
    document.getElementById('notificacao').style.display = 'block';
    setTimeout(fechar, 300000);
  }
  
  if (window.jstiming) window.jstiming.load.tick('headEnd');
  
  $('.botao').click(function (event) {
    let target = $(event.target);
    $('#notifica-box, #evento-box, #tirinha-box').css('display', 'none');
    if (target.hasClass('notificab')) $('#notifica-box').css('display', 'block');
    else if (target.hasClass('evento')) $('#evento-box').css('display', 'block');
    else if (target.hasClass('tirinha')) $('#tirinha-box').css('display', 'block');
  });
  
  function toggleFullScreen() {
    if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
    } else if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  }
  
  document.querySelector('.expandir').addEventListener('click', toggleFullScreen);
  
  if (window.jstiming) window.jstiming.load.tick('widgetJsBefore');
  
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'pt',
      includedLanguages: 'en,es,fr',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
