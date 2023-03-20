jQuery(document).ready(function(){
    /* We can access all of the top level constants and functions declared in login-shortcodes.php for the login shortcode */

    console.log(auth)
    // TODO: remove || true from this line
    const isGoNative = navigator.userAgent.indexOf("gonative") >= 0;

    if (isGoNative) {
        function initialiseMobileGoogleButton() {
          console.log('initialising google mobile button')
            const googleButton = document.querySelector('.firebaseui-idp-google')

            const buttonClone = googleButton.cloneNode(true)
            const parentNode = googleButton.parentNode

            googleButton.remove()
            buttonClone.onclick = () => gonative.socialLogin.google.login({ 'callback' : googleLoginCallback })

            parentNode.appendChild(buttonClone)
        }
        waitForElement('.firebaseui-idp-google', initialiseMobileGoogleButton)
    }

    function waitForElement(selector, callback) {
      console.log('waiting for element', selector)
        const timeIncrement = 200

        const ticker = setInterval(() => {
            const element = document.querySelector(selector)

            if (!element) return

            clearInterval(ticker)

            callback()
        }, timeIncrement)
    }

    function googleLoginCallback(response) {
      console.log("Google Login Callback");

      let idToken;
      if (response.credential) {
        // browser-only
        idToken = response.credential;
      } else {
        // native-only
        idToken = response.idToken;
      }

      if (idToken) {
        const { GoogleAuthProvider } = firebase.auth
        const { signInWithCredential } = firebase.auth()

        /* Send token to Firebase to exchange for a Firebase token there */
        const credential = GoogleAuthProvider.credential(idToken);

        // Sign in with credential from the Google user.
        signInWithCredential(auth, credential)
        .then((...response) => {
          /* Then we will send *that* token to WP to exchange for a token :O) */

          console.log('signInWithCredential response', response)
        })
        .catch((error) => {
          // Handle Errors here.
          const errorCode = error.code;
          const errorMessage = error.message;
          // The email of the user's account used.
          const email = error.email;
          // The credential that was used.
          const credential = GoogleAuthProvider.credentialFromError(error);

          console.log('signInWithCredential errors', errorCode, errorMessage, email, credential)
        });

      } else {
        console.log("User cancelled login or did not fully authorize.");
      }
    }
})