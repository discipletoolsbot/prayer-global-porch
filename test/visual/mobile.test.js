const { toMatchImageSnapshot } = require('jest-image-snapshot');

expect.extend({ toMatchImageSnapshot });

describe('Home Page Testing', () => {

    jest.setTimeout(50000);

    beforeAll(async () => {
        await page.setViewport({ width: 450, height: 950 })
        await page.goto('http://localhost:8000')
    })

    it('Test Home page Mobile', async () => {

        const image = await fullPageScreenshot()

        expect(image).toMatchImageSnapshot({
            failureThreshold: '0.10',
            failureThresholdType: 'percent'
        });

    })

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

})