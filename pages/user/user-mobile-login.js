jQuery(document).ready(function () {
  /* We can access all of the top level constants and functions declared in login-shortcodes.php for the login shortcode */
  const googleButtonSelector = ".firebaseui-idp-google";
  const facebookButtonSelector = ".firebaseui-idp-facebook";
  const linkAccountButtonSelector = ".firebaseui-id-submit"

  const isGoNative = navigator.userAgent.indexOf("gonative") >= 0;

  if (isGoNative) {
    function initialiseMobileButton(selector, socialProvider, callback) {
      console.log("initialising google mobile button");
      const buttonElement = document.querySelector(selector);

      const buttonClone = buttonElement.cloneNode(true);
      const parentNode = buttonElement.parentNode;

      buttonElement.remove();

      if (socialProvider === "google") {
        buttonClone.onclick = () =>
          gonative.socialLogin.google.login({ callback: callback });
      } else if (socialProvider === "facebook") {
        buttonClone.onclick = () =>
          gonative.socialLogin.facebook.login({ callback: callback });
      }

      parentNode.appendChild(buttonClone);
    }

    waitForElement(googleButtonSelector, () =>
      initialiseMobileButton(
        googleButtonSelector,
        "google",
        providerLoginCallback
      )
    );
    waitForElementContainingText(linkAccountButtonSelector, 'google', () => {
      initialiseMobileButton(
        linkAccountButtonSelector,
        'google',
        providerLoginCallback
      )
    })
    waitForElement(facebookButtonSelector, () =>
      initialiseMobileButton(
        facebookButtonSelector,
        "facebook",
        providerLoginCallback
      )
    );
    waitForElementContainingText(linkAccountButtonSelector, 'facebook', () => {
      initialiseMobileButton(
        linkAccountButtonSelector,
        'facebook',
        providerLoginCallback
      )
    })
   }

  function waitForElement(selector, callback) {
    console.log("waiting for element", selector);
    const timeIncrement = 200;

    const ticker = setInterval(() => {
      const element = document.querySelector(selector);

      if (!element) return;

      clearInterval(ticker);

      callback();
    }, timeIncrement);
  }

  function waitForElementContainingText(selector, text, callback) {
    console.log('waiting for element containing text', selector, text)
    const timeIncrement = 200

    const ticker = setInterval(() => {
      const element = document.querySelector(selector)

      if (!element) return

      const elementText = element.innerHTML
      if (!elementText.toLowerCase().includes(text)) return

      clearInterval(ticker)

      callback()
    }, timeIncrement)
  }

  function providerLoginCallback(response) {
    console.log("Google Login Callback response", response);

    let token;

    const provider = response.type;
    if (provider === "google") {
      token = response.idToken;
    }
    if (provider === "facebook") {
      token = response.accessToken;
    }

    if (token) {
      console.log("we have an idToken", token);
      const { GoogleAuthProvider, FacebookAuthProvider } = firebase.auth;

      let credential;

      if (provider === "google") {
        credential = GoogleAuthProvider.credential(token);
      }
      if (provider === "facebook") {
        credential = FacebookAuthProvider.credential(token);
      }

      console.log("attempting signIn with credential", credential);

      // Sign in with credential from the Google user.
      auth
        .signInWithCredential(credential)
        .then((authResult) => {
          /* Then we will send *that* token to WP to exchange for a token :O) */

          console.log("signInWithCredential response", authResult);

          return signInSuccessWithAuthResult(authResult);
        })
        .catch((error) => {
          // Handle Errors here.
          const errorCode = error.code;
          const errorMessage = error.message;
          // The email of the user's account used.
          const email = error.email;

          console.log(
            "signInWithCredential errors",
            errorCode,
            errorMessage,
            email
          );
        });
    } else {
      console.log("User cancelled login or did not fully authorize.");
    }
  }
});
