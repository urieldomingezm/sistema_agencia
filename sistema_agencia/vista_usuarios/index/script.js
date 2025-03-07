<script type='text/javascript'>
    /* <![CDATA[ */
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
    });
    /* ]]> */
  </script>
  <script type='text/javascript'>
    //<![CDATA[

    function removeHtmlTag(strx, chop) {
      if (strx.indexOf("<") != -1) {
        var s = strx.split("<");
        for (var i = 0; i < s.length; i++) {
          if (s[i].indexOf(">") != -1) {
            s[i] = s[i].substring(s[i].indexOf(">") + 1, s[i].length);
          }
        }
        strx = s.join("");
      }
      chop = (chop < strx.length - 1) ? chop : strx.length - 2;
      while (strx.charAt(chop - 1) != ' ' && strx.indexOf(' ', chop) != -1) chop++;
      strx = strx.substring(0, chop - 1);
      return strx + '...';
    }
    function createSummaryAndThumb(pID) {
      var div = document.getElementById(pID);
      var summ = summary_noimg;
      var summary = '<div>' + removeHtmlTag(div.innerHTML, summ) + '</div>';
      div.innerHTML = summary;
    }
    function createSummaryAndThumb2(pID) {
      var div = document.getElementById(pID);
      var imgtag = "";
      var img = div.getElementsByTagName("img");
      if (img.length >= 1) {
        imgtag = '<img style="float: left; border-radius: 2px;" src="' + img[0].src + '" width="320px" height="140px"/>';
      }
      var summary = imgtag;
      div.innerHTML = summary;
    }

    //]]>
  </script>
<script>
    jQuery(document).ready(function ($) {
      $("abbr.timeago").timeago()

    });
  </script>
  <script type='text/javascript'>
    function time() {
      today = new Date();
      h = today.getHours();
      m = today.getMinutes();
      document.getElementById('hora').innerHTML = h + ":" + m;
      setTimeout('time()', 500);
    }
  </script>
<script type='text/javascript'>
    //<![CDATA[
    $(window).load(function () {
      $('#status').fadeOut();
      $('#preloader').delay(350).fadeOut('slow');
      $('body').delay(350).css({ 'overflow': 'visible' });
    })
    //]]>
  </script>
  <script type='text/javascript'>
    function fechar() {
      document.getElementById('notificacao').style.display = 'none';
    }
    function abrir() {
      document.getElementById('notificacao').style.display = 'block';
      setTimeout("fechar()", 300000);
    }
  </script>
  <script type="text/javascript">
    if (window.jstiming) window.jstiming.load.tick('headEnd');
  </script>

<script>
$('.botao').click(function (event) {
  if ($(event.target).hasClass('notificab')) {
    $('#notifica-box').css('display', 'block');
    $('#evento-box').css('display', 'none');
    $('#tirinha-box').css('display', 'none');
  }
  else if ($(event.target).hasClass('evento')) {
    $('#notifica-box').css('display', 'none');
    $('#evento-box').css('display', 'block');
    $('#tirinha-box').css('display', 'none');
  }
  else if ($(event.target).hasClass('tirinha')) {
    $('#notifica-box').css('display', 'none');
    $('#evento-box').css('display', 'none');
    $('#tirinha-box').css('display', 'block');
  }
  else if ($(event.target).hasClass('sai-box')) {
    $('#notifica-box').css('display', 'none');
    $('#evento-box').css('display', 'none');
    $('#tirinha-box').css('display', 'none');
  }
});
</script>
<script>
function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||
    (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {
      document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
} 
</script>
<button class='expandir' onclick='toggleFullScreen()' type='button'><i class='fa fa-arrows-alt'></i></button>
<script type="text/javascript">
if (window.jstiming) window.jstiming.load.tick('widgetJsBefore');
</script>
<script type='text/javascript'>
if (typeof (BLOG_attachCsiOnload) != 'undefined' && BLOG_attachCsiOnload != null) { window['blogger_templates_experiment_id'] = "templatesV1"; window['blogger_blog_id'] = '6936817305946898479'; BLOG_attachCsiOnload(''); } _WidgetManager._Init('//www.blogger.com/rearrange?blogID\x3d6936817305946898479', '//habobbaof.blogspot.com.br/', '6936817305946898479');
_WidgetManager._SetDataContext([{ 'name': 'blog', 'data': { 'blogId': '6936817305946898479', 'bloggerUrl': 'https://www.blogger.com', 'title': 'Habobba - Bobba, Bobbinha, Bobbona', 'pageType': 'index', 'url': 'https://habobbaof.blogspot.com.br/', 'canonicalUrl': 'https://habobbaof.blogspot.com/', 'homepageUrl': 'https://habobbaof.blogspot.com.br/', 'canonicalHomepageUrl': 'https://habobbaof.blogspot.com/', 'blogspotFaviconUrl': 'https://habobbaof.blogspot.com.br/favicon.ico', 'enabledCommentProfileImages': true, 'adultContent': false, 'analyticsAccountNumber': '', 'useUniversalAnalytics': false, 'pageName': '', 'pageTitle': 'Habobba - Bobba, Bobbinha, Bobbona', 'encoding': 'UTF-8', 'locale': 'pt_PT', 'localeUnderscoreDelimited': 'pt_pt', 'isPrivate': false, 'isMobile': false, 'isMobileRequest': false, 'mobileClass': '', 'isPrivateBlog': false, 'languageDirection': 'ltr', 'feedLinks': '\74link rel\75\42alternate\42 type\75\42application/atom+xml\42 title\75\42Habobba - Bobba, Bobbinha, Bobbona - Atom\42 href\75\42https://habobbaof.blogspot.com/feeds/posts/default\42 /\76\n\74link rel\75\42alternate\42 type\75\42application/rss+xml\42 title\75\42Habobba - Bobba, Bobbinha, Bobbona - RSS\42 href\75\42https://habobbaof.blogspot.com/feeds/posts/default?alt\75rss\42 /\76\n\74link rel\75\42service.post\42 type\75\42application/atom+xml\42 title\75\42Habobba - Bobba, Bobbinha, Bobbona - Atom\42 href\75\42https://www.blogger.com/feeds/6936817305946898479/posts/default\42 /\76\n', 'meTag': '', 'openIdOpTag': '\74link rel\75\42openid.server\42 href\75\42https://www.blogger.com/openid-server.g\42 /\76\n\74link rel\75\42openid.delegate\42 href\75\42https://habobbaof.blogspot.com/\42 /\76\n', 'latencyHeadScript': '\74script type\75\42text/javascript\42\76(function() { (function(){function c(a){this.t\75{};this.tick\75function(a,c,b){var d\75void 0!\75b?b:(new Date).getTime();this.t[a]\75[d,c];if(void 0\75\75b)try{window.console.timeStamp(\42CSI/\42+a)}catch(e){}};this.tick(\42start\42,null,a)}var a;window.performance\46\46(a\75window.performance.timing);var h\75a?new c(a.responseStart):new c;window.jstiming\75{Timer:c,load:h};if(a){var b\75a.navigationStart,e\75a.responseStart;0\74b\46\46e\76\75b\46\46(window.jstiming.srt\75e-b)}if(a){var d\75window.jstiming.load;0\74b\46\46e\76\75b\46\46(d.tick(\42_wtsrt\42,void 0,b),d.tick(\42wtsrt_\42,\n\42_wtsrt\42,e),d.tick(\42tbsd_\42,\42wtsrt_\42))}try{a\75null,window.chrome\46\46window.chrome.csi\46\46(a\75Math.floor(window.chrome.csi().pageT),d\46\0460\74b\46\46(d.tick(\42_tbnd\42,void 0,window.chrome.csi().startE),d.tick(\42tbnd_\42,\42_tbnd\42,b))),null\75\75a\46\46window.gtbExternal\46\46(a\75window.gtbExternal.pageT()),null\75\75a\46\46window.external\46\46(a\75window.external.pageT,d\46\0460\74b\46\46(d.tick(\42_tbnd\42,void 0,window.external.startE),d.tick(\42tbnd_\42,\42_tbnd\42,b))),a\46\46(window.jstiming.pt\75a)}catch(k){}})();window.tickAboveFold\75function(c){var a\0750;if(c.offsetParent){do a+\75c.offsetTop;while(c\75c.offsetParent)}c\75a;750\76\75c\46\46window.jstiming.load.tick(\42aft\42)};var f\75!1;function g(){f||(f\75!0,window.jstiming.load.tick(\42firstScrollTime\42))}window.addEventListener?window.addEventListener(\42scroll\42,g,!1):window.attachEvent(\42onscroll\42,g);\n })();\74/script\076', 'mobileHeadScript': '', 'view': '', 'dynamicViewsCommentsSrc': '//www.blogblog.com/dynamicviews/4224c15c4e7c9321/js/comments.js', 'dynamicViewsScriptSrc': '//www.blogblog.com/dynamicviews/b8b1db2edc023ff5', 'plusOneApiSrc': 'https://apis.google.com/js/plusone.js', 'sf': 'n' } }, { 'name': 'messages', 'data': { 'adsGoHere': 'Os anúncios são apresentados aqui', 'archive': 'Arquivar', 'blogArchive': 'Arquivo do blogue', 'by': 'Por', 'byAuthor': 'Por %1', 'byAuthorLink': 'Por \74a href\75\42%2\42\76%1\74/a\076', 'deleteBacklink': 'Eliminar backlink', 'deleteComment': 'Eliminar comentário', 'edit': 'Editar', 'emailAddress': 'Endereço de email', 'getEmailNotifications': 'Obter notificações por email', 'keepReading': 'Continuar a ler', 'labels': 'Etiquetas', 'loadMorePosts': 'Carregar mais mensagens', 'loading': 'A carregar...', 'myBlogList': 'A minha Lista de blogues', 'myFavoriteSites': 'Os meus sites favoritos', 'newer': 'Mais recente', 'newerPosts': 'Mensagens mais recentes', 'newest': 'Os/As mais recentes', 'noResultsFound': 'Não foram encontrados resultados', 'noTitle': 'Sem título', 'numberOfComments': '{numComments,plural, \0750{Não existem comentários}\0751{1 comentário}other{# comentários}}', 'older': 'Mais antiga', 'olderPosts': 'Mensagens antigas', 'oldest': 'O mais antigo', 'onlyTeamMembersCanComment': 'Nota: só um membro deste blogue pode publicar um comentário.', 'popularPosts': 'Mensagens populares', 'popularPostsFromThisBlog': 'Mensagens populares deste blogue', 'postAComment': 'Enviar um comentário', 'postedBy': 'Publicada por', 'postedByAuthor': 'Publicado por %1', 'postedByAuthorLink': 'Publicado por \74a href\75\42%2\42\76%1\74/a\076', 'readMore': 'Saiba mais', 'reportAbuse': 'Denunciar abuso', 'search': 'Pesquisar', 'searchBlog': 'Pesquisar no blogue', 'share': 'Partilhar', 'showAll': 'Mostrar tudo', 'someOfMyFavoriteSites': 'Alguns dos meus sites favoritos', 'subscribe': 'Subscrever', 'subscribeToThisBlog': 'Subscrever este blogue', 'theresNothingHere': 'Não existe nada aqui!', 'viewAll': 'Ver tudo', 'visitProfile': 'Visitar o perfil', 'widgetNotAvailableInPreview': 'Este conteúdo não está disponível na pré-visualização do blogue.', 'widgetNotAvailableOnHttps': 'Este conteúdo ainda não se encontra disponível em ligações encriptadas.' } }, { 'name': 'skin', 'data': { 'vars': {}, 'override': '' } }, { 'name': 'view', 'data': { 'classic': { 'name': 'classic', 'url': '?view\75classic' }, 'flipcard': { 'name': 'flipcard', 'url': '?view\75flipcard' }, 'magazine': { 'name': 'magazine', 'url': '?view\75magazine' }, 'mosaic': { 'name': 'mosaic', 'url': '?view\75mosaic' }, 'sidebar': { 'name': 'sidebar', 'url': '?view\75sidebar' }, 'snapshot': { 'name': 'snapshot', 'url': '?view\75snapshot' }, 'timeslide': { 'name': 'timeslide', 'url': '?view\75timeslide' } } }]);
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML10', 'Onlines', null, document.getElementById('HTML10'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML13', 'tirinhas', null, document.getElementById('HTML13'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML11', 'eventos', null, document.getElementById('HTML11'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML12', 'notificacaoes', null, document.getElementById('HTML12'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML1', 'Slide', null, document.getElementById('HTML1'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML7', 'Box Noticias', null, document.getElementById('HTML7'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML6', 'Box Noticias', null, document.getElementById('HTML6'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML9', 'Box Noticias', null, document.getElementById('HTML9'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML8', 'Box Noticias', null, document.getElementById('HTML8'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_BlogView', new _WidgetInfo('Blog1', 'Postagens', null, document.getElementById('Blog1'), { 'cmtInteractionsEnabled': false, 'lightboxEnabled': true, 'lightboxModuleUrl': 'https://www.blogger.com/static/v1/jsbin/2519788704-lbx__pt_pt.js', 'lightboxCssUrl': 'https://www.blogger.com/static/v1/v-css/306752634-lightbox_bundle.css' }, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML2', 'Eventos', null, document.getElementById('HTML2'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML3', 'Publicidade', null, document.getElementById('HTML3'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML4', 'Destaque', null, document.getElementById('HTML4'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML14', 'Quartos', null, document.getElementById('HTML14'), {}, 'displayModeFull'));
_WidgetManager._RegisterWidget('_HTMLView', new _WidgetInfo('HTML5', 'Menu Rodape', null, document.getElementById('HTML5'), {}, 'displayModeFull'));
</script>

<script type='text/javascript'>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({ pageLanguage: 'pt', includedLanguages: 'en,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element');
}
</script>