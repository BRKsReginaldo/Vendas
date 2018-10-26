const R = require('rambda')

export const stringify = value => value || ''

export const maxLength = R.curry((length, suffix, string) =>
  stringify(string).length > length ?
    stringify(string).slice(0, length) + suffix :
    stringify(string))

export const toMoney = value =>
  Intl.NumberFormat('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(value)

export const toPhone = value => {
  if (!value) return value
  if (value.length < 10) return value.slice(0, Math.ceil(value.length / 2)) + '-'+value.slice(Math.ceil(value.length / 2))

  const ddd = value.slice(0, 2)
  let hasNineNumbers = value.length > 10
  const first = value.slice(2, hasNineNumbers ? 7 : 6)
  const last = value.slice(hasNineNumbers ? 6 : 7)

  return `(${ddd}) ${first}-${last}`
}