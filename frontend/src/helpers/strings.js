const R = require('rambda')

export const stringify = value => value || ''

export const maxLength = R.curry((length, suffix, string) =>
  stringify(string).length > length ?
    stringify(string).slice(0, length) + suffix :
    stringify(string))