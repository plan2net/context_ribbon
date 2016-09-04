
TYPO3.jQuery( document ).ready(function() {


    var value = TYPO3.jQuery('meta[name=context]').attr('value');
    if (value == null || value == "") value = "Production";

    TYPO3.jQuery('body').append('<div class="ribbonbox"><div class="ribbon '+value.toLowerCase()+'"><span>'+value+'</span></div></div>');
});