// jest-puppeteer.config.js
module.exports = {
    launch: {
        headless: false,
        product: 'chrome',
        args: ['--start-maximized'],
        defaultViewport :{width: 450, height: 950 }
    },
    browserContext: 'default',
}