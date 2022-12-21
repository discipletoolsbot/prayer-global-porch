function PGActivityList(logs, handlePrimaryContent, handleSecondaryContent) {
  let logsHtml = "";
  logs.forEach((log) => {
    const { is_mine, when_text } = log
    let badgeColor = is_mine ? "orange-dark-bg" : "blue-dark-bg";
    if (when_text.includes("week")) {
      badgeColor = is_mine ? "orange-bg" : "blue-bg";
    }
    if (when_text.includes("month")) {
      badgeColor = is_mine ? "orange-light-bg" : "blue-light-bg";
    }
    const logHtml = `
        <div class="activity-log__item">
          <div class="activity-log__badge">
            <div class="badge__inner ${badgeColor}"></div>
          </div>
          <div class="activity-log__body">
            <div class="font-weight-bold">${handlePrimaryContent ? handlePrimaryContent(log) : ''}</div>
            <div>${handleSecondaryContent ? handleSecondaryContent(log) : ''}</div>
            <div class="light-grey">${when_text}</div>
          </div>
        </div>`;

    logsHtml += logHtml;
  });

  return `
      <div class="activity__list">
        ${logsHtml}
      </div>`;
}

  /**
   * Renders an icon Infographic
   *
   * @param {Object[]} stats
   * @param {int} stats[].value - The value to depict
   * @param {string} stats[].icon - One of body|time
   * @param {string} stats[].color - One of red|orange|green|blue
   * @param {string} stats[].size - One of small|medium|large
   *
   * @return {string}
   */
function PGIconInfographic(stats) {

  const iconOptions = {
    'body': 'ion-ios-body',
    'time': 'ion-ios-time'
  }
  const defaultIcon = iconOptions.body

  const iconColors = {
    red: 'red',
    orange: 'orange',
    green: 'green',
    blue: 'blue',
  }
  const defaultColor = iconColors.blue

  const sizes = {
    small: 'one-em',
    medium: 'two-em',
    large: 'three-em',
  }
  const defaultSize = sizes.medium

  let html = ''
  stats.forEach(({ value, icon, color, size }) => {
    if ( size < 0 ) return

    let icons = ``
    let iconOption = iconOptions.hasOwnProperty(icon) ? iconOptions[icon] : defaultIcon
    let iconColor = iconColors.hasOwnProperty(color) ? iconColors[color] : defaultColor
    let iconSize = sizes.hasOwnProperty(size) ? sizes[size] : defaultSize
    for (let i = 0; i < value; i++) {
      icons += `<i class="${iconOption}"></i>`
    }

    html += `
      <span class="${iconColor} ${iconSize}">
        ${icons}
      </span>`
  });

  return html;
}

const PG = {
  ActivityList: PGActivityList,
  IconInfographic: PGIconInfographic,
}