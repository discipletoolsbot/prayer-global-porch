async function fullPageScreenshot() {
    const bodyHandle = await page.$('body');

    const { width, height } = await bodyHandle.boundingBox()
    
    const image = await page.screenshot({
        clip: {
            x: 0,
            y: 0,
            width,
            height
        },
        type: 'png',
    });

    await bodyHandle.dispose()

    return image;
}

async function gotoPage(urlPage) {
    return page.goto('http://localhost:8000/' + urlPage, {
        waitUntil: 'networkidle0'
    })
}

async function testPage(urlPage) {
    await gotoPage(urlPage)

    const image = await fullPageScreenshot()

    expect(image).toMatchImageSnapshot({
        failureThreshold: '0.10',
        failureThresholdType: 'percent'
    });

    return
}

module.exports = {
    fullPageScreenshot,
    gotoPage,
    testPage,
}