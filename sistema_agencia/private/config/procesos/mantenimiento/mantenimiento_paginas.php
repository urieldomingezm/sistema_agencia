<body>

<!-- partial:index.partial.html -->
<habbo-client-error ng-if="ClientController.isOpen &amp;&amp; !ClientController.flashEnabled">
    <!---->
    <div class="client-error__background-frank" ng-if="!ClientErrorController.mobile">
        <span class="client-error__text-contents">
            <h1 class="client-error__title" translate="CLIENT_ERROR_TITLE">Estan en mantenimiento</h1>
            <p translate="CLIENT_ERROR_FLASH">Perdon por las molestias causadas por el momento esta en mantenimiento este index en unos minutos volvera a la normalidad</p>
        </span>
        <div class="client-error__hotel-button-div">
            <a ng-href="http://www.adobe.com/go/getflashplayer" target="_blank" rel="noopener noreferrer" class="hotel-button" href="http://www.adobe.com/go/getflashplayer">
                <span class="hotel-button__text" translate="NAVIGATION_HOTEL">Hotel</span>
            </a>
        </div>
    </div>
    <!---->
    <!---->
</habbo-client-error>
<!-- partial -->
  
</body>