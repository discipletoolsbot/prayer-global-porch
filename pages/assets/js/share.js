$(document).ready(function($) {
    const shareButton = document.querySelector('.share-button')
    const shareModal = document.getElementById('share-modal')

    const isGoNativeApp = navigator.userAgent.indexOf('gonative') > -1
    const isWebAPIShareAvailable = Object.prototype.hasOwnProperty.call(navigator, 'share')

    // stop button opening modal
    shareButton.addEventListener('click', (event) => {
        const pageToShare = window.location.href
        if ( isGoNativeApp ) {
            window.location.href = 'gonative://share/sharePage?url=' + pageToShare
        } else if ( isWebAPIShareAvailable ) {
            const data = {
                url: pageToShare
            }
            navigator.share(data)
        } else {
            $(shareModal).modal()
        }
    })
})