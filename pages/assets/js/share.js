$(document).ready(function($) {
    const shareButton = document.querySelector('.share-button')
    const shareModal = document.getElementById('share-modal')
    const shareFacebook = shareModal.querySelector('.facebook-action')
    const shareTwitter = shareModal.querySelector('.twitter-action')
    const shareEmail = shareModal.querySelector('.email-action')
    const shareLink = shareModal.querySelector('.link-action')

    const isGoNativeApp = navigator.userAgent.indexOf('gonative') > -1
    const isWebAPIShareAvailable = Object.prototype.hasOwnProperty.call(navigator, 'share')

    const pageToShare = document.URL.includes('localhost') ? 'https://prayer.global' :  encodeURIComponent(document.URL)
    const textToShare = encodeURIComponent("Join us in covering the world in prayer")

    // stop button opening modal
    shareButton.addEventListener('click', () => {
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

    shareFacebook.addEventListener('click', () => {
        const url = `https://www.facebook.com/sharer.php?u=${pageToShare}`
        openURL(url)
    })
    shareTwitter.addEventListener('click', () => {
        const url = `https://twitter.com/intent/tweet?url=${pageToShare}&text=${textToShare}&hashtags=prayerGlobal`
        openURL(url)
    })
    shareEmail.addEventListener('click', () => {
        const subject = 'Prayer Global'
        const body = `
            ${textToShare}
            ${document.URL}
        `
        const url = `mailto:?subject=${subject}&body=${body}`
        openURL(url, { openTab: false })
    })
    shareLink.addEventListener('click', () => {
        navigator.clipboard.writeText(pageToShare)
        shareLink.classList.add('list-group-item-success')
    })

    $(shareModal).on('hidden.bs.modal', () => {
        shareLink.classList.remove('list-group-item-success')
    })

    const openURL = (url, options = {}) => {
        const openTab = options.openTab
        window.open(url, openTab === false ? "_self" : "_blank")
    }

})