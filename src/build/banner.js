'use strict'

const pkg = require('../../package.json')
const year = new Date().getFullYear()

function getBanner(pluginFilename) {
  return `/*!
  * FRY ${pluginFilename ? ` ${pluginFilename}` : ''} v${pkg.version} (${pkg.homepage})
  * Licensed under ${ pkg.license } (${ pkg.licenseUrl })
  */`
}

module.exports = getBanner