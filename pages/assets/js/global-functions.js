$(document).ready(function ($) {
  window.schoolPride = function () {
    var end = Date.now() + 3 * 1000;

    // go Buckeyes!
    var colors = ["#bb0000", "#1d82ff", "#ffffff"];

    (function frame() {
      confetti({
        particleCount: 3,
        angle: 60,
        spread: 55,
        origin: { x: 0, y: 0.8 },
        colors: colors,
      });
      confetti({
        particleCount: 3,
        angle: 120,
        spread: 55,
        origin: { x: 1, y: 0.8 },
        colors: colors,
      });

      if (Date.now() < end) {
        requestAnimationFrame(frame);
      }
    })();
  };
  window.celebrationCannons = function () {
    var colors = ["#bb0000", "#1d82ff"];

    const fire = () => {
      confetti({
        particleCount: 2,
        angle: 60,
        spread: 55,
        origin: { x: 0 },
        colors: colors,
      });
    };

    setTimeout(fire, 0);
    setTimeout(fire, 100);
    setTimeout(fire, 200);
  };

  window.celebrationFireworks = function (celebrationDuration = 3000) {
    var duration = celebrationDuration;
    var animationEnd = Date.now() + duration;
    var defaults = {
      startVelocity: 15,
      spread: 360,
      ticks: 50,
      zIndex: 100000,
      scalar: 0.4,
      gravity: 0.2,
      shapes: ["circle"],
      particleCount: 500,
      useWorker: true,
    };

    let numberOfFireworks = 12;

    if (isSmallDevice()) {
      defaults.particleCount = 200;
      defaults.scalar = 0.8;
      defaults.ticks = 30;
      defaults.startVelocity = 20;
      numberOfFireworks = 6;
    }

    const timeout = celebrationDuration / numberOfFireworks;

    const colours = [
      ["#5492f7", "#202AF9", "#4556D9"],
      //['#CB91F9', '#B34EF4', '#E5B0FE'],
      ["#DD344D", "#FFB1BA", "#F05264"],
      ["#fef355", "#fab945", "#f4d9bd"],
    ];

    function randomInRange(min, max) {
      return Math.random() * (max - min) + min;
    }

    function originInBoundingBox() {
      return {
        x: randomInRange(0.2, 0.8),
        // since particles fall down, start a bit higher than random
        y: randomInRange(0, 0.7) - 0.2,
      };
    }

    var interval = setInterval(function () {
      var timeLeft = animationEnd - Date.now();

      if (timeLeft <= 0) {
        return clearInterval(interval);
      }

      colours.forEach((colour) => {
        confetti(
          Object.assign({}, defaults, {
            origin: originInBoundingBox(),
            colors: colour,
          })
        );
      });
    }, timeout);
  };

  function isSmallDevice() {
    const smallScreen = 575;
    const mediumScreen = 767;
    const largeScreen = 991;

    if (window.innerWidth < largeScreen || window.innerHeight < largeScreen) {
      return true;
    }

    return false;
  }

  window.loginRedirect = function () {
    const redirect_to = encodeURIComponent(window.location.href);
    window.location.href = `/user_app/login?redirect_to=${redirect_to}`;
  };

  window.getAuthUser = function (successCallback, failureCallback) {
    return window
      .api_fetch("/wp-json/dt/v1/session/check_auth", {
        method: "POST",
      })
      .then((json) => {
        if (!json) {
          throw new Error("not logged in");
        }

        const { data } = json;
        const { status } = data;

        if (status !== 200) {
          throw new Error();
        }
      })
      .then(() =>
        window.api_fetch("/wp-json/pg-api/v1/user/details", {
          method: "POST",
        })
      )
      .then((user) => {
        if (typeof jsObject !== 'undefined') {
          jsObject.user = user;
        }

        if (successCallback) {
          successCallback(user);
        }
      })
      .catch((error) => {
        localStorage.removeItem("login_token");
        localStorage.removeItem("login_method");

        if (failureCallback) {
          failureCallback(error);
        }
      });
  };

  window.api_fetch = function (url, options = {}) {
    const opts = {
      method: "GET",
      ...options,
    };

    if (!Object.prototype.hasOwnProperty.call(options, "headers")) {
      opts.headers = {};
    }

    opts.headers["Content-Type"] = "application/json";

    /* Check if the user has a valid token */
    const token = localStorage.getItem("login_token");
    if (token) {
      opts.headers["Authorization"] = `Bearer ${token}`;
    }

    return fetch(url, opts)
      .then((result) => {
        return result;
      })
      .then((result) => result.json());
  };
});
