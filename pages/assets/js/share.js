jQuery(document).ready(function($) {
    const translations = window.pg_js.escapeObject(window.pg_share.translations)
    const shareModal = document.getElementById('share-modal')
    if ( !shareModal ) {
      return;
    }
    const shareFacebook = shareModal.querySelector('.facebook-action')
    const shareTwitter = shareModal.querySelector('.twitter-action')
    const shareEmail = shareModal.querySelector('.email-action')
    const shareLink = shareModal.querySelector('.link-action')

    const isGoNativeApp = navigator.userAgent.indexOf('gonative') > -1
    const isWebAPIShareAvailable = Object.prototype.hasOwnProperty.call(navigator, 'share')

    const metaUrlElement = document.querySelector('meta[property="og:url"]')

    const pageToShare = metaUrlElement ? metaUrlElement.getAttribute('content') : document.URL
    const encodedPageToShare = encodeURIComponent(pageToShare)
    const textToShare = translations['Join us in covering the world in prayer']
    const encodedTextToShare = encodeURIComponent(textToShare)


    function shareAction() {

        const ctaModal = document.getElementById('cta_modal')
        if ( ctaModal ) {
            $(ctaModal).modal('hide')
        }
        if ( isGoNativeApp ) {
            window.location.href = 'gonative://share/sharePage?url=' + encodedPageToShare
        } else if ( isWebAPIShareAvailable ) {
            const data = {
                url: encodedPageToShare
            }
            navigator.share(data)
        } else {
            const navToggler = $('.navbar-toggler')
            const navBar = $('.pg-navmenu')
            if ( navBar.hasClass('show') ) {
                navToggler.click();
            }

            const myModal = new bootstrap.Modal(shareModal)
            myModal.show()
        }
    }

    window.pg_set_up_share_buttons = function() {
        // stop button opening modal
        const shareButtons = document.querySelectorAll('.share-button')
        shareButtons.forEach((shareButton) => {
            let button = $(shareButton)
            button.off('click')
            button.on('click', shareAction)
        })

        shareFacebook.addEventListener('click', () => {
            const url = `https://www.facebook.com/sharer.php?u=${encodedPageToShare}`
            openURL(url)
        })
        shareTwitter.addEventListener('click', () => {
            const url = `https://twitter.com/intent/tweet?url=${encodedPageToShare}&text=${encodedTextToShare}&hashtags=prayerGlobal`
            openURL(url)
        })
        shareEmail.addEventListener('click', () => {
            const subject = 'Prayer Global'
            const body = `
                ${textToShare}
                ${pageToShare}
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
    }

    const openURL = (url, options = {}) => {
        const openTab = options.openTab
        window.open(url, openTab === false ? "_self" : "_blank")
    }

    window.pg_set_up_share_buttons()

})