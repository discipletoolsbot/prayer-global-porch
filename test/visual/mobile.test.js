const { toMatchImageSnapshot } = require('jest-image-snapshot');
const { testPage } = require('./helpers')

expect.extend({ toMatchImageSnapshot });

describe('Mobile Testing', () => {

    jest.setTimeout(80000);

    beforeAll(async () => {
        await page.setViewport({ width: 450, height: 950 })
    })

    it('Home page', async () => {
        await testPage('')
    })

    it('Contact page', async () => {
        await testPage('prayer_app/contact_us/')
    })

    it('Subscribe page', async () => {
        await testPage('prayer_app/subscribe/')
    })

    it('Data sources page', async () => {
        await testPage('content_app/data_sources/')
    })

    it('Media Tools', async () => {
        await testPage('download_app/media/')
    })


/*     it('Global map', async () => {
        await testPage('prayer_app/global/cc8b6b/map')
    })

    it('Active challenges', async () => {
        await testPage('challenges/active/')
    })

    it('Custom map', async () => {
        await testPage('prayer_app/custom/043ed2/map')
    })

    it('Tools', async () => {
        await testPage('prayer_app/custom/043ed2/tools')
    })

    it('Race Map', async () => {
        await testPage('race_app/race_map/')
    })

    it('Race List', async () => {
        await testPage('race_app/race_list/')
    })

    it('Custom Completed', async () => {
        await testPage('prayer_app/custom/043ed2/completed')
    })

    it('Custom stats', async () => {
        await testPage('prayer_app/custom/043ed2/stats')
    })

    it('Global Stats', async () => {
        await testPage('prayer_app/global/cc8b6b/stats')
    })

    it('Global Completed', async () => {
        await testPage('prayer_app/global/cc8b6b/completed')
    })
 */

})
