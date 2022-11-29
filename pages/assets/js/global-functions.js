$(document).ready(function($) {

  window.celebrationFireworks = function(celebrationDuration = 3000) {
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
    };
    const colours = [
      ["#5492f7", "#202AF9", "#4556D9"],
      //      [ '#CB91F9', '#B34EF4', '#E5B0FE' ],
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

      var particleCount = 500;
      colours.forEach((colour) => {
        confetti(
          Object.assign({}, defaults, {
            particleCount,
            origin: originInBoundingBox(),
            colors: colour,
          })
        );
      });
    }, 250);
  }

})