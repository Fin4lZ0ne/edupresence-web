const { Builder, By, Key, until } = require('selenium-webdriver');
const chrome = require('selenium-webdriver/chrome');

(async function loginTest() {
  // Setup opsi Chrome, termasuk headless
  const options = new chrome.Options();
  options.addArguments('--headless'); // Tambahkan ini jika ingin tanpa GUI
  options.addArguments('--no-sandbox');
  options.addArguments('--disable-dev-shm-usage');

  let driver = await new Builder()
    .forBrowser('chrome')
    .setChromeOptions(options)
    .build();

  try {
    await driver.get('https://eduprence.my.id/login');

    await driver.wait(until.elementLocated(By.id('email')), 5000);

    await driver.findElement(By.id('email')).sendKeys('admin@mail.com');
    await driver.findElement(By.id('password')).sendKeys('admin123', Key.RETURN);

    await driver.wait(until.urlContains('/dashboard'), 5000);

    console.log('✅ Login berhasil!');
  } catch (e) {
    console.error('❌ Login gagal:', e.message);
  } finally {
    await driver.quit();
  }
})();
