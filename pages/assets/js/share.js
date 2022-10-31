$(document).ready(function($) {
    const shareButton = document.querySelector('.share-button[data-white]')

    shareButton.addEventListener('click', (event) => {
        const pageToShare = window.location.href
        if ( navigator.userAgent.indexOf('gonative') > -1 ) {
            window.location.href = 'gonative://share/sharePage?url=' + pageToShare
        } else if ( Object.prototype.hasOwnProperty.call(navigator, 'share') ) {
            const data = {
                url: pageToShare
            }
            navigator.share(data)
        } else {
            console.log('no shares available')
        }
    })
})