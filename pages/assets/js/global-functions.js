window.pg_js = {
  escapeObject(obj) {
    return Object.fromEntries(
      Object.entries(obj).map(([key, value]) => {
        return [key, this.escapeHTML(value)];
      }),
    );
  },
  escapeHTML(str) {
    if (typeof str === 'undefined') return '';
    if (typeof str !== 'string') return str;
    return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&apos;');
  },
  isMobile(){
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
      isMobile = true;
    }
    return isMobile;
  }
}

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

    let numberOfFireworksPerSecond = 4;

    if (isSmallDevice()) {
      defaults.particleCount = 200;
      defaults.scalar = 0.8;
      defaults.ticks = 30;
      defaults.startVelocity = 20;
      numberOfFireworksPerSecond = 2;
    }

    const timeout = 1000 / numberOfFireworksPerSecond;

    const colours = [
      ["#5492f7", "#202AF9", "#4556D9"],
      //['#CB91F9', '#B34EF4', '#E5B0FE'],
      ["#DD344D", "#FFB1BA", "#F05264"],
      ["#fef355", "#fab945", "#f4d9bd"],
    ];

    const staggerTimeouts = [ 0, 50, 100 ]

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

      colours.forEach((colour, i) => {
        setTimeout( () =>
          confetti(
            Object.assign({}, defaults, {
              origin: originInBoundingBox(),
              colors: colour,
            })
        ), staggerTimeouts[i%staggerTimeouts.length]);
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

  /**
   * Adds leading zeros to a number to create a string that is length long.
   *
   * Doesn't work with negative numbers currently, as is only for use with time
   */
  window.padNumber = function (number, length) {
    const zeros = (length) => new Array(length).fill('0').join('')
    return (zeros(length) + number).slice(-length)
  }
});
